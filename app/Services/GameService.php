<?php

namespace App\Services;

use App\Models\Game;

/**
 * Class GameService
 *
 * @package App\Services
 */
class GameService
{
    protected PlayerService $playerService;

    /**
     * GameService constructor.
     *
     * @param \App\Services\PlayerService $playerService
     */
    public function __construct(PlayerService $playerService)
    {
        $this->playerService = $playerService;
    }

    /**
     * Returns a freshly generated demo game from two slug rosters.
     *
     * @param array $playerRoster
     * @param array $cpuRoster
     * @return \App\Models\Game
     */
    public function demo(array $playerRoster, array $cpuRoster): Game
    {
        return Game::create([
            'player_1' => $this->playerService->createGuestPlayer($playerRoster)->id,
            'player_2' => $this->playerService->createAiPlayer($cpuRoster)->id,
            'status' => Game::STATUS_IN_PROGRESS,
            'against_ai' => true,
            'ranked' => false,
        ])->load('firstPlayer', 'secondPlayer');
    }
}
