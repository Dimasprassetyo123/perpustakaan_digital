<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $table = 'users';

    protected $primaryKey = 'id_user';

    public $incrementing = true;

    protected $keyType = 'int';

    protected $fillable = [
        'username',
        'password',
        'role'
    ];

    protected $hidden = [
        'password',
    ];

    // ✅ FIX: Beritahu Laravel pakai 'id_user' sebagai identifier session
    public function getAuthIdentifierName(): string
    {
        return 'id_user';
    }

    // ✅ FIX: Beritahu Laravel pakai 'username' untuk login
    public function getAuthIdentifier(): mixed
    {
        return $this->id_user;
    }

    public function anggota()
{
    return $this->hasOne(Anggota::class, 'id_user');
}
}
