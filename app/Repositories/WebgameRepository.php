<?php

namespace App\Repositories;

use App\Models\Webgame;

class WebgameRepository
{
    /**
     * Retrieve the active demo game based on a given ID.
     *
     * @param string $gameId
     * @return null|\App\Models\Webgame
     */
    public function getActiveDemoGame(string $gameId): ?Webgame
    {
        return Webgame::query()
            ->where('id', $gameId)
            ->isDemo()
            ->isActive()
            ->first();
    }
}
