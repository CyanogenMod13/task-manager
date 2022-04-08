<?php

namespace App\Listeners;

use App\Events\UserCreatedEvent;
use App\Mail\WelcomeUserMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Mail;

class UserCreatedListener
{
    public function handle(UserCreatedEvent $event)
    {
        Mail::to($event->user)
            ->queue(new WelcomeUserMail($event->user));
    }
}
