<?php

namespace App\Traits;

use Illuminate\Support\Carbon;
use Throwable;

/**
 * Trait Bannable
 *
 * @mixin \App\Models\User
 * @package App\Traits
 */
trait Bannable
{
    /**
     * Returns true if the user is currently banned.
     *
     * @return bool
     */
    public function isBanned(): bool
    {
        return $this->banned_until !== null && $this->banned_until > now();
    }

    /**
     * Returns true if the user is permanently banned.
     *
     * @return bool
     */
    public function isPermabanned(): bool
    {
        return $this->isBanned() && $this->banned_until->toDateString() === config('game.bans.permaban_date');
    }

    /**
     * Ban a user. Ban is a week in length if argument is empty.
     *
     * @param null|string $until
     * @return void
     */
    public function ban(?string $until = null): void
    {
        try {
            if (empty($until)) {
                $until = now()->addWeek()->toDateTimeString();
            }

            self::update(['banned_until' => Carbon::parse($until)]);
        } catch (Throwable $throwable) {
            report($throwable);
        }
    }

    /**
     * Unban a user.
     *
     * @return void
     */
    public function unban(): void
    {
        try {
            self::update(['banned_until' => null]);
        } catch (Throwable $throwable) {
            report($throwable);
        }
    }

    /**
     * Permanently bans a user.
     *
     * @return void
     */
    public function permaban(): void
    {
        $this->ban(config('game.bans.permaban_date'));
    }
}
