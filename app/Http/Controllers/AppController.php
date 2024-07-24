<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubmitAppRequest;
use Inertia\Inertia;
use Inertia\Response;

class AppController extends Controller
{
    public function postSubmitApp(SubmitAppRequest $request): Response
    {
        return Inertia::render('Auth/CheckEmail');
    }
}
