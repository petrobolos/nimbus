<?php

namespace App\Services;

use App\Enums\Difficulty;
use App\Models\Game;
use Exception;
use function Spatie\array_rand_value;

/**
 * Class DemoService
 *
 * @package App\Services
 */
class DemoService
{
    protected string $sessionKey;
    protected string $completionKey;
    protected array $roster;

    /**
     * DemoService constructor.
     */
    public function __construct()
    {
        $this->sessionKey = config('demo.session_key');
        $this->completionKey = config('demo.completion_key');
        $this->roster = config('demo.roster');
    }

    /**
     * Generates and provides a Player vs AI demo game.
     *
     * @throws \Exception
     * @return \App\Models\Game
     */
    public function generateDemoGame(): Game
    {
        $playerService = app(PlayerService::class);

        return Game::create([
            'player_1' => $playerService->createGuestPlayer($this->getPlayerDemoTeam())->id,
            'player_2' => $playerService->createAiPlayer($this->determineDemoTeam())->id,
            'status' => Game::STATUS_IN_PROGRESS,
            'against_ai' => true,
            'ranked' => false,
        ])->load('firstPlayer', 'secondPlayer');
    }

    /**
     * Determines what team to provide the AI player in the demo with.
     *
     * @throws \Exception
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
     * Gets the demo difficulty from the sessions. Sets it to easy if unset.
     *
     * @throws \Exception
     * @return string
     */
    public function getDemoDifficulty(): string
    {
        if (! session()->has($this->sessionKey)) {
            $this->setDemoDifficulty(Difficulty::EASY);
        }

        return session()->get($this->sessionKey);
    }

    /**
     * Sets the demo difficulty.
     *
     * @param string $difficulty
     * @throws \Exception
     * @return void
     */
    public function setDemoDifficulty(string $difficulty): void
    {
        if (! in_array($difficulty, Difficulty::DIFFICULTIES, true)) {
            throw new Exception('This is not a valid difficulty.');
        }

        session()->put($this->sessionKey, $difficulty);
    }

    /**
     * Returns whether the demo has been completed.
     *
     * @return bool
     */
    public function getDemoCompletion(): bool
    {
        if (session()->has($this->completionKey)) {
            return true;
        }

        return false;
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
