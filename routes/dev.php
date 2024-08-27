<?php

declare(strict_types=1);

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Route;

$envMatch = !app()->isProduction();
$ipMatch = in_array(request()->ip(), ['127.0.0.1', Config::get('env.admin_ip')]);

if ($envMatch && $ipMatch) {
    Route::get('/dev/login', function () {
        $adminEmail = Config::get('env.admin_email');
        $user = User::whereEmail($adminEmail)->first();
        Auth::login($user);

        return to_route('home');
    });
}
