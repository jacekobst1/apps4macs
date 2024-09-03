<?php

declare(strict_types=1);

namespace App\Services\Internal;

use App\Enums\Coupon;
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
    public function initStripeCheckout(PriceType $priceType, bool $isPaid, bool $firstMonthDiscount = false): Checkout
    {
        $subscription = Auth::user()
            ->newSubscription(self::DEFAULT_SUBSCRIPTION_TYPE, $priceType->getStripeId());

        if ($firstMonthDiscount && $priceType->isMonthly()) {
            $subscription->withCoupon(Coupon::FirstMonthOneDollar->getStripeId());
        }

        return $subscription->checkout([
            'payment_method_types' => ['card', 'paypal'],
            'success_url' => route(
                'new-app.submit',
                [
                    'session_id' => '{CHECKOUT_SESSION_ID}',
                    'is_paid' => $isPaid,
                ]
            ),
            'cancel_url' => route('home'),
        ]);
    }
}
