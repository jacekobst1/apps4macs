<?php

namespace App\Listeners;

use Illuminate\Mail\Events\MessageSending;
use Illuminate\Support\Facades\Config;

class RedirectMailsLocally
{
    public function handle(MessageSending $event): void
    {
        if (!app()->isProduction()) {
            $event->message->to(Config::get('env.admin_email'));
        }
    }
}
