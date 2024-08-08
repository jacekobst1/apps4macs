<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\App;
use App\Resources\AppResource;
use Inertia\Inertia;
use Inertia\Response;

final readonly class HomepageController
{
    public function getHomepage(): Response
    {
        $appsModels = App::with('media')->get();
        $apps = AppResource::collect($appsModels);

        return Inertia::render('Homepage', [
            'apps' => $apps,
        ]);
    }
}
