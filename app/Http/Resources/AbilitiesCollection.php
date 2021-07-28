<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

/**
 * Class AbilitiesCollection
 *
 * @package App\Http\Resources
 * @see \App\Models\Ability
 */
class AbilitiesCollection extends ResourceCollection
{
    /**
     * @inheritDoc
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'data' => $this->collection,
        ];
    }
}
