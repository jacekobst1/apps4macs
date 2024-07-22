<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AppController extends Controller
{
    public function postSubmitApp(Request $request)
    {
        dd($request->all());
    }
}
