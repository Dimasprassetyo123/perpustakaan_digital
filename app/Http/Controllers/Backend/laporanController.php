<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class laporanController extends Controller
{
   public function index()
    {
        $data = Peminjaman::with(['anggota', 'buku'])->get();

        return view('page.backend.laporan.index', compact('data'));
    }

    // 🔹 CETAK PDF
    public function cetakPdf()
    {
        $data = Peminjaman::with(['anggota', 'buku'])->get();

        $pdf = Pdf::loadView('page.backend.laporan.pdf', compact('data'));

      return $pdf->stream('laporan-peminjaman.pdf');
    }
}
