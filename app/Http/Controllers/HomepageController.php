<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\App;
use App\Resources\AppResource;
use Illuminate\Contracts\Pagination\CursorPaginator;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Http\Request;
use Illuminate\Pagination\AbstractCursorPaginator;
use Illuminate\Pagination\AbstractPaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Enumerable;
use Illuminate\Support\LazyCollection;
use Inertia\Inertia;
use Inertia\Response;
use Spatie\LaravelData\CursorPaginatedDataCollection;
use Spatie\LaravelData\DataCollection;
use Spatie\LaravelData\PaginatedDataCollection;

final readonly class HomepageController
{
    public function getHomepage(Request $request
    ): Response|array|CursorPaginator|Paginator|AbstractCursorPaginator|AbstractPaginator|Collection|Enumerable|LazyCollection|CursorPaginatedDataCollection|DataCollection|PaginatedDataCollection {
        $appsModels = App::with('media')->cursorPaginate(24); // try also 28
        $apps = AppResource::collect($appsModels);

        if ($request->wantsJson()) {
            return $apps;
        }

        return Inertia::render('Homepage', [
            'apps' => $apps,
        ]);
    }
}
