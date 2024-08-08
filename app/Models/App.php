<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * @mixin IdeHelperApp
 */
class App extends Model implements HasMedia
{
    use HasUuids;
    use HasFactory;
    use InteractsWithMedia;

    protected $fillable = [
        'url',
        'logo',
        'title',
        'sentence',
        'description',
        'is_paid',
    ];

    /**
     * Scopes
     */
    public function scopePaid(Builder $query): void
    {
        $query->whereIsPaid(true);
    }

    public function scopeFree(Builder $query): void
    {
        $query->whereIsPaid(false);
    }


    /**
     * Spatie media-library
     */
    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('logo')
            ->singleFile()
            ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/webp', 'image/svg+xml']);
    }

    /**
     * @throws FileIsTooBig
     * @throws FileDoesNotExist
     */
    public function addLogo(UploadedFile $file): void
    {
        $this->addMedia($file)
            ->usingFileName(Str::random())
            ->toMediaCollection('logo');
    }
}
