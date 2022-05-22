<?php

namespace App\Actions\Matchmaking;

use App\Enums\GameStatus;
use App\Models\Player;
use App\Models\Webgame;
use Illuminate\Support\Carbon;

class JoinGame
{
    /**
     * A player joins an initialized game - which starts the game.
     *
     * @param \App\Models\Webgame $game
     * @param \App\Models\Player $player
     * @return \App\Models\Webgame
     */
    public function join(Webgame $game, Player $player): Webgame
    {
        $game->update([
            'player_2_id' => $player->id,
            'status' => GameStatus::IN_PROGRESS->value,
            'started_at' => Carbon::now(),
        ]);

        return $game;
    }
}
