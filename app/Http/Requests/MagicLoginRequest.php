<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Spatie\LaravelData\Attributes\Validation\Email;
use Spatie\LaravelData\Attributes\Validation\Exists;
use Spatie\LaravelData\Data;

final class MagicLoginRequest extends Data
{
    public function __construct(
        #[Email, Exists('users', 'email')]
        public readonly string $email,
    ) {
    }
}
