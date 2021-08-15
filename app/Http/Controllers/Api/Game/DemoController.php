<?php

namespace App\Http\Controllers\Api\Game;

use App\Http\Requests\Game\Demo\DemoSyncRequest;
use App\Models\Game;
use Illuminate\Http\JsonResponse;

class DemoController
{
    public function sync(DemoSyncRequest $request): JsonResponse
    {
        $stateData = $request->validated();
        $demoGame = Game::findOrFail($stateData['gameId'] ?? null);

        $demoGame->update([
            'state' => $stateData['state'],
            'status' => Game::STATUS_IN_PROGRESS,
        ]);

        return response()->json([
            'state' => $demoGame->state,
            'stateHash' => $demoGame->stateHash,
        ]);
    }
}
