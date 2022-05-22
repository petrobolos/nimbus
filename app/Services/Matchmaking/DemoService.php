<?php

namespace App\Services\Matchmaking;

use App\Enums\GameDifficulty;
use Illuminate\Support\Facades\Session;

class DemoService
{
    /**
     * The session key that the difficulty is stored under.
     *
     * @var null|string
     */
    private ?string $difficultySessionKey;

    /**
     * DemoService constructor.
     *
     * @return void
     */
    public function __construct()
    {
        $this->difficultySessionKey = config('nimbus.webgame.difficulty_key');
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

        Session::get($this->difficultySessionKey, GameDifficulty::EASY);
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
}
