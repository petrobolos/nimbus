<?php

namespace App\Listeners;

use App\Events\UserBannedEvent;
use App\Notifications\UserBannedNotification;

class UserBannedEventListener
{
    /**
     * Handle the event.
     *
     * @param \App\Events\UserBannedEvent $event
     * @return void
     */
    public function handle(UserBannedEvent $event): void
    {
        $event->user->notify(new UserBannedNotification($event->user));
    }
}
