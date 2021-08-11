<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Http\Resources\GameResource;
use App\Services\DemoService;
use Illuminate\View\View;

/**
 * Class DemoController
 *
 * @package App\Http\Controllers\Pages
 */
class DemoController extends Controller
{
    protected DemoService $demoService;

    /**
     * DemoController constructor.
     *
     * @param \App\Services\DemoService $demoService
     */
    public function __construct(DemoService $demoService)
    {
        $this->demoService = $demoService;
    }

    /**
     * Starts or resumes a demo game.
     *
     * @throws \Exception
     * @return \Illuminate\Contracts\View\View
     */
    public function __invoke(): View
    {
        return view('pages.game', [
            'game' => new GameResource($this->demoService->startOrResumeDemo()),
        ]);
    }
}
