<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class GameResource
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
            'status' => $this->status,
            'ranked' => $this->ranked,
            'against_ai' => $this->against_ai,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'time_elapsed' => $this->time_elapsed,

            'state' => $this->state,
            'state_hash' => $this->stateHash,

            'player_1' => $this->player_1,
            'player_2' => $this->player_2,

            'firstPlayer' => new PlayerResource($this->whenLoaded('firstPlayer')),
            'secondPlayer' => new PlayerResource($this->whenLoaded('secondPlayer')),
        ];
    }
}
