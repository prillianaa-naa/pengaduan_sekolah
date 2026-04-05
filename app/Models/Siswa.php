<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Siswa extends Authenticatable
{
    use Notifiable;

<<<<<<< HEAD
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
=======
    protected $primaryKey = 'nis';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'nis', 'nama', 'kelas', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
>>>>>>> 722639d6daabffc6f303b1c182c07a331f2f6475
    ];

    protected $casts = [
        'password' => 'hashed',
    ];

    public function inputAspirasis()
    {
        return $this->hasMany(InputAspirasi::class, 'nis', 'nis');
    }
}