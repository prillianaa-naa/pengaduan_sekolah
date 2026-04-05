<?php

<<<<<<< HEAD
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AspirasiController;
use App\Http\Controllers\Admin\SiswaController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Siswa\DashboardController as SiswaDashboardController;
use App\Http\Controllers\Siswa\AspirasiController as SiswaAspirasiController;
use App\Http\Controllers\Siswa\AuthController as SiswaAuthController;

/*
|==========================================================================
| Admin Routes
|==========================================================================
*/
Route::prefix('admin')->name('admin.')->group(function () {
    // Public routes    
    Route::get('login', [AdminAuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AdminAuthController::class, 'login']);
    
    // Protected routes
    Route::middleware('admin')->group(function () {
        Route::post('logout', [AdminAuthController::class, 'logout'])->name('logout');
        
        // Dashboard
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
        
        // Aspirasi/Pengaduan
        Route::get('aspirasi', [AspirasiController::class, 'index'])->name('aspirasi.index');
        Route::get('aspirasi/{id}', [AspirasiController::class, 'show'])->name('aspirasi.show');
        Route::put('aspirasi/{id}', [AspirasiController::class, 'update'])->name('aspirasi.update');  // ← PUT
        Route::delete('aspirasi/{id}', [AspirasiController::class, 'destroy'])->name('aspirasi.destroy');
        
        // Data Siswa
        Route::delete('siswa/{id}', [SiswaController::class, 'destroy'])->name('siswa.destroy');
        Route::get('siswa', [SiswaController::class, 'index'])->name('siswa.index');
        Route::post('siswa', [SiswaController::class, 'store'])->name('siswa.store');
        Route::put('siswa/{id}', [SiswaController::class, 'update'])->name('siswa.update');
        
        // Kategori
        Route::get('kategori', [KategoriController::class, 'index'])->name('kategori.index');
        Route::post('kategori', [KategoriController::class, 'store'])->name('kategori.store');
        Route::put('kategori/{id}', [KategoriController::class, 'update'])->name('kategori.update');
        Route::delete('kategori/{id}', [KategoriController::class, 'destroy'])->name('kategori.destroy');
        
        // Laporan
        Route::get('laporan', [LaporanController::class, 'index'])->name('laporan.index');
        Route::get('laporan/generate', [LaporanController::class, 'generate'])->name('laporan.generate');
        Route::get('laporan/export-pdf', [LaporanController::class, 'exportPDF'])->name('laporan.pdf');
        Route::get('laporan/export-excel', [LaporanController::class, 'exportExcel'])->name('laporan.excel');
   
        });
});

/*
|==========================================================================
| Siswa Routes
|==========================================================================
*/
Route::prefix('siswa')->name('siswa.')->group(function () {
    
    // ✅ Home / Beranda
=======
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
>>>>>>> 722639d6daabffc6f303b1c182c07a331f2f6475
    Route::get('/', function () {
        return view('siswa.home');
    })->name('home');
    
<<<<<<< HEAD
    // ✅ Auth Public
    Route::get('login', [SiswaAuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [SiswaAuthController::class, 'login'])->name('login.post');
    Route::get('register', [SiswaAuthController::class, 'showRegisterForm'])->name('register');
    Route::post('register', [SiswaAuthController::class, 'register'])->name('register.post');
    
    // ✅ Protected Routes (harus login dulu)
    Route::middleware('siswa')->group(function () {
        
        // Dashboard & Logout
        Route::get('dashboard', [SiswaDashboardController::class, 'index'])->name('dashboard');
        Route::post('logout', [SiswaAuthController::class, 'logout'])->name('logout');
        
        // Aspirasi CRUD
        Route::get('aspirasi/create', [SiswaAspirasiController::class, 'create'])->name('aspirasi.create');
        Route::post('aspirasi/store', [SiswaAspirasiController::class, 'store'])->name('aspirasi.store');
        Route::get('aspirasi/{id}', [SiswaAspirasiController::class, 'show'])->name('aspirasi.show');
        Route::get('aspirasi/{id}/edit', [SiswaAspirasiController::class, 'edit'])->name('aspirasi.edit');
        Route::put('aspirasi/{id}', [SiswaAspirasiController::class, 'update'])->name('aspirasi.update');
        Route::delete('aspirasi/{id}', [SiswaAspirasiController::class, 'destroy'])->name('aspirasi.destroy');
        
    }); // ← End middleware('siswa')
    
}); // ← End prefix('siswa')

// ✅ Home Redirect (di luar group)
Route::get('/', function () {
    return redirect()->route('siswa.home');
=======
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
>>>>>>> 722639d6daabffc6f303b1c182c07a331f2f6475
});