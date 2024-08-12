<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\GetHomepageService;
use Illuminate\Http\Request;
use Inertia\Response;

final readonly class HomepageController
{
    public function getHomepage(
        Request $request,
        GetHomepageService $service
    ): Response|array {
        return $service->handle($request);
    }
}
