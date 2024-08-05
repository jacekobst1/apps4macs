<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Spatie\LaravelData\Attributes\Validation\BooleanType;
use Spatie\LaravelData\Attributes\Validation\Required;
use Spatie\LaravelData\Data;

final class PostSubmitRequest extends Data
{
    public function __construct(
        #[Required, BooleanType]
        public readonly bool $is_paid,
    ) {
    }
}
