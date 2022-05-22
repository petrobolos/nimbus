<?php

namespace App\Traits;

use App\Events\UserBannedEvent;
use App\Events\UserUnbannedEvent;
use DateTimeInterface;
use Illuminate\Support\Carbon;

/**
 * Bannable trait.
 *
 * @mixins \App\Models\User
 * @property null|\Carbon\Carbon banned_until
 */
trait Bannable
{
    /**
     * Return whether a given user is currently banned.
     *
     * @return bool
     */
    public function isBanned(): bool
    {
        return $this->banned_until !== null && $this->banned_until->lte(Carbon::now());
    }

    /**
     * Return whether a given user is permanently banned.
     *
     * @return bool
     */
    public function isPermabanned(): bool
    {
        return $this->isBanned() && $this->banned_until->equalTo(Carbon::parse(config('bans.permaban_date')));
    }

    /**
     * Ban a user.
     *
     * @param null|\DateTimeInterface|string $until
     * @return void
     */
    public function ban(null|DateTimeInterface|string $until = null): void
    {
        if (empty($until)) {
            $until = Carbon::now()->addDays(config('bans.default_duration'));
        }

        $this->update(['banned_until' => Carbon::parse($until)]);

        UserBannedEvent::dispatch();
    }

    /**
     * Permanently ban a user.
     *
     * @return void
     */
    public function permaban(): void
    {
        $this->ban(config('bans.permaban_date'));
    }

    /**
     * Unban a user.
     *
     * @return void
     */
    public function unban(): void
    {
        $this->update(['banned_until' => null]);

        UserUnbannedEvent::dispatch();
    }
}
