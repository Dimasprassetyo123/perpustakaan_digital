<?php

use App\Http\Controllers\Backend\AuthController;
use App\Http\Controllers\Backend\BukuController;
use App\Http\Controllers\Backend\DhasboardPetugasBackendController;
use Illuminate\Support\Facades\Route;

// LOGIN
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'loginPost'])->name('login.post');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// DASHBOARD
Route::get('/kepala', function () {
    return view('page.backend.halamankepalaperpus.index');
})->name('kepala');

Route::get('/petugas', function () {
    return view('page.backend.halamanPetugas.index');
})->name('petugas');

// DATA PETUGAS
Route::get('/adminPetugas', [DhasboardPetugasBackendController::class, 'index'])->name('adminPetugas');

// ✅ BUKU (FULL CRUD)
Route::resource('buku', BukuController::class);
