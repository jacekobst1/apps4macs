<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\MyAppsController;
use App\Http\Controllers\NewAppController;
use App\Http\Controllers\StripeController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

require __DIR__ . '/auth.php';
require __DIR__ . '/magic-login.php';
require __DIR__ . '/admin.php';

Route::get('/', [HomeController::class, 'getHome'])->name('home');

Route::get('/sign-up', [NewAppController::class, 'getSignup']);
Route::post('/sign-up', [NewAppController::class, 'postSignup']);

Route::middleware(['auth', 'verified'])->group(function () {
    Route::prefix('new-app')->group(function () {
        Route::get('/specify-if-paid', [NewAppController::class, 'getSpecifyIfPaid'])->name('new-app.specify-if-paid');
        Route::get('/choose-plan', [NewAppController::class, 'getChoosePlan'])->name('new-app.choose-plan');
        Route::post('/choose-plan', [NewAppController::class, 'postChoosePlan']);
        Route::get('/submit', [NewAppController::class, 'getSubmit'])->name('new-app.submit');
        Route::post('/submit', [NewAppController::class, 'postSubmit']);
    });

    Route::get('my-apps', [MyAppsController::class, 'getIndex'])->name('my-apps.index');
    Route::get('my-apps/{app}/edit', [MyAppsController::class, 'getEdit'])->name('my-apps.edit');
    Route::put('my-apps/{app}', [MyAppsController::class, 'putUpdate']);
    Route::delete('my-apps/{app}', [MyAppsController::class, 'delete']);

    Route::get('/billing-portal', [StripeController::class, 'getBillingPortal'])->name('billing-portal');
});

if (app()->isLocal()) {
    Route::get(
        '/dev/login',
        function () {
            \Illuminate\Support\Facades\Auth::login(User::whereEmail('jacekobst1@gmail.com')->first());
            return to_route('home');
        }
    );
}
