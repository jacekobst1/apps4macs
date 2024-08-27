<?php

declare(strict_types=1);

namespace App\Services\Internal;

use App\Enums\PriceType;
use Exception;
use Illuminate\Support\Facades\Auth;
use Laravel\Cashier\Checkout;

final readonly class StripeService
{
    public const DEFAULT_SUBSCRIPTION_TYPE = 'prod_QZrTafUcZ8hyD6';

    /**
     * @throws Exception
     */
    public function initStripeCheckout(PriceType $priceType, bool $isPaid): Checkout
    {
        return Auth::user()
            ->newSubscription(self::DEFAULT_SUBSCRIPTION_TYPE, $priceType->getStripeId())
            ->allowPromotionCodes()
            ->checkout([
                'success_url' => route('new-app.verify-payment', ['is_paid' => $isPaid]),
                'cancel_url' => route('home'),
            ]);
    }
}
