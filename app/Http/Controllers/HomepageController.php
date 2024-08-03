<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;

final readonly class HomepageController
{
    public function getHomepage(): Response
    {
        return Inertia::render('Homepage');
    }
}
