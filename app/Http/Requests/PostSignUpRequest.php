<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Enums\PriceType;
use Spatie\LaravelData\Attributes\Validation\ActiveUrl;
use Spatie\LaravelData\Attributes\Validation\Email;
use Spatie\LaravelData\Attributes\Validation\Unique;
use Spatie\LaravelData\Attributes\Validation\Url;
use Spatie\LaravelData\Data;

final class PostSignUpRequest extends Data
{
    public function __construct(
        #[Url, ActiveUrl]
        public readonly string $url,

        #[Email, Unique('users', 'email')]
        public readonly string $email,

        public readonly bool $is_paid,

        public readonly ?PriceType $price_type,
    ) {
    }

    public static function messages(): array
    {
        return [
            'email.unique' => 'Mail is already taken. Please log in instead',
        ];
    }
}
