<?php

declare(strict_types=1);

namespace App\Services;

use App\Http\Requests\PostChoosePlanRequest;
use Exception;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Laravel\Cashier\Checkout;
use Symfony\Component\HttpFoundation\Response;

final readonly class PostChoosePlanService
{
    /**
     * @throws Exception
     */
    public function handle(PostChoosePlanRequest $request): Response
    {
        $checkout = $this->initStripeCheckout($request);

        return Inertia::location($checkout->toArray()['url']);
    }

    /**
     * @throws Exception
     */
    private function initStripeCheckout(PostChoosePlanRequest $request): Checkout
    {
        return Auth::user()
            ->newSubscription('prod_QZrTafUcZ8hyD6', $request->price_type->getStripeId())
            ->allowPromotionCodes()
            ->checkout([
                'success_url' => route('new-app.submit', ['is_paid' => $request->is_paid]),
                'cancel_url' => route('homepage'),
            ]);
    }
}
