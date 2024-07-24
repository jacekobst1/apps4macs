<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubmitAppRequest;
use App\Models\User;
use Grosv\LaravelPasswordlessLogin\PasswordlessLogin;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;
use Inertia\Response;
use Str;

class AppController extends Controller
{
    public function postSubmitApp(SubmitAppRequest $request): Response
    {
        $user = User::create([
            'email' => $request->email,
            'name' => strstr($request->email, '@', true),
            'password' => Hash::make(Str::random(32)),
        ]);

        $url = PasswordlessLogin::forUser($user)
            ->setRedirectUrl('/list')
            ->generate();

        dump($url);
        // Send $url in an email or text message to your user

        return Inertia::render('Auth/CheckEmail');
    }
}
