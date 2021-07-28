<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class UserResource
 *
 * @mixin \App\Models\User
 * @package App\Http\Resources
 */
class UserResource extends JsonResource
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
            'username' => $this->username,
            'email' => $this->email,
            'date_of_birth' => $this->date_of_birth,
            'preferred_locale' => $this->preferred_locale,
            'last_signed_in' => $this->last_signed_in,
            'muted_until' => $this->muted_until,
            'banned_until' => $this->banned_until,
            'meta' => $this->meta,
            'role' => [
                'id' => $this->role->id,
                'key' => $this->role->key,
                'name' => $this->role->name,
            ],
        ];
    }
}
