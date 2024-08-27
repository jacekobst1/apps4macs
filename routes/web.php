<?php

declare(strict_types=1);

use App\Http\Controllers\HomeController;
use App\Http\Controllers\MyAppsController;
use App\Http\Controllers\NewAppController;
use App\Http\Controllers\SignUpController;
use App\Http\Controllers\StripeController;
use Illuminate\Support\Facades\Route;

require __DIR__ . '/dev.php';
require __DIR__ . '/admin.php';
require __DIR__ . '/magic-login.php';
require __DIR__ . '/auth.php';

// Non registered
Route::get('/', [HomeController::class, 'getHome'])->name('home');
Route::get('/sign-up', [SignUpController::class, 'getSignUp']);
Route::post('/sign-up', [SignUpController::class, 'postSignUp']);

// Logged in
Route::middleware(['auth', 'verified'])->group(function () {
    Route::prefix('new-app')->group(function () {
        Route::get('/specify-if-paid', [NewAppController::class, 'getSpecifyIfPaid'])->name('new-app.specify-if-paid');
        Route::get('/choose-plan', [NewAppController::class, 'getChoosePlan'])->name('new-app.choose-plan');
        Route::post('/choose-plan', [NewAppController::class, 'postChoosePlan']);
//        Route::get('/verify-payment', [NewAppController::class, 'getVerifyPayment'])->name('new-app.verify-payment');
        Route::get('/submit', [NewAppController::class, 'getSubmit'])->name('new-app.submit');
        Route::post('/submit', [NewAppController::class, 'postSubmit']);
    });

    Route::prefix('my-apps')->group(function () {
        Route::get('/', [MyAppsController::class, 'getIndex'])->name('my-apps.index');
        Route::get('/{app}/edit', [MyAppsController::class, 'getEdit'])->name('my-apps.edit');
        Route::put('/{app}', [MyAppsController::class, 'putUpdate']);
        Route::delete('/{app}', [MyAppsController::class, 'delete']);
    });

    Route::get('/billing-portal', [StripeController::class, 'getBillingPortal'])->name('billing-portal');
});
