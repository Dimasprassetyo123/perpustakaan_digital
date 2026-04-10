<?php

use App\Http\Controllers\Backend\AuthController;
use App\Http\Controllers\Backend\BukuController;
use App\Http\Controllers\Backend\DhasboardPetugasBackendController;
use App\Http\Controllers\Backend\laporanController;
use App\Http\Controllers\Backend\DendaController;
use App\Http\Controllers\Backend\PeminjamanController;
use App\Http\Controllers\Backend\PengembalianController;
use App\Http\Controllers\Backend\PetugasBackendController;
use App\Http\Controllers\Frontend\AuthAnggotaController;
use App\Http\Controllers\Frontend\HomeBackendController;
use App\Http\Controllers\Frontend\PeminjamanFrontendController;
use Illuminate\Support\Facades\Route;


// ==============================
// LOGIN BACKEND
// ==============================
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'loginPost'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// ==============================
// KEPALA
// ==============================
Route::middleware(['auth', 'role:kepala'])->group(function () {
    Route::get('/kepala', [DhasboardPetugasBackendController::class, 'index'])->name('kepala');
    Route::resource('petugas', PetugasBackendController::class);
    Route::get('/laporan', [laporanController::class, 'index'])->name('laporan.index');
    Route::get('/laporan/pdf', [laporanController::class, 'cetakPdf'])->name('laporan.pdf');
});


// ==============================
// PETUGAS
// ==============================
Route::middleware(['auth', 'role:petugas'])->group(function () {
    Route::get('/petugas-dashboard', [DhasboardPetugasBackendController::class, 'index'])
        ->name('petugas.dashboard');
});


// ==============================
// BUKU
// ==============================
Route::resource('buku', BukuController::class);


// ==============================
// AUTH ANGGOTA
// ==============================
Route::get('/anggota/login', [AuthAnggotaController::class, 'login'])->name('anggota.login');
Route::post('/anggota/login', [AuthAnggotaController::class, 'loginPost'])->name('anggota.login.post');

Route::get('/anggota/register', [AuthAnggotaController::class, 'register'])->name('anggota.register');
Route::post('/anggota/register', [AuthAnggotaController::class, 'registerPost'])->name('anggota.register.post');

Route::get('/anggota/logout', [AuthAnggotaController::class, 'logout'])->name('anggota.logout');


// ==============================
// FRONTEND
// ==============================
Route::get('/', [HomeBackendController::class, 'index'])->name('frontend.home');

Route::get('/detail-buku/{id}', [HomeBackendController::class, 'detail'])
    ->name('buku.detail');


// ==============================
// FRONTEND PEMINJAMAN
// ==============================
Route::get('/peminjaman/{id}', [PeminjamanFrontendController::class, 'create'])
    ->name('peminjaman.create');

Route::post('/peminjaman/store', [PeminjamanFrontendController::class, 'store'])
    ->name('peminjaman.store');

Route::post('/peminjaman/kembalikan/{id}', [PeminjamanFrontendController::class, 'kembalikan'])
    ->name('peminjaman.kembalikan');

Route::get('/riwayat', [PeminjamanFrontendController::class, 'riwayat'])
    ->name('riwayat');


// ==============================
// BACKEND (FIXED 🔥)
// ==============================
Route::prefix('backend')->middleware(['auth', 'role:petugas'])->group(function () {

    // ==========================
    // PEMINJAMAN
    // ==========================
    Route::get('/peminjaman', [PeminjamanController::class, 'index'])
        ->name('peminjaman.index');

    Route::post('/peminjaman/terima/{id}', [PeminjamanController::class, 'terima'])
        ->name('peminjaman.terima');

    Route::post('/peminjaman/tolak/{id}', [PeminjamanController::class, 'tolak'])
        ->name('peminjaman.tolak');

    Route::delete('/peminjaman/{id}', [PeminjamanController::class, 'destroy'])
        ->name('peminjaman.destroy');


    // ==========================
    // PENGEMBALIAN (SUDAH FIX)
    // ==========================
    Route::get('/pengembalian', [PengembalianController::class, 'index'])
        ->name('pengembalian.index');

    // 🔥 KONFIRMASI (JELAS & AMAN)
    Route::post('/pengembalian/{id}/konfirmasi', [PengembalianController::class, 'konfirmasi'])
        ->name('pengembalian.konfirmasi');

    // 🔥 DELETE
    Route::delete('/pengembalian/{id}', [PengembalianController::class, 'destroy'])
        ->name('pengembalian.destroy');
        
    // ==========================
    // DENDA
    // ==========================
    Route::get('/denda', [DendaController::class, 'index'])
        ->name('denda.index');
    Route::post('/denda/{id}/lunasi', [DendaController::class, 'lunasi'])
        ->name('denda.lunasi');
});
