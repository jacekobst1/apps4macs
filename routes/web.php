<?php

use App\Http\Controllers\AppController;
use App\Http\Controllers\Auth\MagicLoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TestController;
use App\Mail\LoginLink;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
 * My routes
 */
// Login
Route::get('/login', [
    MagicLoginController::class,
    'getMagicLogin'
])->name('login');
Route::post('/login', [
    MagicLoginController::class,
    'postMagicLogin'
]);
Route::get('/check-email', fn() => Inertia::render('Auth/CheckEmail'));

// App
Route::get('/', fn() => Inertia::render('List'))->name('list');
Route::get('/submit-app', fn() => Inertia::render('SubmitApp'));
Route::post('/submit-app', [AppController::class, 'postSubmitApp']);
Route::get('/create-app', fn() => Inertia::render('SubmitApp'));

// Test
Route::get('/test', [TestController::class, 'getTest']);
Route::get('/test-mail', fn() => (new LoginLink('apps4macs.test'))->render());

// Stripe
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
