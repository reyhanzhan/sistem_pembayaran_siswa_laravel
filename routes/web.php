<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\TagihanController;
use App\Http\Controllers\TagihanKepsekController;
use Illuminate\Support\Facades\Route;

// Route autentikasi
Route::get('/', [AuthController::class, 'showLoginForm'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Route yang dilindungi autentikasi
Route::middleware('auth')->group(function () {
    // Menu untuk admin
    Route::middleware('role:admin')->group(function () {
        Route::get('/siswa', [SiswaController::class, 'index'])->name('siswa.index');
        Route::prefix('siswa/{siswa}')->group(function () {
            Route::get('tagihan', [TagihanController::class, 'index'])->name('siswa.tagihan.index');
            Route::get('tagihan/create', [TagihanController::class, 'create'])->name('tagihan.create');
            Route::post('tagihan', [TagihanController::class, 'store'])->name('tagihan.store');
            Route::get('tagihan/{tagihan}/edit', [TagihanController::class, 'edit'])->name('tagihan.edit');
            Route::put('tagihan/{tagihan}', [TagihanController::class, 'update'])->name('tagihan.update');
            Route::delete('tagihan/{tagihan}', [TagihanController::class, 'destroy'])->name('tagihan.destroy');
        });
    });

    Route::middleware('role:kepsek')->group(function () {
        Route::get('/lihat-tagihan', [SiswaController::class, 'lihatTagihan'])->name('lihat-tagihan.index');
        Route::get('/siswa/{siswa}/lihat-tagihan', [TagihanController::class, 'lihatTagihan'])->name('siswa.lihat-tagihan.index');
    });
});