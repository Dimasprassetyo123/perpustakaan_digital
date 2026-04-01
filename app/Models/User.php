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

    // 🔥 penting untuk login pakai username
    public function username()
    {
        return 'username';
    }
}
