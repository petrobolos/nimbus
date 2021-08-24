<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class AbilityResource
 *
 * @mixin \App\Models\Ability
 * @package App\Http\Resources
 */
class AbilityResource extends JsonResource
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
            'name' => $this->name,
            'code' => $this->code,
            'cost' => $this->cost,
            'type' => $this->type,
            'description' => $this->description,
        ];
    }
}
