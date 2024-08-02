<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;

final readonly class ListController
{
    public function getList(): Response
    {
        return Inertia::render('List');
    }
}
