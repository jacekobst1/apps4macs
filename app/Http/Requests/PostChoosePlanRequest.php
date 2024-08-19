<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Enums\PriceType;
use Spatie\LaravelData\Data;

final class PostChoosePlanRequest extends Data
{
    public function __construct(
        public readonly bool $is_paid,
        public readonly ?PriceType $price_type,
    ) {
    }
}
