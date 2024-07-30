<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubmitAppRequest;
use App\Mail\LoginLink;
use App\Models\User;
use Grosv\LaravelPasswordlessLogin\PasswordlessLogin;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Inertia\Inertia;
use Inertia\Response;
use Str;

class AppController extends Controller
{
    public function postSubmitApp(SubmitAppRequest $request): Response
    {
        /** @var User&Authenticatable $user */
        $user = User::create([
            'email' => $request->email,
            'name' => strstr($request->email, '@', true),
            'password' => Hash::make(Str::random(32)),
        ]);

        // save template app

        $url = PasswordlessLogin::forUser($user)
            ->setRedirectUrl('/list')
            ->generate();

        Mail::to('jacekobst1@gmail.com')->queue(new LoginLink($url));

        return Inertia::render('Auth/CheckEmail');
    }
}
