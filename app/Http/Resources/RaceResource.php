<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class RaceResource
 *
 * @mixin \App\Models\Race
 * @package App\Http\Resources
 */
class RaceResource extends JsonResource
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
            'name' => $this->code,
            'description' => $this->description,
        ];
    }
}
