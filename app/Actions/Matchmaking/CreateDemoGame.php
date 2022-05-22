<?php

namespace App\Actions\Matchmaking;

use App\Actions\GameLogic\Players\CreateCpuPlayer;
use App\Actions\GameLogic\Players\CreateGuestPlayer;
use App\Enums\GameMode;
use App\Models\Webgame;

class CreateDemoGame
{
    /**
     * Create a fully-formed demo game instance.
     *
     * @return \App\Models\Webgame
     */
    public function create(): Webgame
    {
        $game = app(CreateGame::class)->create(
            player: app(CreateGuestPlayer::class)->create(),
            mode: GameMode::DEMO,
        );

        return app(JoinGame::class)->join(
            game: $game,
            player: app(CreateCpuPlayer::class)->create(),
        );
    }
}
