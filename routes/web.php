<?php

use App\Http\Controllers\AppController;
use App\Http\Controllers\Auth\MagicLoginController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/**
 * Laravel routes
 */
//Route::get('/', function () {
//    return Inertia::render('Welcome', [
//        'canLogin' => Route::has('login'),
//        'canRegister' => Route::has('register'),
//        'laravelVersion' => Application::VERSION,
//        'phpVersion' => PHP_VERSION,
//    ]);
//});

//Route::get('/dashboard', function () {
//    return Inertia::render('Dashboard');
//})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/**
 * My routes -----------------------------------------------------------------------------------------------------------
 */
Route::get('/', [HomepageController::class, 'getHomepage'])->name('homepage');

Route::get('/sign-up', [AppController::class, 'getSignup']);
Route::post('/sign-up', [AppController::class, 'postSignup']);

Route::get('/login', [MagicLoginController::class, 'getMagicLogin'])->name('login');
Route::post('/login', [MagicLoginController::class, 'postMagicLogin']);
Route::get('/check-email', [MagicLoginController::class, 'getCheckEmail'])->name('check-email');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/submit-app', [AppController::class, 'getSubmitApp'])->name('submit-app');
});

// Stripe (todo move to separate controller)
Route::get('/subscription-checkout', function (Request $request) {
    return \Illuminate\Support\Facades\Auth::user()
        ->newSubscription('prod_QZrTafUcZ8hyD6', 'price_1PihkO2K1g0VVPPwg6aerZjo')
        ->allowPromotionCodes()
        ->checkout([
            'success_url' => env('APP_URL') . '/dashboard',
            'cancel_url' => env('APP_URL') . '/submit-app',
        ]);
});

require __DIR__ . '/auth.php';
