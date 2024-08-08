<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\App;
use Inertia\Inertia;
use Inertia\Response;

final readonly class HomepageController
{
    public function getHomepage(): Response
    {
        $apps = App::all();

        foreach ($apps as $app) {
            $app['logo_url'] = $app->getFirstMediaUrl('logo');
        }

        return Inertia::render('Homepage', [
            'apps' => $apps,
        ]);
    }
}
