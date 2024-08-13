<?php

use App\Http\Controllers\Auth\MagicLoginController;

Route::get('/login', [MagicLoginController::class, 'getMagicLogin'])->name('login');
Route::post('/login', [MagicLoginController::class, 'postMagicLogin']);
Route::get('/check-email', [MagicLoginController::class, 'getCheckEmail'])->name('check-email');
