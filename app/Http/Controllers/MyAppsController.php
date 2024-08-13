<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;

final readonly class MyAppsController
{
    public function getIndex(): Response
    {
        return Inertia::render('MyApps/Index');
    }
}
