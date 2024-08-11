<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable as IAuthenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Cashier\Billable;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

use function Illuminate\Events\queueable;

/**
 * @mixin IdeHelperUser
 */
class User extends Authenticatable implements IAuthenticatable, MustVerifyEmail
{
    use HasUuids;
    use HasFactory;
    use Notifiable;
    use Billable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    protected static function booted(): void
    {
        static::updated(queueable(function (User $customer) {
            if ($customer->hasStripeId()) {
                $customer->syncStripeCustomerDetails();
            }
        }));
    }

    // Needed for properly generating magic link in MagicLoginController
    public function getAuthIdentifier(): UuidInterface
    {
        return Uuid::fromString($this->getKey());
    }


    /**
     * Relations
     */
    public function appTemplate(): HasOne
    {
        return $this->hasOne(AppTemplate::class);
    }

    public function apps(): HasMany
    {
        return $this->hasMany(App::class);
    }

    /**
     * Custom methods
     */
    public function hasAnyApp(): bool
    {
        return $this->apps()->count() > 0;
    }

    public function getNumberOfAllowedApps(): int
    {
        return 1;
    }

    public function canCreateApp(bool $isPaid): bool
    {
        return true; // todo remove

        $userCanCreateNewApp = true; // $user->numberOfAllowedApps > $user->paidApps->count()
        if (!$isPaid) {
            return $this->apps()->free()->count() === 0;
        }

        return $this->getNumberOfAllowedApps() > $this->apps()->paid()->count();
    }
}
