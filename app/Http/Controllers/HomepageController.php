<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\GetHomepageService;
use Illuminate\Contracts\Pagination\CursorPaginator;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Http\Request;
use Illuminate\Pagination\AbstractCursorPaginator;
use Illuminate\Pagination\AbstractPaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Enumerable;
use Illuminate\Support\LazyCollection;
use Inertia\Response;
use Spatie\LaravelData\CursorPaginatedDataCollection;
use Spatie\LaravelData\DataCollection;
use Spatie\LaravelData\PaginatedDataCollection;

final readonly class HomepageController
{
    public function getHomepage(
        Request $request,
        GetHomepageService $service
    ): Response|array|CursorPaginator|Paginator|AbstractCursorPaginator|AbstractPaginator|Collection|Enumerable|LazyCollection|CursorPaginatedDataCollection|DataCollection|PaginatedDataCollection {
        return $service->handle($request);
    }
}
