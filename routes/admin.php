<?php

declare(strict_types=1);

use App\Http\Controllers\AdminController;
use App\Http\Middleware\AdminAuth;
use Illuminate\Support\Facades\Route;

Route::prefix('/admin')->middleware(AdminAuth::class)->group(function () {
    Route::get('/submitted-apps', [AdminController::class, 'getSubmittedAppsList'])->name('admin.submitted-apps-list');
    Route::get('/submitted-apps/{app}', [AdminController::class, 'getSubmittedApp']);
    Route::post('/submitted-apps/{app}/accept', [AdminController::class, 'postAccept']);
    Route::post('/submitted-apps/{app}/reject', [AdminController::class, 'postReject']);
});
