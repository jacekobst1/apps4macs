<?php

declare(strict_types=1);

namespace App\Services;

use App\Http\Requests\PostSignUpRequest;
use App\Models\User;
use App\Services\Internal\StripeService;
use Exception;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Inertia\Response;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

final readonly class PostSignUpService
{
    public function __construct(private StripeService $stripeService)
    {
    }

    /**
     * @throws Exception
     */
    public function handle(PostSignUpRequest $request): Response|SymfonyResponse
    {
        $user = $this->createUser($request);
        $this->createAppTemplate($user, $request);
        $this->login($user);

        if ($request->is_paid) {
            $checkout = $this->stripeService->initStripeCheckout($request->price_type, $request->is_paid, true);

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
}
