<?php

namespace App\Models;

use App\Enums\AppStatus;
use App\Traits\InteractsWithHashedMedia;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
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
    use InteractsWithHashedMedia;

    protected $fillable = [
        'url',
        'logo',
        'title',
        'sentence',
        'description',
        'is_paid',
    ];

    protected $appends = [
        'logo_url',
    ];

    protected $casts = [
        'status' => AppStatus::class,
    ];

    /**
     * Relations
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

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
     * Mutators & Accessors
     */
    protected function logoUrl(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->getFirstMediaUrl('logo'),
        );
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
        $this->addMedia($file)->toMediaCollection('logo');
    }
}
