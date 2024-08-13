<?php

declare(strict_types=1);

namespace App\Resources;

use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
final class UserResource extends Data
{
    public function __construct(
        public string $email,
    ) {
    }
}
