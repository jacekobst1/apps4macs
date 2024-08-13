<?php

use App\Http\Controllers\AppController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\StripeController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomepageController::class, 'getHomepage'])->name('homepage');

Route::get('/sign-up', [AppController::class, 'getSignup']);
Route::post('/sign-up', [AppController::class, 'postSignup']);

Route::get('/subscription-checkout', [StripeController::class, 'getSubscriptionCheckout']);

Route::middleware(['auth', 'verified'])->group(function () {
    Route::prefix('new-app')->group(function () {
        Route::get('/specify-if-paid', [AppController::class, 'getSpecifyIfPaid'])->name('new-app.specify-if-paid');
        Route::get('/submit', [AppController::class, 'getSubmit'])->name('new-app.submit');
        Route::post('/submit', [AppController::class, 'postSubmit']);
    });
});

require __DIR__ . '/auth.php';
require __DIR__ . '/magic-login.php';
require __DIR__ . '/admin.php';

if (app()->isLocal()) {
    Route::get(
        '/dev/login',
        function () {
            \Illuminate\Support\Facades\Auth::login(User::whereEmail('jacekobst1@gmail.com')->first());
            to_route('homepage');
        }
    );
}
