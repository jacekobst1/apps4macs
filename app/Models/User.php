<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable as IAuthenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Config;
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

    protected function isStripeCustomer(): Attribute
    {
        return Attribute::make(
            get: fn(): bool => $this->hasStripeId(),
        );
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
        return $this->apps()->submittedOrActive()->count() > 0;
    }

    public function getNumberOfAllowedApps(): int
    {
        return $this->subscriptions()->active()->count();
    }

    public function canCreateApp(bool $isPaid): bool
    {
        if ($this->email === Config::get('env.admin_email')) {
            return true;
        }

        $currentApps = $this->apps()->submittedOrActive()->count();
        $currentFreeApps = $this->apps()->free()->submittedOrActive()->count();
        $allowedApps = $this->getNumberOfAllowedApps();

        // If this is a free app and no free apps currently exist, allow it
        if (!$isPaid && $currentFreeApps === 0) {
            return true;
        }

        // Subtract the first free app from the current app count, if it exists
        if ($currentFreeApps > 0) {
            $currentApps--;
        }

        return $allowedApps > $currentApps;
    }

    public function canUseFirstMonthDiscount(): bool
    {
        return !$this->subscriptions()->exists();
    }
}
