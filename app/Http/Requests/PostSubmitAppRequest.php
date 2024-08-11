<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Http\UploadedFile;
use Spatie\LaravelData\Attributes\Validation\ActiveUrl;
use Spatie\LaravelData\Attributes\Validation\Bail;
use Spatie\LaravelData\Attributes\Validation\File;
use Spatie\LaravelData\Attributes\Validation\Url;
use Spatie\LaravelData\Data;

final class PostSubmitAppRequest extends Data
{
    public function __construct(
        #[Bail, Url, ActiveUrl]
        public readonly string $url,

        #[File]
        public readonly UploadedFile $logo,

        public readonly string $title,

        public readonly string $sentence,

        public readonly string $description,

        public readonly bool $is_paid,
    ) {
    }
}
