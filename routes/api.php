<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CarController;
use App\Http\Controllers\Api\PreferenceController;
use App\Http\Controllers\Api\ReportController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Mobile API Routes
|--------------------------------------------------------------------------
| Prefix: /api
| Auth: Laravel Sanctum (Bearer token)
*/

// Public routes (no token needed)
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login',    [AuthController::class, 'login']);

// Protected routes (Bearer token required)
Route::middleware('auth:sanctum')->group(function () {

    // Auth
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me',      [AuthController::class, 'me']);

    // Cars
    Route::get('/cars', [CarController::class, 'index']);

    // Preferences (swipes)
    Route::get('/preferences',         [PreferenceController::class, 'index']);
    Route::post('/preferences',        [PreferenceController::class, 'store']);
    Route::post('/preferences/sync',   [PreferenceController::class, 'sync']); // batch offline sync

    // Reports
    Route::get('/reports', [ReportController::class, 'index']);
});
