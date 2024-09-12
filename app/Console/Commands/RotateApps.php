<?php

namespace App\Console\Commands;

use App\Models\App;
use Illuminate\Console\Command;

class RotateApps extends Command
{
    private const TOP_COUNT = 15;

    protected $signature = 'app:rotate-apps';

    protected $description = 'Change the order of apps on the homepage.';

    public function handle(): void
    {
        $apps = App::orderByRaw('last_on_top IS NULL DESC')->orderBy('last_on_top')->get();

        foreach ($apps as $key => $app) {
            $order = $key + 1;

            $app->order = $order;
            if ($order <= self::TOP_COUNT) {
                $app->last_on_top = now();
            }

            $app->update();
        }
    }
}
