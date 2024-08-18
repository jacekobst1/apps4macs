<?php

declare(strict_types=1);

namespace App\Services;

use App\Http\Requests\PostSignUpRequest;
use App\Models\User;
use Exception;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Inertia\Response;
use Laravel\Cashier\Checkout;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

final readonly class PostSignUpService
{
    /**
     * @throws Exception
     */
    public function handle(PostSignUpRequest $request): Response|SymfonyResponse
    {
        $user = $this->createUser($request);
        $this->createAppTemplate($user, $request);
        $this->login($user);

        if ($request->is_paid) {
            $checkout = $this->initStripeCheckout($request);

            return Inertia::location($checkout->toArray()['url']);
        }

        return to_route('new-app.submit', ['is_paid' => $request->is_paid]);
    }

    private function createUser(PostSignUpRequest $request): User
    {
        /** @var User $user */
        $user = User::create([
            'email' => $request->email,
            'name' => strstr($request->email, '@', true),
            'password' => Hash::make(Str::random(32)),
        ]);

        event(new Registered($user));

        return $user;
    }

    private function createAppTemplate(User $user, PostSignUpRequest $request): void
    {
        $user->appTemplate()->create([
            'url' => $request->url,
        ]);
    }

    private function login(User $user): void
    {
        Auth::login($user);
    }

    /**
     * @throws Exception
     */
    private function initStripeCheckout(PostSignUpRequest $request): Checkout
    {
        return Auth::user()
            ->newSubscription('prod_QZrTafUcZ8hyD6', $request->price_type->getStripeId())
            ->allowPromotionCodes()
            ->checkout([
                'success_url' => route('new-app.submit', ['is_paid' => $request->is_paid]),
                'cancel_url' => route('homepage'),
            ]);
    }
}
