<?php

declare(strict_types=1);

namespace App\Resources;

use App\Enums\AppStatus;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
final class AppResource extends Data
{
    public function __construct(
        public string $id,
        public AppStatus $status,
        public string $url,
        public string $title,
        public string $sentence,
        public string $description,
        public bool $is_paid,
        public string $logo_url,
        public ?int $order,
        public ?UserResource $user,
        public ?string $created_at,
    ) {
    }
}
