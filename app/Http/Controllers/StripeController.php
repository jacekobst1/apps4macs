<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Support\Facades\Auth;
use Laravel\Cashier\Checkout;

class StripeController extends Controller
{
    /**
     * @throws Exception
     */
    public function getSubscriptionCheckout(): Checkout
    {
        return Auth::user()
            ->newSubscription('prod_QZrTafUcZ8hyD6', 'price_1PihkO2K1g0VVPPwg6aerZjo')
            ->allowPromotionCodes()
            ->checkout([
                'success_url' => route('new-app.submit'),
                'cancel_url' => route('homepage')
            ]);
    }
}
