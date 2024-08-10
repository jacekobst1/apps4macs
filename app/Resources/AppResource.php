<?php

declare(strict_types=1);

namespace App\Resources;

use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
final class AppResource extends Data
{
    public function __construct(
        public string $id,
        public string $url,
        public string $title,
        public string $sentence,
        public string $description,
        public string $logo_url
    ) {
    }
}
