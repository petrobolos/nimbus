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
            'for' => new RaceResource($this->whenLoaded('for')),
            'against' => new RaceResource($this->whenLoaded('against')),
            'type' => $this->type,
            'description' => $this->description,
        ];
    }
}
