<?php

namespace App\Http\Controllers;

use App\Http\Requests\SignUpRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;
use Inertia\Response;
use Str;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;
use Throwable;

class AppController extends Controller
{
    public function getSignUp(): Response
    {
        return Inertia::render('SignUp');
    }

    /**
     * @throws Throwable
     */
    public function postSignUp(SignUpRequest $request): Response|SymfonyResponse
    {
        /** @var User $user */
        $user = User::create([
            'email' => $request->email,
            'name' => strstr($request->email, '@', true),
            'password' => Hash::make(Str::random(32)),
        ]);

        $user->appTemplate()->create([
            'url' => $request->url,
        ]);

        Auth::login($user);

        // TODO choose a subscription type on frontend first and send it in $request
        if ($request->isPaid) {
            $checkout = Auth::user()
                ->newSubscription('prod_QZrTafUcZ8hyD6', 'price_1PihkO2K1g0VVPPwg6aerZjo')
                ->allowPromotionCodes()
                ->checkout([
                    'success_url' => route('submit-app'),
                    'cancel_url' => route('list'),
                ]);
            return Inertia::location($checkout->toArray()['url']);
        } else {
            return to_route('submit-app');
        }
    }

    public function getSubmitApp(): Response
    {
        return Inertia::render('SubmitApp');
    }

    public function postSubmitApp(): void
    {
        // todo
    }
}
