<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\StaffLoginController;
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\AdminLaporanController;
use App\Http\Controllers\StaffLaporanController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\AdminController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('laporan', LaporanController::class);
});

// Staff login routes
Route::get('/staff/login', [StaffLoginController::class, 'showLoginForm'])->name('staff.login');
Route::post('/staff/login', [StaffLoginController::class, 'login'])->name('staff.login.submit');
Route::post('/staff/logout', [StaffLoginController::class, 'logout'])->name('staff.logout');

// Staff dashboard (after login)
Route::middleware('auth:staff')->group(function () {
    Route::get('/staff/dashboard', function () {
        return view('staff-dashboard');
    })->name('staff.dashboard');
    Route::get('/staff/laporan', function () {
        return view('laporan.index-staff');
    })->name('staff.laporan.index');
    Route::get('/staff/laporan', [StaffLaporanController::class, 'index'])->name('staff.laporan.index');
    Route::get('/staff/laporan/create', [StaffLaporanController::class, 'create'])->name('staff.laporan.create');
    Route::post('/staff/laporan', [StaffLaporanController::class, 'store'])->name('staff.laporan.store');
    Route::get('/staff/laporan/{laporan}/edit', [StaffLaporanController::class, 'edit'])->name('staff.laporan.edit');
    Route::put('/staff/laporan/{laporan}', [StaffLaporanController::class, 'update'])->name('staff.laporan.update');
    Route::delete('/staff/laporan/{laporan}', [StaffLaporanController::class, 'destroy'])->name('staff.laporan.destroy');
});
// Admin login routes
Route::get('/admin/login', [AdminLoginController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminLoginController::class, 'login'])->name('admin.login.submit');
Route::post('/admin/logout', [AdminLoginController::class, 'logout'])->name('admin.logout');

// Admin dashboard (after login)
Route::middleware('auth:admin')->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin-dashboard');
    })->name('admin.dashboard');
    Route::get('/admin/laporan', function () {
        return view('laporan.index-admin');
    })->name('admin.laporan.index');
    Route::get('/admin/laporan', [AdminLaporanController::class, 'index'])->name('admin.laporan.index');
    Route::get('/admin/laporan/create', [AdminLaporanController::class, 'create'])->name('admin.laporan.create');
    Route::post('/admin/laporan', [AdminLaporanController::class, 'store'])->name('admin.laporan.store');
    Route::get('/admin/laporan/{laporan}/edit', [AdminLaporanController::class, 'edit'])->name('admin.laporan.edit');
    Route::put('/admin/laporan/{laporan}', [AdminLaporanController::class, 'update'])->name('admin.laporan.update');
    Route::delete('/admin/laporan/{laporan}', [AdminLaporanController::class, 'destroy'])->name('admin.laporan.destroy');
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('users', UserController::class);
        Route::resource('staff', StaffController::class);
        Route::resource('admin', AdminController::class);
    });
});



require __DIR__ . '/auth.php';
