<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CarController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Dashboard Routes
|--------------------------------------------------------------------------
| All admin routes are prefixed with /admin
| Protected by 'auth' + 'admin' middleware
*/

// Redirect root to admin login
Route::get('/', fn() => redirect()->route('admin.login'));
// Route::get('/', fn() => redirect('admin/login'));

// Admin auth (guest only)
Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('/login',  [AuthController::class, 'showLogin'])->name('login');
        Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    });

    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout')
        ->middleware('auth');

    // Protected admin routes
    Route::middleware(['auth', 'admin'])->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // Users
        Route::get('/users',       [UserController::class, 'index'])->name('users.index');
        Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');

        // Cars
        Route::get('/cars',               [CarController::class, 'index'])->name('cars.index');
        Route::get('/cars/create',        [CarController::class, 'create'])->name('cars.create');
        Route::post('/cars',              [CarController::class, 'store'])->name('cars.store');
        Route::patch('/cars/{car}/toggle', [CarController::class, 'toggleActive'])->name('cars.toggle');
        Route::delete('/cars/{car}',       [CarController::class, 'destroy'])->name('cars.destroy');

        // Reports
        Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    });
});
