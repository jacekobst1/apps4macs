<?php

use App\Http\Controllers\AdminController;
use App\Http\Middleware\AdminAuth;
use Illuminate\Support\Facades\Route;

// TODO guard it with some email middleware
Route::prefix('/admin')->middleware(AdminAuth::class)->group(function () {
    Route::get('/submitted-apps', [AdminController::class, 'getSubmittedAppsList'])->name('admin.submitted-apps-list');
    Route::get('/submitted-apps/{app}', [AdminController::class, 'getSubmittedApp']);
    Route::post('/submitted-apps/{app}/accept', [AdminController::class, 'accept']);
    Route::post('/submitted-apps/{app}/reject', [AdminController::class, 'reject']);
});
