<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class AppController extends Controller
{
    public function postSubmitApp(Request $request): Response
    {
        return Inertia::render('Auth/CheckEmail');
    }
}
