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
            'uuid' => $this->uuid,
            'name' => $this->name,
            'code' => $this->code,
            'current_hp' => $this->current_hp,
            'current_sp' => $this->current_sp,
            'is_boss' => $this->is_boss,
            'is_paralyzed' => $this->is_paralyzed,
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
