<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Spatie\LaravelData\Attributes\Validation\ActiveUrl;
use Spatie\LaravelData\Attributes\Validation\Email;
use Spatie\LaravelData\Attributes\Validation\Url;
use Spatie\LaravelData\Data;

final class SubmitAppRequest extends Data
{
    function __construct(
        #[Url, ActiveUrl]
        public readonly string $url,

        #[Email]
        public readonly string $email,

        public readonly bool $isPaid,
    ) {
    }
}
