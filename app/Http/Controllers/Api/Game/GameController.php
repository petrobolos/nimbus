<?php

namespace App\Http\Controllers\Api\Game;

use App\Http\Controllers\Controller;
use App\Models\Game;
use App\Services\GameService;
use Illuminate\Http\JsonResponse;

/**
 * Class GameController.
 *
 * @package App\Http\Controllers\Api\Game
 */
class GameController extends Controller
{
    /**
     * Generates a sync response for any type of game.
     *
     * @param \App\Models\Game $game
     * @param array $requestData
     * @return \Illuminate\Http\JsonResponse
     */
    protected function generateSyncResponse(Game $game, array $requestData): JsonResponse
    {
        $game->update([
            'state' => $requestData['state'],
            'status' => Game::STATUS_IN_PROGRESS,
        ]);

        return response()->json([
            'state' => $game->state,
            'stateHash' => $game->stateHash,
        ]);
    }

    /**
     * Generates a heartbeat response for any type of game.
     *
     * @param \App\Models\Game $game
     * @param \App\Services\GameService $gameService
     * @return \Illuminate\Http\JsonResponse
     */
    protected function generateHeartbeatResponse(Game $game, GameService $gameService): JsonResponse
    {
        $gameService->abandon($game);

        return response()->json([
            'heartbeat' => $game->updated_at,
            'status' => $game->status,
        ]);
    }
}
