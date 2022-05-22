<?php

namespace App\Services\Matchmaking;

use App\Actions\Matchmaking\CreateDemoGame;
use App\Enums\GameDifficulty;
use App\Models\Webgame;
use App\Repositories\WebgameRepository;
use Illuminate\Support\Facades\Session;

class DemoService
{
    /**
     * The session key that the difficulty is stored under.
     *
     * @var string
     */
    private string $difficultySessionKey;

    /**
     * The session key that the active demo ID is stored under.
     *
     * @var string
     */
    private string $demoSessionKey;

    /**
     * DemoService constructor.
     *
     * @return void
     */
    public function __construct()
    {
        $this->difficultySessionKey = config('nimbus.webgame.difficulty_key');
        $this->demoSessionKey = config('nimbus.webgame.demo_session_key');
    }

    /**
     * Start a new demo game or continue an existing one.
     *
     * @return \App\Models\Webgame
     */
    public function getDemoGame(): Webgame
    {
        $existingDemoUuid = $this->getActiveDemoUuid();

        if ($existingDemoUuid) {
            $game = app(WebgameRepository::class)->getActiveDemoGame($existingDemoUuid);

            /*
             * If the session difficulty is present and the game is not, then we can increment the difficulty
             * of the demo, either because the player completed or abandoned it.
             */
            if ($game === null && Session::has($this->difficultySessionKey)) {
                $this->incrementDemoDifficulty();
            }
        }

        $game ??= app(CreateDemoGame::class)->create();

        // If the game isn't set as the active demo, each refresh will cause a new demo to be generated.
        $this->setActiveDemo($game->id);

        return $game;
    }

    /**
     * Get the active ID of an in progress demo game, if it exists in the session.
     *
     * @return null|string
     */
    public function getActiveDemoUuid(): ?string
    {
        if (app()->runningInConsole()) {
            return null;
        }

        return Session::get($this->demoSessionKey);
    }

    /**
     * Store the active demo game UUID into session.
     *
     * @param string $gameId
     * @return void
     */
    public function setActiveDemo(string $gameId): void
    {
        Session::put($this->demoSessionKey, $gameId);
    }

    /**
     * Retrieve the current demo difficulty.
     *
     * @return \App\Enums\GameDifficulty
     */
    public function getDemoDifficulty(): GameDifficulty
    {
        if (app()->runningInConsole()) {
            return GameDifficulty::EASY;
        }

        return Session::get($this->difficultySessionKey, GameDifficulty::EASY);
    }

    /**
     * Set the demo difficulty.
     *
     * @param \App\Enums\GameDifficulty|string $difficulty
     * @return void
     */
    public function setDemoDifficulty(GameDifficulty|string $difficulty): void
    {
        if (is_string($difficulty)) {
            $difficulty = GameDifficulty::tryFrom($difficulty);
        }

        Session::put($this->difficultySessionKey, $difficulty);
    }

    /**
     * Increment the demo difficulty.
     *
     * @return void
     */
    public function incrementDemoDifficulty(): void
    {
        $difficulty = $this->getDemoDifficulty();

        $newDifficulty = match ($difficulty) {
            GameDifficulty::EASY => GameDifficulty::NORMAL,
            GameDifficulty::NORMAL => GameDifficulty::HARD,
            default => collect(GameDifficulty::cases())->random(),
        };

        $this->setDemoDifficulty($newDifficulty);
    }
}
