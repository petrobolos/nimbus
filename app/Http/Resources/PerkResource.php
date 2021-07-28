<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class PerkResource
 *
 * @mixin \App\Models\Perk
 * @package App\Http\Resources
 */
class PerkResource extends JsonResource
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
            'for' => [
                'id' => $this->for_race->id,
                'name' => $this->for_race->name,
                'code' => $this->for_race->code
            ],
            'against' => [
                'id' => $this->against_race->id,
                'name' => $this->against_race->name,
                'code' => $this->against_race->code
            ],
            'type' => $this->type,
            'description' => $this->description,
        ];
    }
}
