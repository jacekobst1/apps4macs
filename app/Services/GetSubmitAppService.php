<?php

declare(strict_types=1);

namespace App\Services;

use App\Http\Requests\GetSubmitAppRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

final readonly class GetSubmitAppService
{
    public function handle(GetSubmitAppRequest $request): Response|RedirectResponse|null
    {
        $user = Auth::user();

        $templateUrl = $this->getTemplateAppUrl();

        if ($user->canCreateApp($request->is_paid)) {
            return $this->renderSubmitPage($request, $templateUrl);
        }

        if ($request->is_paid) {
            // return subscription page
        }

        // todo display this as toast and redirect to subscription page
        session()->flash('validationMessage', 'You can have only one free app without subscription');

        return to_route('new-app.specify-if-paid');
    }

    private function getTemplateAppUrl(): ?string
    {
        return Auth::user()->hasAnyApp()
            ? null
            : Auth::user()->appTemplate->url;
    }

    private function renderSubmitPage(GetSubmitAppRequest $request, string $templateUrl): Response
    {
        return Inertia::render('SubmitApp', [
            'is_paid' => $request->is_paid,
            'template_url' => $templateUrl,
        ]);
    }
}
