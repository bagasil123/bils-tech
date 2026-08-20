<?php

use App\Http\Controllers\Admin\AccountController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');

/*
|--------------------------------------------------------------------------
| Auth Routes (Login only — no registration)
|--------------------------------------------------------------------------
*/
Route::get('/login', [App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'create'])
    ->middleware('guest')
    ->name('login');

Route::post('/login', [App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'store'])
    ->middleware('guest');

Route::post('/logout', [App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

/*
|--------------------------------------------------------------------------
| Admin Routes (Protected by auth middleware)
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->middleware('auth')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Profile (singleton — no index/create/delete)
    Route::get('/profile',       [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile',     [ProfileController::class, 'update'])->name('profile.update');

    // Account (email & password)
    Route::get('/account',       [AccountController::class, 'edit'])->name('account.edit');
    Route::patch('/account',     [AccountController::class, 'update'])->name('account.update');

    // Categories
    Route::resource('categories', CategoryController::class)->except(['show']);

    // Projects
    Route::resource('projects', ProjectController::class)->except(['show']);
});
