<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Spatie\LaravelData\Attributes\Validation\ActiveUrl;
use Spatie\LaravelData\Attributes\Validation\Email;
use Spatie\LaravelData\Attributes\Validation\Unique;
use Spatie\LaravelData\Attributes\Validation\Url;
use Spatie\LaravelData\Data;

final class SignUpRequest extends Data
{
    public function __construct(
        #[Url, ActiveUrl]
        public readonly string $url,

        #[Email, Unique('users', 'email')]
        public readonly string $email,

        public readonly bool $isPaid,
    ) {
    }

    public static function messages(): array
    {
        return [
            'email.unique' => 'Mail is already taken. Please log in instead',
        ];
    }
}
