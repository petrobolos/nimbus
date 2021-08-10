<?php

namespace App\Services;

use App\Models\Game;
use Illuminate\View\View;

/**
 * Class GameService
 *
 * @package App\Services
 */
class GameService
{
    /**
     * Returns a freshly generated demo game.
     *
     * @throws \Exception
     * @return \App\Models\Game
     */
    public function demo(): Game
    {
        return app(DemoService::class)->generateDemoGame();
    }
}
