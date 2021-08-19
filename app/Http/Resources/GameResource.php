<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class GameResource.
 *
 * @mixin \App\Models\Game
 * @package App\Http\Resources
 */
class GameResource extends JsonResource
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'uuid' => $this->uuid,
            'game_type' => $this->game_type,
            'status' => $this->status,
            'description' => $this->description,
            'ranked' => $this->isRanked(),
            'against_ai' => $this->againstAi(),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'time_elapsed' => $this->time_elapsed,

            'player_1' => $this->player_1,
            'player_2' => $this->player_2,

            'state' => $this->state,
            'state_hash' => $this->stateHash,

            'players' => [
                new PlayerResource($this->whenLoaded('firstPlayer')),
                new PlayerResource($this->whenLoaded('secondPlayer')),
            ],
        ];
    }
}
