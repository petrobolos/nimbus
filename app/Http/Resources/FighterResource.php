<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Models\Fighter */
class FighterResource extends JsonResource
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
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
            'race' => [
                'id' => $this->race->id,
                'name' => $this->race->name,
                'code' => $this->race->code,
            ],
            'last_form' => $this->last_form_id ? self::toArray($this->lastForm) : null,
            'abilities' => AbilitiesCollection::collection($this->abilities),
        ];
    }
}
