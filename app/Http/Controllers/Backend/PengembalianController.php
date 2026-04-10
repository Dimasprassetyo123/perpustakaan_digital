<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;

class PengembalianController extends Controller
{
    // 🔹 TAMPILKAN DATA
    public function index()
    {
        $data = Peminjaman::with(['buku', 'anggota'])
            ->whereIn('status', ['pengajuan_kembali', 'dikembalikan', 'terlambat'])
            ->latest()
            ->get();

        return view('page.backend.pengembalian.index', compact('data'));
    }

    // 🔹 KONFIRMASI + DENDA
    public function konfirmasi($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        $now = now()->startOfDay();
        $wajibKembali = $peminjaman->wajib_kembali->startOfDay();
        $denda = 0;
        $statusDenda = null;

        if ($now->gt($wajibKembali)) {
            $hari = abs($now->diffInDays($wajibKembali));
            $denda = $hari * 2000; // Rp 2.000 per hari keterlambatan
            $peminjaman->status = 'terlambat';
            $statusDenda = 'belum_lunas';
        } else {
            $peminjaman->status = 'dikembalikan';
        }

        $peminjaman->tanggal_kembali = now();
        $peminjaman->denda = $denda;
        $peminjaman->status_denda = $statusDenda;
        $peminjaman->save();

        // tambah stok
        if ($peminjaman->buku) {
            $peminjaman->buku->increment('stok');
        }

        return back()->with('success', 'Pengembalian berhasil! Denda: Rp ' . number_format($denda,0,',','.'));
    }

    // 🔹 DELETE
    public function destroy($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        if (!in_array($peminjaman->status, ['dikembalikan', 'terlambat'])) {
            return back()->with('error', 'Tidak bisa hapus! Buku belum dikembalikan.');
        }

        $peminjaman->delete();

        return back()->with('success', 'Data pengembalian dihapus!');
    }
}
