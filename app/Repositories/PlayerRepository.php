<?php

namespace App\Repositories;

use App\Models\Player;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class PlayerRepository
 *
 * @package App\Repositories
 */
class PlayerRepository
{
    /**
     * Get an Eloquent query of all expired AI or guest players. Probably to be culled.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function expiredGuestOrAiPlayers(): Builder
    {
        return Player::where([
            ['user_id', '=', null],
            ['created_at', '<=', now()->subHour()],
        ]);
    }
}
