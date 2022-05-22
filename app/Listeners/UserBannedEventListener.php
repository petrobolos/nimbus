<?php

namespace App\Listeners;
use App\Events\UserBannedEvent;

class UserBannedEventListener{
    public function __construct()
    {
        //
    }

    public function handle(UserBannedEvent $event)
    {

    }
}
