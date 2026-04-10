<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    protected $table = 'peminjaman';
    protected $primaryKey = 'id_peminjaman';

    protected $keyType = 'int';
    public $incrementing = true;

    protected $fillable = [
        'id_petugas',
        'id_buku',
        'id_anggota',
        'tanggal_pinjam',
        'wajib_kembali',
        'tanggal_kembali',
        'status',
        'denda', // 🔥 TAMBAH INI
        'status_denda'
    ];

    // 🔥 KONSTANTA STATUS
    const STATUS_MENUNGGU = 'menunggu';
    const STATUS_DIPINJAM = 'dipinjam';
    const STATUS_PENGAJUAN = 'pengajuan_kembali';
    const STATUS_SELESAI = 'dikembalikan';
    const STATUS_TERLAMBAT = 'terlambat';
    const STATUS_DITOLAK = 'ditolak';

    // 🔹 Relasi ke Buku
    public function buku()
    {
        return $this->belongsTo(Buku::class, 'id_buku', 'id_buku');
    }

    // 🔹 Relasi ke Anggota
    public function anggota()
    {
        return $this->belongsTo(Anggota::class, 'id_anggota', 'id_anggota');
    }

    // 🔹 Relasi ke Petugas
    public function petugas()
    {
        return $this->belongsTo(Petugas::class, 'id_petugas', 'id_petugas');
    }

    // 🔹 Format tanggal
    protected $casts = [
        'tanggal_pinjam' => 'date',
        'wajib_kembali' => 'date',
        'tanggal_kembali' => 'date',
    ];
}
