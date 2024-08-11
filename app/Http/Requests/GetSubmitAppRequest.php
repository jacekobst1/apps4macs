<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Spatie\LaravelData\Data;

final class GetSubmitAppRequest extends Data
{
    public function __construct(
        public readonly bool $is_paid,
    ) {
    }
}
