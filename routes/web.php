<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FileController;
use Illuminate\Support\Facades\Route;


Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login-form');
	Route::post('/login', [AuthController::class, 'login'])->name('login');
	Route::redirect('/', 'login');
});


Route::middleware('auth:web')->group(function() {
	Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
	Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
	Route::post('/upload-file', [FileController::class, 'upload'])->name('upload-file');
});
