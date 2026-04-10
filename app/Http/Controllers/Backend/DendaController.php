<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use Illuminate\Http\Request;

class DendaController extends Controller
{
    // Menampilkan halaman data denda
    public function index()
    {
        // Ambil semua peminjaman yang memiliki denda > 0 (sudah dikembalikan)
        // ATAU yang masih dipinjam tapi sudah melewati batas wajib_kembali (live denda)
        $data = Peminjaman::with(['buku', 'anggota'])
            ->where('denda', '>', 0)
            ->orWhere(function($query) {
                $query->where('status', 'dipinjam')
                      ->whereDate('wajib_kembali', '<', now()->startOfDay());
            })
            ->latest()
            ->get();

        return view('page.backend.denda.index', compact('data'));
    }

    // Melunasi Denda
    public function lunasi($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        if ($peminjaman->status_denda !== 'lunas') {
            $peminjaman->status_denda = 'lunas';
            $peminjaman->save();

            return back()->with('success', 'Pembayaran denda berhasil diverifikasi (Lunas)!');
        }

        return back()->with('info', 'Denda sudah berstatus Lunas.');
    }
}
