<?php

use App\Http\Controllers\HomepageController;
use App\Http\Controllers\MyAppsController;
use App\Http\Controllers\NewAppController;
use App\Http\Controllers\StripeController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

require __DIR__ . '/auth.php';
require __DIR__ . '/magic-login.php';
require __DIR__ . '/admin.php';

Route::get('/', [HomepageController::class, 'getHomepage'])->name('homepage');

Route::get('/sign-up', [NewAppController::class, 'getSignup']);
Route::post('/sign-up', [NewAppController::class, 'postSignup']);

Route::get('/subscription-checkout', [StripeController::class, 'getSubscriptionCheckout']);

Route::middleware(['auth', 'verified'])->group(function () {
    Route::prefix('new-app')->group(function () {
        Route::get('/specify-if-paid', [NewAppController::class, 'getSpecifyIfPaid'])->name('new-app.specify-if-paid');
        Route::get('/submit', [NewAppController::class, 'getSubmit'])->name('new-app.submit');
        Route::post('/submit', [NewAppController::class, 'postSubmit']);
    });

    Route::get('my-apps', [MyAppsController::class, 'getIndex'])->name('my-apps.index');
});

if (app()->isLocal()) {
    Route::get(
        '/dev/login',
        function () {
            \Illuminate\Support\Facades\Auth::login(User::whereEmail('jacekobst1@gmail.com')->first());
            return to_route('homepage');
        }
    );
}
