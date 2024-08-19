<?php

declare(strict_types=1);

namespace App\Services;

use App\Http\Requests\PostChoosePlanRequest;
use App\Services\Internal\StripeService;
use Exception;
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
        $checkout = $this->stripeService->initStripeCheckout($request->price_type, $request->is_paid);

        return Inertia::location($checkout->toArray()['url']);
    }
}
