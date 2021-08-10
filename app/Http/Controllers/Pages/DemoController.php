<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Services\GameService;
use Illuminate\View\View;

/**
 * Class DemoController
 *
 * @package App\Http\Controllers\Pages
 */
class DemoController extends Controller
{
    /**
     * @param \App\Services\GameService $gameService
     * @throws \Exception
     * @return \Illuminate\Contracts\View\View
     */
    public function __invoke(GameService $gameService): View
    {
        return view('pages.game', [
            'game' => $gameService->demo(),
        ]);
    }
}
