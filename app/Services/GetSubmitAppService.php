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

        if (!$user->canCreateApp($request->is_paid)) {
            return to_route('new-app.choose-plan');
        }

        $templateUrl = $this->getTemplateAppUrl();

        return $this->renderSubmitPage($request, $templateUrl);
    }

    private function getTemplateAppUrl(): ?string
    {
        return Auth::user()->hasAnyApp()
            ? null
            : Auth::user()->appTemplate->url;
    }

    private function renderSubmitPage(GetSubmitAppRequest $request, ?string $templateUrl): Response
    {
        return Inertia::render('NewApp/SubmitApp', [
            'is_paid' => $request->is_paid,
            'template_url' => $templateUrl,
        ]);
    }
}
