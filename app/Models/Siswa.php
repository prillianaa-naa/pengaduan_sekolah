<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Siswa extends Authenticatable
{
    use Notifiable;

    // ✅ SESUAIKAN DENGAN DATABASE
    protected $table = 'siswas';
    protected $primaryKey = 'id';      // ← Pakai 'id' (bigint auto_increment)
    public $incrementing = true;       // ← true karena AUTO_INCREMENT
    protected $keyType = 'int';        // ← int karena bigint

    protected $fillable = [
        'nis', 
        'nama', 
        'kelas', 
        'password',
    ];

    protected $hidden = [
        'password', 
        'remember_token',
    ];

    protected $casts = [
        'password' => 'hashed',
    ];

    public function inputAspirasis()
    {
        return $this->hasMany(InputAspirasi::class, 'nis', 'nis');
    }
}