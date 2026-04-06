<?php

use App\Http\Controllers\Backend\AuthController;
use App\Http\Controllers\Backend\BukuController;
use App\Http\Controllers\Backend\DhasboardPetugasBackendController;
use App\Http\Controllers\Backend\PetugasBackendController;
use App\Http\Controllers\Frontend\AuthAnggotaController;
use App\Http\Controllers\Frontend\HomeBackendController;
use Illuminate\Support\Facades\Route;


// ==============================
// LOGIN & LOGOUT (BACKEND)
// ==============================
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'loginPost'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// ==============================
// 👑 KEPALA PERPUSTAKAAN
// ==============================
Route::middleware(['auth', 'role:kepala'])->group(function () {

    Route::get('/kepala', [DhasboardPetugasBackendController::class, 'index'])
        ->name('kepala');

    Route::resource('petugas', PetugasBackendController::class);
});


// ==============================
// 👨‍💼 PETUGAS
// ==============================
Route::middleware(['auth', 'role:petugas'])->group(function () {

    Route::get('/petugas-dashboard', [DhasboardPetugasBackendController::class, 'index'])
        ->name('petugas.dashboard');
});


// ==============================
// 📚 BUKU
// ==============================
Route::resource('buku', BukuController::class);


// ==============================
// 👤 AUTH ANGGOTA (FRONTEND)
// ==============================
Route::get('/anggota/login', [AuthAnggotaController::class, 'login'])->name('anggota.login');
Route::post('/anggota/login', [AuthAnggotaController::class, 'loginPost'])->name('anggota.login.post');

Route::get('/anggota/register', [AuthAnggotaController::class, 'register'])->name('anggota.register');
Route::post('/anggota/register', [AuthAnggotaController::class, 'registerPost'])->name('anggota.register.post');

Route::get('/anggota/logout', [AuthAnggotaController::class, 'logout'])->name('anggota.logout');


// ==============================
// 👤 CEK LOGIN ANGGOTA (OPSIONAL TEST)
// ==============================
Route::get('/anggota/home', function () {
    if (!session('anggota')) {
        return redirect('/anggota/login');
    }

    return "Login berhasil, selamat datang " . session('anggota')->nama;
});


// ==============================
// 🌐 FRONTEND (DASHBOARD USER)
// ==============================
Route::get('/', [HomeBackendController::class, 'index'])->name('frontend.home');

Route::get('/detail-buku/{id}', [HomeBackendController::class, 'detail'])
    ->name('buku.detail');
