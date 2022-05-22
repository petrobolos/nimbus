<?php

namespace App\Listeners;

use App\Events\UserUnbannedEvent;

class UserUnbannedEventListener
{
    /**
     * Handle the event.
     *
     * @param \App\Events\UserUnbannedEvent $event
     * @return void
     */
    public function handle(UserUnbannedEvent $event): void
    {
        $event->user->notify();
    }
}
