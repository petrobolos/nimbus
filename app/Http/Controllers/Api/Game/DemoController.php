<?php

namespace App\Http\Controllers\Api\Game;

use App\Http\Requests\Game\Demo\DemoSyncRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class DemoController
{
    public function sync(DemoSyncRequest $request): JsonResponse
    {
        // TODO: This is just for testing
        return response()->json([
            'state' => [
                'history' => $request->validated()['state']['history'],
                'currentPlayer' => $request->validated()['current_player'],
            ],
            'stateHash' => Hash::make(json_encode($request->all()['state'], JSON_THROW_ON_ERROR)),
        ]);
    }
}
