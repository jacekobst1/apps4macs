<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Http\UploadedFile;
use Spatie\LaravelData\Attributes\Validation\File;
use Spatie\LaravelData\Data;

final class PutUpdateAppRequest extends Data
{
    public function __construct(
        #[File]
        public readonly ?UploadedFile $logo,
        public readonly string $title,
        public readonly string $sentence,
        public readonly string $description,
    ) {
    }
}
