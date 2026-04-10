<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Peminjaman;
use App\Models\Buku;

class PeminjamanController extends Controller
{
    // 🔹 TAMPILKAN DATA + PAGINATION
    public function index()
    {
        $data = Peminjaman::with(['buku', 'anggota'])
            ->latest()
            ->paginate(5);

        return view('page.backend.peminjaman.index', compact('data'));
    }

    // 🔹 TERIMA PEMINJAMAN
    public function terima($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $buku = Buku::find($peminjaman->id_buku);

        if ($buku->stok <= 0) {
            return redirect()->back()->with('error', 'Stok buku habis!');
        }

        $peminjaman->status = 'dipinjam';
        $peminjaman->save();

        // kurangi stok
        if ($buku) {
            $buku->stok -= 1;
            $buku->save();
        }

        return redirect()->back()->with('success', 'Peminjaman diterima!');
    }

    // 🔹 TOLAK PEMINJAMAN
    public function tolak(Request $request, $id)
    {
        $request->validate([
            'alasan' => 'required|string'
        ]);

        $peminjaman = Peminjaman::findOrFail($id);
        $peminjaman->status = 'ditolak';
        $peminjaman->alasan_ditolak = $request->alasan;
        $peminjaman->save();

        return redirect()->back()->with('success', 'Peminjaman ditolak!');
    }

    // 🔥 HAPUS (SUDAH DIKUNCI)
    public function destroy($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        // ❌ Tidak boleh hapus kalau masih dipinjam / proses kembali
        if (in_array($peminjaman->status, ['dipinjam', 'pengajuan_kembali'])) {
            return back()->with('error', 'Tidak bisa dihapus! Buku masih dipinjam / proses pengembalian.');
        }

        $peminjaman->delete();

        return back()->with('success', 'Data berhasil dihapus!');
    }

    // 🔥 KONFIRMASI PENGEMBALIAN + DENDA
    public function kembalikan($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $buku = Buku::find($peminjaman->id_buku);

        $now = now();
        $denda = 0;

        // 🔴 CEK TERLAMBAT
        if ($now->gt($peminjaman->wajib_kembali)) {
            $hari = $now->diffInDays($peminjaman->wajib_kembali);
            $denda = $hari * 5000; // 💰 5rb per hari
            $peminjaman->status = 'terlambat';
        } else {
            $peminjaman->status = 'dikembalikan';
        }

        $peminjaman->tanggal_kembali = $now;
        $peminjaman->denda = $denda;
        $peminjaman->save();

        // 🔹 Kembalikan stok buku
        if ($buku) {
            $buku->stok += 1;
            $buku->save();
        }

        return back()->with('success', 'Buku dikembalikan! Denda: Rp ' . number_format($denda, 0, ',', '.'));
    }
}
