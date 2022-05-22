<?php

namespace App\Http\Controllers\Webgame\Demo;

use App\Http\Controllers\Controller;
use App\Models\Webgame;
use App\Services\Matchmaking\DemoService;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

class DemoController extends Controller
{
    /**
     * Start or resume a demo game.
     *
     * @param \App\Services\Matchmaking\DemoService $demoService
     * @return \Illuminate\Http\RedirectResponse
     */
    public function index(DemoService $demoService): RedirectResponse
    {
        $existingGameUuid = $demoService->getActiveDemoUuid();

        if ($existingGameUuid !== null) {
            $game = $demoService->getDemoGame($existingGameUuid);
        }

        // Even with an existing session UUID, the game may have been mothballed or completed, so we create a new one.
        $game ??= $demoService->createDemoGame();

        return redirect()->route('guest.demo.show', [
            'webgame' => $game->id,
        ]);
    }

    /**
     *
     * @param \App\Models\Webgame $webgame
     * @param \App\Services\Matchmaking\DemoService $demoService
     * @return \Inertia\Response
     */
    public function show(Webgame $webgame, DemoService $demoService): Response
    {
        abort_unless($webgame->isDemo(), SymfonyResponse::HTTP_NOT_FOUND);

        return Inertia::render('Webgame/Demo/Index', [
            'game' => $webgame,
            'difficulty' => $demoService->getDemoDifficulty(),
        ]);
    }
}
