<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GaleriController as AdminGaleriController;
use App\Http\Controllers\Admin\KategoriController as AdminKategoriController;
use App\Http\Controllers\Admin\LayananController as AdminLayananController;
use App\Http\Controllers\Admin\ReservasiController as AdminReservasiController;
use App\Http\Controllers\Admin\StylistController as AdminStylistController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReservasiController;
use Illuminate\Support\Facades\Route;

// ==========================================
// 1. HALAMAN PUBLIK (Bisa diakses semua pengunjung)
// ==========================================
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/layanan', [HomeController::class, 'layanan'])->name('layanan.index');
Route::get('/galeri', [HomeController::class, 'galeri'])->name('galeri.index');

// Reservasi & Cek Kode Booking (Bisa untuk Guest maupun Pelanggan Login)
Route::get('/reservasi', [ReservasiController::class, 'create'])->name('reservasi.create');
Route::post('/reservasi', [ReservasiController::class, 'store'])->name('reservasi.store');
Route::get('/reservasi/cek', [ReservasiController::class, 'cek'])->name('reservasi.cek');
Route::get('/reservasi/{kode}', [ReservasiController::class, 'show'])->name('reservasi.show');

// ==========================================
// 2. AUTENTIKASI (Guest Only & Logout)
// ==========================================
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
});

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

// ==========================================
// 3. AREA PELANGGAN LOGIN (Riwayat & Batal Booking)
// ==========================================
Route::middleware(['auth', 'role:pelanggan'])->group(function () {
    Route::get('/riwayat-reservasi', [ReservasiController::class, 'riwayat'])->name('reservasi.riwayat');
    Route::patch('/reservasi/{kode}/batal', [ReservasiController::class, 'batal'])->name('reservasi.batal');
});

// ==========================================
// 4. AREA ADMIN PANEL
// ==========================================
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::resource('kategori', AdminKategoriController::class)->except(['show']);
        Route::resource('layanan', AdminLayananController::class)->except(['show']);
        Route::resource('stylist', AdminStylistController::class)->except(['show']);
        Route::resource('galeri', AdminGaleriController::class)->only(['index', 'create', 'store', 'destroy']);

        Route::get('/reservasi', [AdminReservasiController::class, 'index'])->name('reservasi.index');
        Route::patch('/reservasi/{reservasi}/status', [AdminReservasiController::class, 'updateStatus'])->name('reservasi.status');
        Route::delete('/reservasi/{reservasi}', [AdminReservasiController::class, 'destroy'])->name('reservasi.destroy');
    });