<?php

namespace App\Traits;

use Illuminate\Support\Carbon;
use Throwable;

/**
 * Trait Mutable
 *
 * @mixin \App\Models\User
 * @package App\Traits
 */
trait Mutable
{
    /**
     * Returns true if the user is currently muted.
     *
     * @return bool
     */
    public function isMuted(): bool
    {
        return $this->muted_until !== null && $this->muted_until > now();
    }

    /**
     * Mute a user. Ban is a week in length if argument is empty.
     *
     * @param null|string $until
     */
    public function mute(?string $until = null): void
    {
        try {
            if (empty($until)) {
                $until = now()->addWeek()->toDateTimeString();
            }

            $this->muted_until = Carbon::parse($until);
        } catch (Throwable $throwable) {
            report($throwable);
        }
    }

    /**
     * Unmute a user.
     *
     * @return void
     */
    public function unmute(): void
    {
        try {
            self::update(['muted_until' => null]);
        } catch (Throwable $throwable) {
            report($throwable);
        }
    }
}
