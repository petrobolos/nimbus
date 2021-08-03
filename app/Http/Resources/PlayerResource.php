<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class PlayerResource
 *
 * @mixin \App\Models\Player
 * @package App\Http\Resources
 */
class PlayerResource extends JsonResource
{
    /**
     * @inheritDoc
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'fighter_id_1' => $this->fighter_id_1,
            'fighter_id_2' => $this->fighter_id_2,
            'fighter_id_3' => $this->fighter_id_3,
            'firstFighter' => new FighterResource($this->whenLoaded('firstFighter')),
            'secondFighter' => new FighterResource($this->whenLoaded('secondFighter')),
            'thirdFighter' => new FighterResource($this->whenLoaded('thirdFighter')),
            'user' => new UserResource($this->whenLoaded('user')),
        ];
    }
}
