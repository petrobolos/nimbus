<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class RoleResource
 *
 * @mixin \App\Models\Role
 * @package App\Http\Resources
 */
class RoleResource extends JsonResource
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
            'key' => $this->key,
            'name' => $this->name,
            'description' => $this->description,
        ];
    }
}
