<?php

namespace App\Http\Controllers;

use App\Http\Requests\GetSubmitAppRequest;
use App\Http\Requests\GetVerifyPaymentRequest;
use App\Http\Requests\PostChoosePlanRequest;
use App\Http\Requests\PostSubmitAppRequest;
use App\Services\GetSubmitAppService;
use App\Services\PostChoosePlanService;
use App\Services\PostSubmitAppService;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

class NewAppController extends Controller
{
    public function getSpecifyIfPaid(): Response
    {
        return Inertia::render('NewApp/SpecifyIfPaidPage');
    }

    public function getChoosePlan(): Response
    {
        return Inertia::render('NewApp/ChoosePlanPage');
    }

    /**
     * @throws Exception
     */
    public function postChoosePlan(PostChoosePlanRequest $request, PostChoosePlanService $service): SymfonyResponse
    {
        return $service->handle($request);
    }

    public function getVerifyPayment(GetVerifyPaymentRequest $request): RedirectResponse|Response
    {
        if (Auth::user()->canCreateApp($request->is_paid)) {
            return to_route('new-app.submit', ['is_paid' => $request->is_paid]);
        }

        return Inertia::render('NewApp/VerifyPaymentPage', [
            'isPaid' => $request->is_paid,
        ]);
    }

    public function getSubmit(
        GetSubmitAppRequest $request,
        GetSubmitAppService $service
    ): Response|RedirectResponse|null {
        return $service->handle($request);
    }

    /**
     * @throws FileIsTooBig
     * @throws FileDoesNotExist
     */
    public function postSubmit(PostSubmitAppRequest $request, PostSubmitAppService $service): RedirectResponse
    {
        return $service->handle($request);
    }
}
