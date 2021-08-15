<?php

namespace App\Services;

use App\Models\Game;

/**
 * Class GameService.
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

    /**
     * Abandons a game if it has not been updated in over an hour. Returns true if abandoned.
     *
     * @param \App\Models\Game $game
     * @return bool
     */
    public function abandon(Game $game): bool
    {
        if (! $game->concluded()) {
            // Only update the status if the game is still in-progress and out-of-time.
            if ($game->inProgress() && $game->updated_at->addHour() <= now()) {
                $game->update(['status' => Game::STATUS_ABANDONED]);
            }

            return true;
        }

        return false;
    }
}
