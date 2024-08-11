<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\App;
use App\Resources\AppResource;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

final readonly class GetHomepageService
{
    public function handle(Request $request): Response|array
    {
        $appsModels = App::with('media')->cursorPaginate(24);
        $apps = AppResource::collect($appsModels)->toArray();

        if ($request->wantsJson()) {
            return $apps;
        }

        return Inertia::render('Homepage', [
            'apps' => $apps,
        ]);
    }
}
