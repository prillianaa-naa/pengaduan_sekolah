<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aspirasi extends Model
{
    protected $primaryKey = 'id_aspirasi';

    protected $fillable = [
<<<<<<< HEAD
        'id_kategori', 
        'status', 
        'feedback',
        'is_read',
=======
        'id_kategori', 'status', 'feedback',
>>>>>>> 722639d6daabffc6f303b1c182c07a331f2f6475
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori');
    }

    public function inputAspirasis()
    {
        return $this->hasMany(InputAspirasi::class, 'id_aspirasi');
    }
}