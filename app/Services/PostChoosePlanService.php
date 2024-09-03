<?php

declare(strict_types=1);

namespace App\Services;

use App\Http\Requests\PostChoosePlanRequest;
use App\Services\Internal\StripeService;
use Exception;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Symfony\Component\HttpFoundation\Response;

final readonly class PostChoosePlanService
{
    public function __construct(private StripeService $stripeService)
    {
    }

    /**
     * @throws Exception
     */
    public function handle(PostChoosePlanRequest $request): Response
    {
        $checkout = $this->stripeService->initStripeCheckout(
            priceType: $request->price_type,
            isPaid: $request->is_paid,
            firstMonthDiscount: Auth::user()->canUseFirstMonthDiscount(),
        );

        return Inertia::location($checkout->toArray()['url']);
    }
}
