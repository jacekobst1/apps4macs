<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubmitAppRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;
use Inertia\Response;
use Str;
use Throwable;

class AppController extends Controller
{
    /**
     * @throws Throwable
     */
    public function postSubmitApp(SubmitAppRequest $request): Response|JsonResponse
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
            $checkoutUrl = Auth::user()
                ->newSubscription('prod_QZrTafUcZ8hyD6', 'price_1PihkO2K1g0VVPPwg6aerZjo')
                ->allowPromotionCodes()
                ->checkout([
                    'success_url' => env('APP_URL') . '/create-app',
                    'cancel_url' => env('APP_URL') . '/',
                ]);
            return response()->json(['checkoutUrl' => $checkoutUrl]);
        } else {
            return Inertia::render('CreateApp');
        }
    }
}
