<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class FighterResource.
 *
 * @mixin \App\Models\Fighter
 * @package App\Http\Resources
 */
class FighterResource extends JsonResource
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'code' => $this->code,
            'is_boss' => $this->is_boss,
            'hp' => $this->hp,
            'sp' => $this->sp,
            'attack' => $this->attack,
            'defense' => $this->defense,
            'speed' => $this->speed,
            'special' => $this->special,
            'spirit' => $this->special,
            'description' => $this->description,
            'race' => new RaceResource($this->whenLoaded('race')),
            'last_form' => new self($this->whenLoaded('lastForm')),
            'abilities' => AbilityResource::collection($this->abilities),
        ];
    }
}
