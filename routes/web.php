<?php

use App\Http\Controllers\AppController;
use App\Http\Controllers\Auth\MagicLoginController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StripeController;
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

Route::get('/subscription-checkout', [StripeController::class, 'getSubscriptionCheckout']);

Route::get('/login', [MagicLoginController::class, 'getMagicLogin'])->name('login');
Route::post('/login', [MagicLoginController::class, 'postMagicLogin']);
Route::get('/check-email', [MagicLoginController::class, 'getCheckEmail'])->name('check-email');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::prefix('new-app')->group(function () {
        Route::get('/specify-if-paid', [AppController::class, 'getSpecifyIfPaid'])->name('new-app.specify-if-paid');
        Route::get('/submit', [AppController::class, 'getSubmit'])->name('new-app.submit');
    });
});


require __DIR__ . '/auth.php';
