<?php

namespace App\Actions\Matchmaking;

use App\Enums\GameMode;
use App\Enums\GameStatus;
use App\Models\Player;
use App\Models\Webgame;

class CreateGame
{
    /**
     * Create a game lobby.
     *
     * @param \App\Models\Player $player
     * @param \App\Enums\GameMode $mode
     * @return \App\Models\Webgame
     */
    public function create(Player $player, GameMode $mode): Webgame
    {
        return Webgame::create([
            'game_type' => $mode,
            'status' => GameStatus::INITIALIZED->value,
            'player_1_id' => $player->id,
            'player_2_id' => null,
        ]);
    }
}
