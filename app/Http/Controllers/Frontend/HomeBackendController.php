<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Buku;
use App\Models\Peminjaman;
use Illuminate\Support\Facades\DB;

class HomeBackendController extends Controller
{
    public function index()
    {
        // 🔹 Semua buku (buat tab & kategori)
        $buku = Buku::latest()->get();

        // 🔹 REKOMENDASI (random + stok tersedia)
        $rekomendasi = Buku::where('stok', '>', 0)
            ->inRandomOrder()
            ->limit(8)
            ->get();

        // 🔹 POPULER (paling sering dipinjam)
        $populer = Peminjaman::select('id_buku', DB::raw('count(*) as total'))
            ->whereIn('status', [
                Peminjaman::STATUS_DIPINJAM,
                Peminjaman::STATUS_SELESAI
            ])
            ->groupBy('id_buku')
            ->orderByDesc('total')
            ->with('buku')
            ->limit(8)
            ->get();

        return view('page.frontend.home.index', compact('buku', 'rekomendasi', 'populer'));
    }

    public function detail($id)
    {
        $buku = Buku::findOrFail($id);
        return view('page.frontend.detaile.detaile', compact('buku'));
    }
}
