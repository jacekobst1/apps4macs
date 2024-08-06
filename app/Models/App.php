<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class App extends Model
{
    use HasUuids;
    use HasFactory;

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

    /**
     * Scope a query to only include active users.
     */
    public function scopeFree(Builder $query): void
    {
        $query->whereIsPaid(false);
    }
}
