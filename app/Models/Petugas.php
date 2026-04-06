<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Petugas extends Model
{
    protected $table = 'petugas';
    protected $primaryKey = 'id_petugas';

    protected $fillable = [
        'nama_petugas',
        'jenis_kelamin',
        'tanggal_lahir',
        'alamat',
        'email',
        'id_user'
    ];

    // 🔥 FIX RELASI (INI YANG BIKIN USERNAME MUNCUL)
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }
}
