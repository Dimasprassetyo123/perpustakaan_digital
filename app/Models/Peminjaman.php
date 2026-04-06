<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;

    protected $table = 'peminjaman';
    protected $primaryKey = 'id_peminjaman';

    protected $fillable = [
        'id_petugas',
        'id_buku',
        'id_anggota',
        'tanggal_pinjam',
        'wajib_kembali',
        'tanggal_kembali',
        'status'
    ];

    protected $casts = [
        'tanggal_pinjam' => 'date',
        'wajib_kembali' => 'date',
        'tanggal_kembali' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Status constants untuk memudahkan
    const STATUS_MENUNGGU = 'menunggu';
    const STATUS_DIPINJAM = 'dipinjam';
    const STATUS_DITOLAK = 'ditolak';
    const STATUS_MENUNGGU_PENGEMBALIAN = 'menunggu_pengembalian';
    const STATUS_DIKEMBALIKAN = 'dikembalikan';
    const STATUS_TERLAMBAT = 'terlambat';

    // Relationships
    public function petugas()
    {
        return $this->belongsTo(Petugas::class, 'id_petugas', 'id');
    }

    public function buku()
    {
        return $this->belongsTo(Buku::class, 'id_buku', 'id');
    }

    public function anggota()
    {
        return $this->belongsTo(Anggota::class, 'id_anggota', 'id');
    }

    // Scopes untuk filtering berdasarkan status
    public function scopeMenunggu($query)
    {
        return $query->where('status', self::STATUS_MENUNGGU);
    }

    public function scopeDipinjam($query)
    {
        return $query->where('status', self::STATUS_DIPINJAM);
    }

    public function scopeDikembalikan($query)
    {
        return $query->where('status', self::STATUS_DIKEMBALIKAN);
    }

    public function scopeTerlambat($query)
    {
        return $query->where('status', self::STATUS_TERLAMBAT);
    }

    // Helper methods
    public function isTerlambat()
    {
        if ($this->status === self::STATUS_DIPINJAM && now()->gt($this->wajib_kembali)) {
            return true;
        }
        return false;
    }

    public function updateStatus()
    {
        if ($this->status === self::STATUS_DIPINJAM && $this->isTerlambat()) {
            $this->status = self::STATUS_TERLAMBAT;
            $this->save();
        }
    }

    public function kembalikanBuku()
    {
        $this->tanggal_kembali = now();
        $this->status = self::STATUS_DIKEMBALIKAN;
        $this->save();
    }
}
