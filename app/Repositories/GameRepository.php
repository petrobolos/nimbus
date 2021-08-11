<?php

namespace App\Repositories;

use App\Models\Game;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class GameRepository
 *
 * @package App\Repositories
 */
class GameRepository
{
    /**
     * Get an Eloquent query of all abandoned or concluded games. Probably to be culled.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function abandonedOrConcludedGames(): Builder
    {
        return Game::where('status', '!=', Game::STATUS_IN_PROGRESS)
            ->orWhere('updated_at', '<=', now()->subHour());
    }

    /**
     * Return a query of inactive but nevertheless in-progress games.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function inactiveGames(): Builder
    {
        return Game::where([
            ['status', '=', Game::STATUS_IN_PROGRESS],
            ['updated_at', '<=', now()->subHour()],
        ]);
    }
}
