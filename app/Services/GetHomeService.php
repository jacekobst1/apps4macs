<?php

declare(strict_types=1);

namespace App\Services;

use App\Enums\AppStatus;
use App\Models\App;
use App\Resources\AppResource;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

final readonly class GetHomeService
{
    public function handle(Request $request): Response|array
    {
        $apps = $this->getApps();

        if ($request->wantsJson()) {
            return $apps;
        }

        return Inertia::render('Home/HomePage', [
            'apps' => $apps,
        ]);
    }

    private function getApps(): array
    {
        $apps = App::with('media')
            ->where('status', AppStatus::Accepted)
            ->orderBy('order')
            ->cursorPaginate(24);

        return AppResource::collect($apps)->toArray();
    }
}
