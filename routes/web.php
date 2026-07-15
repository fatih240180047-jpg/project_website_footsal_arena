<?php

use App\Http\Controllers\AutentikasiController;
use App\Http\Controllers\Pelanggan;
use App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Rute Web - Sistem Reservasi Futsal Arena
|--------------------------------------------------------------------------
*/

// Halaman utama - arahkan ke halaman masuk atau dashboard jika sudah login
Route::get('/', function () {
    if (auth()->check()) {
        return auth()->user()->peran === 'admin' 
            ? redirect()->route('admin.dashboard') 
            : redirect()->route('pelanggan.lapangan.index');
    }
    return redirect()->route('autentikasi.masuk');
});

// Rute Tamu (belum login)
Route::middleware('guest')->group(function () {
    Route::get('/masuk', [AutentikasiController::class, 'tampilkanMasuk'])->name('autentikasi.masuk');
    Route::post('/masuk', [AutentikasiController::class, 'prosesMasuk'])->name('autentikasi.prosesMasuk');
    Route::get('/daftar', [AutentikasiController::class, 'tampilkanDaftar'])->name('autentikasi.daftar');
    Route::post('/daftar', [AutentikasiController::class, 'prosesDaftar'])->name('autentikasi.prosesDaftar');
});

// Rute Keluar (harus login)
Route::middleware('auth')->group(function () {
    Route::post('/keluar', [AutentikasiController::class, 'prosesKeluar'])->name('autentikasi.keluar');
});

// Rute Pelanggan
Route::middleware(['auth', 'cek.peran:pelanggan'])->prefix('pelanggan')->name('pelanggan.')->group(function () {
    // Lapangan
    Route::get('/lapangan', [Pelanggan\LapanganController::class, 'index'])->name('lapangan.index');
    Route::get('/lapangan/{lapangan}', [Pelanggan\LapanganController::class, 'detail'])->name('lapangan.detail');

    // Reservasi
    Route::get('/reservasi', [Pelanggan\ReservasiController::class, 'index'])->name('reservasi.index');
    Route::get('/reservasi/buat', [Pelanggan\ReservasiController::class, 'buat'])->name('reservasi.buat');
    Route::post('/reservasi', [Pelanggan\ReservasiController::class, 'simpan'])->name('reservasi.simpan');
    Route::get('/reservasi/{reservasi}', [Pelanggan\ReservasiController::class, 'detail'])->name('reservasi.detail');
    Route::post('/reservasi/{reservasi}/batalkan', [Pelanggan\ReservasiController::class, 'batalkan'])->name('reservasi.batalkan');
});

// Rute Admin
Route::middleware(['auth', 'cek.peran:admin'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [Admin\DashboardController::class, 'index'])->name('dashboard');

    // Manajemen Lapangan
    Route::get('/lapangan', [Admin\LapanganController::class, 'index'])->name('lapangan.index');
    Route::get('/lapangan/tambah', [Admin\LapanganController::class, 'tambah'])->name('lapangan.tambah');
    Route::post('/lapangan', [Admin\LapanganController::class, 'simpan'])->name('lapangan.simpan');
    Route::get('/lapangan/{lapangan}/ubah', [Admin\LapanganController::class, 'ubah'])->name('lapangan.ubah');
    Route::put('/lapangan/{lapangan}', [Admin\LapanganController::class, 'perbarui'])->name('lapangan.perbarui');
    Route::delete('/lapangan/{lapangan}', [Admin\LapanganController::class, 'hapus'])->name('lapangan.hapus');

    // Manajemen Reservasi
    Route::get('/reservasi', [Admin\ReservasiController::class, 'index'])->name('reservasi.index');
    Route::get('/reservasi/{reservasi}', [Admin\ReservasiController::class, 'detail'])->name('reservasi.detail');
    Route::post('/reservasi/{reservasi}/konfirmasi', [Admin\ReservasiController::class, 'konfirmasi'])->name('reservasi.konfirmasi');
    Route::post('/reservasi/{reservasi}/batalkan', [Admin\ReservasiController::class, 'batalkan'])->name('reservasi.batalkan');
    Route::post('/reservasi/{reservasi}/selesai', [Admin\ReservasiController::class, 'selesai'])->name('reservasi.selesai');
});
