<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Peminjaman;
use App\Models\Buku;
use Illuminate\Support\Facades\Session;

class PeminjamanFrontendController extends Controller
{
    // 🔹 FORM PINJAM
    public function create($id)
    {
        $buku = Buku::findOrFail($id);

        if (!Session::get('anggota')) {
            return redirect()->route('anggota.login')->with('error', 'Login dulu!');
        }

        return view('page.frontend.peminjaman.peminjaman', compact('buku'));
    }

    // 🔹 SIMPAN PEMINJAMAN
    public function store(Request $request)
    {
        $anggota = Session::get('anggota');

        if (!$anggota) {
            return redirect()->route('anggota.login');
        }

        $buku = Buku::findOrFail($request->id_buku);

        if ($buku->stok <= 0) {
            return back()->with('error', 'Stok buku habis!');
        }

        $limit = Peminjaman::where('id_anggota', $anggota->id_anggota)
            ->whereIn('status', ['dipinjam', 'menunggu'])
            ->count();

        if ($limit >= 3) {
            return back()->with('error', 'Limit 3 buku!');
        }

        $denda = Peminjaman::where('id_anggota', $anggota->id_anggota)
            ->where('status', 'terlambat')
            ->exists();

        if ($denda) {
            return back()->with('error', 'Masih ada denda!');
        }

        Peminjaman::create([
            'id_buku' => $request->id_buku,
            'id_anggota' => $anggota->id_anggota,
            'tanggal_pinjam' => now(),
            'wajib_kembali' => now()->addDays(2), // 🔹 hanya 2 hari
            'status' => 'menunggu'
        ]);

        return redirect()->route('frontend.home')
            ->with('success', '📚 Peminjaman diajukan!');
    }

    // 🔹 RIWAYAT
    public function riwayat()
    {
        $anggota = Session::get('anggota');

        if (!$anggota) {
            return redirect()->route('anggota.login')->with('error', 'Login dulu!');
        }

        $data = Peminjaman::with('buku')
            ->where('id_anggota', $anggota->id_anggota)
            ->latest()
            ->get();

        return view('page.frontend.riwayat.riwayat', compact('data'));
    }

    // 🔹 AJUKAN PENGEMBALIAN
    public function kembalikan($id)
    {
        $anggota = Session::get('anggota');

        if (!$anggota) {
            return redirect()->route('anggota.login')->with('error', 'Login dulu!');
        }

        $peminjaman = Peminjaman::where('id_peminjaman', $id)
            ->where('id_anggota', $anggota->id_anggota)
            ->where('status', 'dipinjam')
            ->first();

        if (!$peminjaman) {
            return back()->with('error', 'Data tidak valid!');
        }

        $peminjaman->status = 'pengajuan_kembali';
        $peminjaman->save();

        return back()->with('success', 'Pengajuan pengembalian dikirim!');
    }
}
