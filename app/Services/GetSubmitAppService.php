<?php

declare(strict_types=1);

namespace App\Services;

use App\Http\Requests\GetSubmitAppRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;
use Laravel\Cashier\Cashier;
use Stripe\Exception\ApiErrorException;

final readonly class GetSubmitAppService
{
    /**
     * @throws ApiErrorException
     */
    public function handle(GetSubmitAppRequest $request): Response|RedirectResponse|null
    {
        if (
            Auth::user()->canCreateApp($request->is_paid)
            || $this->userJustPaid($request->session_id)
        ) {
            return $this->renderSubmitPage($request->is_paid);
        }

        return to_route('new-app.choose-plan');
    }

    /**
     * @throws ApiErrorException
     */
    private function userJustPaid(?string $sessionId): bool
    {
        if (!$sessionId) {
            return false;
        }

        $session = Cashier::stripe()->checkout->sessions->retrieve($sessionId);

        return $session->payment_status === 'paid';
    }


    private function renderSubmitPage(bool $isPaid): Response
    {
        $templateUrl = Auth::user()->appTemplate?->url;

        return Inertia::render('NewApp/SubmitAppPage', [
            'is_paid' => $isPaid,
            'template_url' => $templateUrl,
        ]);
    }
}
