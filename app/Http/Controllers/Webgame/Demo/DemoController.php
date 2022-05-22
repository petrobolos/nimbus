<?php

namespace App\Http\Controllers\Webgame\Demo;

use App\Http\Controllers\Controller;
use App\Models\Webgame;
use App\Services\Matchmaking\DemoService;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class DemoController extends Controller
{
    public function index(DemoService $demoService): Response
    {
        return Inertia::render('Webgame/Demo/Index', [
            'game' => $demoService->getDemoGame(),
            'difficulty' => $demoService->getDemoDifficulty(),
        ]);
    }

    public function show(Request $request, Webgame $webgame, DemoService $demoService)
    {
        //
    }
}
