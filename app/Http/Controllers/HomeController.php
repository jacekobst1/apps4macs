<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\GetHomeService;
use Illuminate\Http\Request;
use Inertia\Response;

final readonly class HomeController
{
    public function getHome(
        Request $request,
        GetHomeService $service
    ): Response|array {
        return $service->handle($request);
    }
}
