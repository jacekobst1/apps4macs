<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Requests\PostMagicLoginRequest;
use App\Mail\LoginLinkMail;
use App\Models\User;
use Grosv\LaravelPasswordlessLogin\PasswordlessLogin;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Mail;
use Inertia\Inertia;
use Inertia\Response;

final readonly class MagicLoginController
{
    public function getMagicLogin(): Response
    {
        return Inertia::render('Auth/MagicLogin');
    }

    public function postMagicLogin(PostMagicLoginRequest $request): RedirectResponse
    {
        $user = User::whereEmail($request->email)->firstOrFail();

        $url = PasswordlessLogin::forUser($user)
            ->setRedirectUrl('/')
            ->generate();

        Mail::to($request->email)->queue(new LoginLinkMail($url));

        return to_route('check-email');
    }

    public function getCheckEmail(): Response
    {
        return Inertia::render('Auth/CheckEmail');
    }
}
