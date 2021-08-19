<?php

namespace App\Services;

use App\Enums\Difficulty;
use App\Models\Game;
use Exception;
use Illuminate\Support\Str;
use function Spatie\array_rand_value;
use stdClass;

/**
 * Class DemoService.
 *
 * @package App\Services
 */
class DemoService
{
    protected string $sessionKey;

    protected string $difficultyKey;

    protected string $completionKey;

    protected array $roster;

    /**
     * DemoService constructor.
     */
    public function __construct()
    {
        $this->sessionKey = config('demo.session_key');
        $this->difficultyKey = config('demo.difficulty_key');
        $this->completionKey = config('demo.completion_key');
        $this->roster = config('demo.roster');
    }

    /**
     * Returns demo data.
     *
     * @throws Exception
     * @return stdClass
     */
    public function getDemoInformation(): stdClass
    {
        $data = new stdClass();

        $data->demo_id = $this->getDemoGame();
        $data->difficulty = Str::ucfirst($this->getDemoDifficulty());
        $data->completion = $this->getDemoCompletion();

        return $data;
    }

    /**
     * Starts or resumes an in-progress game.
     *
     * @throws Exception
     * @return \App\Models\Game
     */
    public function startOrResumeDemo(): Game
    {
        $gameIdInProgress = $this->getDemoGame();

        if ($gameIdInProgress !== null) {
            $game = Game::find($gameIdInProgress);

            if ($game && $game->inProgress()) {
                return $game;
            }

            // Reset the difficulty if the game was abandoned, or completed without update.
            $this->setDemoDifficulty(Difficulty::EASY);
        }

        $newGame = $this->generateDemoGame();
        $this->setDemoGame($newGame->id);

        return $newGame;
    }

    /**
     * Generates and provides a Player vs AI demo game.
     *
     * @throws Exception
     * @return \App\Models\Game
     */
    public function generateDemoGame(): Game
    {
        return app(GameService::class)->demo(
            $this->getPlayerDemoTeam(),
            $this->determineDemoTeam(),
        );
    }

    /**
     * Determines what team to provide the AI player in the demo with.
     *
     * @throws Exception
     * @return array
     */
    public function determineDemoTeam(): array
    {
        if ($this->getDemoCompletion()) {
            return array_rand_value($this->roster);
        }

        return $this->roster[$this->getDemoDifficulty()];
    }

    /**
     * Returns a pre-defined set of fighters for the user in the demo.
     *
     * @return array
     */
    public function getPlayerDemoTeam(): array
    {
        return config('demo.player_roster');
    }

    /**
     * Returns the demo game key if it is currently in progress. Null otherwise.
     *
     * @return null|int
     */
    public function getDemoGame(): ?int
    {
        return session()->get($this->sessionKey);
    }

    /**
     * Sets the game ID as the demo game in progress.
     *
     * @param int $gameId
     * @return void
     */
    public function setDemoGame(int $gameId): void
    {
        session()->put($this->sessionKey, $gameId);
    }

    /**
     * Gets the demo difficulty from the sessions. Sets it to easy if unset.
     *
     * @throws Exception
     * @return string
     */
    public function getDemoDifficulty(): string
    {
        if (! session()->has($this->difficultyKey)) {
            // We set the environment to difficult in local because it's easier to test with.
            if (isProduction()) {
                $this->setDemoDifficulty(Difficulty::EASY);
            } else {
                $this->setDemoDifficulty(Difficulty::HARD);
            }
        }

        return session()->get($this->difficultyKey);
    }

    /**
     * Sets the demo difficulty.
     *
     * @param string $difficulty
     * @throws Exception
     * @return void
     */
    public function setDemoDifficulty(string $difficulty): void
    {
        if (! in_array($difficulty, Difficulty::DIFFICULTIES, true)) {
            throw new Exception('This is not a valid difficulty.');
        }

        session()->put($this->difficultyKey, $difficulty);
    }

    /**
     * Returns whether the demo has been completed.
     *
     * @return bool
     */
    public function getDemoCompletion(): bool
    {
        return (bool) (session()->has($this->completionKey));
    }

    /**
     * Marks the demo as completed.
     *
     * @return void
     */
    public function setDemoCompletion(): void
    {
        session()->put($this->completionKey, true);
    }
}
