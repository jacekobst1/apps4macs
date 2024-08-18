<?php

namespace App\Listeners;

use Illuminate\Mail\Events\MessageSending;

class RedirectMailsLocally
{
    public function handle(MessageSending $event): void
    {
        if (app()->isLocal()) {
            $event->message->to(config('env.admin_email'));
        }
    }
}
