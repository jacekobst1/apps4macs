<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{use AllowDynamicProperties;use App\Enums\AppStatus;use Database\Factories\AppFactory;use Eloquent;use Illuminate\Database\Eloquent\Builder;use Illuminate\Support\Carbon;use Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection;use Spatie\MediaLibrary\MediaCollections\Models\Media;
/**
 *
 *
 * @property string $id
 * @property string $user_id
 * @property AppStatus $status
 * @property string $url
 * @property string $title
 * @property string $sentence
 * @property string $description
 * @property bool $is_paid
 * @property string|null $verified_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int|null $order
 * @property string|null $last_on_top
 * @property-read mixed $logo_url
 * @property-read MediaCollection<int, Media> $media
 * @property-read int|null $media_count
 * @property-read User $user
 * @method static Builder|App active()
 * @method static AppFactory factory($count = null, $state = [])
 * @method static Builder|App free()
 * @method static Builder|App newModelQuery()
 * @method static Builder|App newQuery()
 * @method static Builder|App paid()
 * @method static Builder|App query()
 * @method static Builder|App submittedOrActive()
 * @method static Builder|App whereCreatedAt($value)
 * @method static Builder|App whereDescription($value)
 * @method static Builder|App whereId($value)
 * @method static Builder|App whereIsPaid($value)
 * @method static Builder|App whereLastOnTop($value)
 * @method static Builder|App whereOrder($value)
 * @method static Builder|App whereSentence($value)
 * @method static Builder|App whereStatus($value)
 * @method static Builder|App whereTitle($value)
 * @method static Builder|App whereUpdatedAt($value)
 * @method static Builder|App whereUrl($value)
 * @method static Builder|App whereUserId($value)
 * @method static Builder|App whereVerifiedAt($value)
 * @mixin Eloquent
 */
	#[AllowDynamicProperties]
	class IdeHelperApp {}
}

namespace App\Models{use AllowDynamicProperties;use Eloquent;use Illuminate\Database\Eloquent\Builder;use Illuminate\Support\Carbon;
/**
 *
 *
 * @property string $id
 * @property string $user_id
 * @property string $url
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|AppTemplate newModelQuery()
 * @method static Builder|AppTemplate newQuery()
 * @method static Builder|AppTemplate query()
 * @method static Builder|AppTemplate whereCreatedAt($value)
 * @method static Builder|AppTemplate whereId($value)
 * @method static Builder|AppTemplate whereUpdatedAt($value)
 * @method static Builder|AppTemplate whereUrl($value)
 * @method static Builder|AppTemplate whereUserId($value)
 * @mixin Eloquent
 */
	#[AllowDynamicProperties]
	class IdeHelperAppTemplate {}
}

namespace App\Models{use AllowDynamicProperties;use Database\Factories\UserFactory;use Eloquent;use Illuminate\Database\Eloquent\Builder;use Illuminate\Database\Eloquent\Collection;use Illuminate\Notifications\DatabaseNotification;use Illuminate\Notifications\DatabaseNotificationCollection;use Illuminate\Support\Carbon;use Laravel\Cashier\Subscription;
/**
 *
 *
 * @property string $id
 * @property string $name
 * @property string $email
 * @property Carbon|null $email_verified_at
 * @property mixed $password
 * @property string|null $remember_token
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $stripe_id
 * @property string|null $pm_type
 * @property string|null $pm_last_four
 * @property string|null $trial_ends_at
 * @property-read AppTemplate|null $appTemplate
 * @property-read Collection<int, App> $apps
 * @property-read int|null $apps_count
 * @property-read DatabaseNotificationCollection<int, DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read Collection<int, Subscription> $subscriptions
 * @property-read int|null $subscriptions_count
 * @method static UserFactory factory($count = null, $state = [])
 * @method static Builder|User hasExpiredGenericTrial()
 * @method static Builder|User newModelQuery()
 * @method static Builder|User newQuery()
 * @method static Builder|User onGenericTrial()
 * @method static Builder|User query()
 * @method static Builder|User whereCreatedAt($value)
 * @method static Builder|User whereEmail($value)
 * @method static Builder|User whereEmailVerifiedAt($value)
 * @method static Builder|User whereId($value)
 * @method static Builder|User whereName($value)
 * @method static Builder|User wherePassword($value)
 * @method static Builder|User wherePmLastFour($value)
 * @method static Builder|User wherePmType($value)
 * @method static Builder|User whereRememberToken($value)
 * @method static Builder|User whereStripeId($value)
 * @method static Builder|User whereTrialEndsAt($value)
 * @method static Builder|User whereUpdatedAt($value)
 * @mixin Eloquent
 */
	#[AllowDynamicProperties]
	class IdeHelperUser {}
}

