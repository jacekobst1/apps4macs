<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile as LaravelUploadedFile;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\FileAdder;
use Symfony\Component\HttpFoundation\File\UploadedFile;

trait InteractsWithHashedMedia
{
    use InteractsWithMedia {
        InteractsWithMedia::addMedia as parentAddMedia;
    }

    public function addMedia(string|UploadedFile $file): FileAdder
    {
        /** @var LaravelUploadedFile $file */
        return $this
            ->parentAddMedia($file)
            ->usingFileName($file->hashName());
    }
}
