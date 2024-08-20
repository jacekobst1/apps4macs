<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostSignUpRequest;
use App\Services\PostSignUpService;
use Inertia\Inertia;
use Inertia\Response;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;
use Throwable;

class SignUpController extends Controller
{
    public function getSignUp(): Response
    {
        return Inertia::render('SignUp/SignUpPage');
    }

    /**
     * @throws Throwable
     */
    public function postSignUp(PostSignUpRequest $request, PostSignUpService $service,): Response|SymfonyResponse
    {
        return $service->handle($request);
    }
}
