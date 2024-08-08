<?php

namespace App\Http\Controllers;

use App\Http\Requests\GetSubmitRequest;
use App\Http\Requests\PostSignUpRequest;
use App\Http\Requests\PostSubmitRequest;
use App\Models\App;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;
use Inertia\Response;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;
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
    public function postSignUp(PostSignUpRequest $request): Response|SymfonyResponse
    {
        /** @var User $user */
        $user = User::create([
            'email' => $request->email,
            'name' => strstr($request->email, '@', true),
            'password' => Hash::make(Str::random(32)),
        ]);

        event(new Registered($user));

        $user->appTemplate()->create([
            'url' => $request->url,
        ]);

        Auth::login($user);

        // TODO choose a subscription type on frontend first and send it in $request
        if ($request->is_paid) {
            $checkout = Auth::user()
                ->newSubscription('prod_QZrTafUcZ8hyD6', 'price_1PihkO2K1g0VVPPwg6aerZjo')
                ->allowPromotionCodes()
                ->checkout([
                    'success_url' => route('new-app.submit', ['is_paid' => $request->is_paid]),
                    'cancel_url' => route('homepage'),
                ]);
            return Inertia::location($checkout->toArray()['url']);
        } else {
            return to_route('new-app.submit', ['is_paid' => $request->is_paid]);
        }
    }

    public function getSpecifyIfPaid(): Response
    {
        return Inertia::render('SpecifyIfPaid');
    }

    public function getSubmit(GetSubmitRequest $request): Response|RedirectResponse|null
    {
        if (Auth::user()->canCreateApp($request->is_paid)) {
            return Inertia::render('SubmitApp', [
                'is_paid' => $request->is_paid,
            ]);
        }

        if ($request->is_paid) {
            // return subscription page
        }

        // todo display this as toast and redirect to subscription page
        session()->flash('validationMessage', 'You can have only one free app without subscription');

        return to_route('new-app.specify-if-paid');
    }

    /**
     * @throws FileIsTooBig
     * @throws FileDoesNotExist
     */
    public function postSubmit(PostSubmitRequest $request): RedirectResponse
    {
        if (!Auth::user()->canCreateApp($request->is_paid)) {
            // return subscription page
        }

        /** @var App $app */
        $app = Auth::user()->apps()->create([
            'url' => $request->url,
            'title' => $request->title,
            'sentence' => $request->sentence,
            'description' => $request->description,
            'is_paid' => $request->is_paid,
        ]);

        $app->addLogo($request->logo);

        return to_route('homepage');
    }
}
