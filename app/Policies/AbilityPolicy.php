<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AbilityPolicy
{
    use HandlesAuthorization;

    /**
     * Determines whether a user can perform ad
     * @param \App\Models\User $user
     * @return bool
     */
    public function action(User $user): bool
    {
        return $user->isAdmin();
    }
}
