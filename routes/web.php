<?php

use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\AspirasiController as AdminAspirasiController;
use App\Http\Controllers\Siswa\AuthController as SiswaAuthController;
use App\Http\Controllers\Siswa\DashboardController as SiswaDashboardController;
use App\Http\Controllers\Siswa\AspirasiController as SiswaAspirasiController;
use Illuminate\Support\Facades\Route;



// Admin Routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('login', [AdminAuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AdminAuthController::class, 'login']);
    
    Route::middleware(['admin'])->group(function () {
        Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
        Route::post('aspirasi/{id}/update-status', [AdminAspirasiController::class, 'updateStatus'])->name('aspirasi.update');
        Route::post('logout', [AdminAuthController::class, 'logout'])->name('logout');
    });
});

// Siswa Routes
Route::prefix('siswa')->name('siswa.')->group(function () {
    Route::get('/', function () {
        return view('siswa.home');
    })->name('home');
    
    Route::get('login', [SiswaAuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [SiswaAuthController::class, 'login']);
    Route::get('register', [SiswaAuthController::class, 'showRegisterForm'])->name('register');
    Route::post('register', [SiswaAuthController::class, 'register']);
    
    Route::middleware(['siswa'])->group(function () {
        Route::get('dashboard', [SiswaDashboardController::class, 'index'])->name('dashboard');
        Route::get('aspirasi/create', [SiswaAspirasiController::class, 'create'])->name('aspirasi.create');
        Route::post('aspirasi/store', [SiswaAspirasiController::class, 'store'])->name('aspirasi.store');
        Route::post('logout', [SiswaAuthController::class, 'logout'])->name('logout');
    });
});