<?php

namespace App\Http\Controllers\Api\Game;

use App\Classes\Game\Action;
use App\Http\Requests\Game\Demo\DemoActionRequest;
use App\Http\Requests\Game\Demo\DemoHeartbeatRequest;
use App\Http\Requests\Game\Demo\DemoSyncRequest;
use App\Http\Resources\GameResource;
use App\Models\Game;
use App\Services\ActionService;
use App\Services\GameService;
use Exception;
use Illuminate\Http\JsonResponse;

/**
 * Class DemoController
 *
 * @package App\Http\Controllers\Api\Game
 */
class DemoController extends GameController
{
    /**
     * Progress the demo game state with the player's turn.
     *
     * @param \App\Http\Requests\Game\Demo\DemoActionRequest $request
     * @param \App\Services\ActionService $actionService
     * @return \Illuminate\Http\JsonResponse
     */
    public function act(DemoActionRequest $request, ActionService $actionService): JsonResponse
    {
        try {
            $data = $request->validated();
            $demoGame = Game::findOrFail($data['game_id'] ?? null);

            $action = collect(Action::convert([
                $data['action'],
            ]))->first();

            $demoGame = $actionService->apply($demoGame, $action);

            return response()->json([
                'game' => new GameResource($demoGame),
            ]);
        } catch (Exception $exception) {
            report($exception);

            return response()->json([
                'error' => $exception->getMessage(),
            ], $exception->getCode());
        }
    }

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
