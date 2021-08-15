<?php

namespace App\Http\Controllers\Api\Game;

use App\Http\Requests\Game\Demo\DemoHeartbeatRequest;
use App\Http\Requests\Game\Demo\DemoSyncRequest;
use App\Models\Game;
use App\Services\GameService;
use Illuminate\Http\JsonResponse;

class DemoController extends GameController
{
    /**
     * Receives a heartbeat from the demo and determines whether the demo should be abandoned.
     *
     * @param \App\Http\Requests\Game\Demo\DemoHeartbeatRequest $request
     * @param \App\Services\GameService $gameService
     * @return \Illuminate\Http\JsonResponse
     */
    public function heartbeat(DemoHeartbeatRequest $request, GameService $gameService): JsonResponse
    {
        $game = Game::findOrFail($request?->input('gameId'));

        return $this->generateHeartbeatResponse($game, $gameService);
    }

    /**
     * Synchronise demo state with the server.
     *
     * @param \App\Http\Requests\Game\Demo\DemoSyncRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function sync(DemoSyncRequest $request): JsonResponse
    {
        $stateData = $request->validated();
        $demoGame = Game::findOrFail($stateData['gameId'] ?? null);

        return $this->generateSyncResponse($demoGame, $stateData);
    }
}
