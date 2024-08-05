<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Spatie\LaravelData\Attributes\Validation\Email;
use Spatie\LaravelData\Attributes\Validation\Exists;
use Spatie\LaravelData\Data;

final class PostMagicLoginRequest extends Data
{
    public function __construct(
        #[Email, Exists('users', 'email')]
        public readonly string $email,
    ) {
    }

    public static function messages(): array
    {
        return [
            'email.exists' => 'Account not found. If you want to create one, submit your app first.',
        ];
    }
}
