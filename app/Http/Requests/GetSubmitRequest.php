<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Spatie\LaravelData\Data;

final class GetSubmitRequest extends Data
{
    public function __construct(
        public readonly bool $isPaid,
    ) {
    }
}
