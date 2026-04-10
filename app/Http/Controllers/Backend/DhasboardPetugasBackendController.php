<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Petugas;
use App\Models\Anggota;
use App\Models\Buku;
use App\Models\Peminjaman;
use Carbon\Carbon;

class DhasboardPetugasBackendController extends Controller
{
    public function index()
    {
        // 🔹 TOTAL
        $totalPetugas = Petugas::count();
        $totalAnggota = Anggota::count();
        $totalBuku = Buku::count();
        $totalPeminjaman = Peminjaman::count();

        // 🔹 PEMINJAMAN HARI INI
        $peminjamanHariIni = Peminjaman::with(['anggota', 'buku'])
            ->whereDate('tanggal_pinjam', Carbon::today())
            ->latest()
            ->get();

        return view('page.backend.halamanpetugas.index', compact(
            'totalPetugas',
            'totalAnggota',
            'totalBuku',
            'totalPeminjaman',
            'peminjamanHariIni'
        ));
    }
}
