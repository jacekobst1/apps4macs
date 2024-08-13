<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

Route::prefix('/admin')->group(function () {
    Route::get('/submitted-apps', [AdminController::class, 'getSubmittedAppsList'])->name('admin.submitted-apps-list');
    Route::get('/submitted-apps/{app}', [AdminController::class, 'getSubmittedApp']);
    Route::post('/submitted-apps/{app}/accept', [AdminController::class, 'accept']);
    Route::post('/submitted-apps/{app}/reject', [AdminController::class, 'reject']);
});
