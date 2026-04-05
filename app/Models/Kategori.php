<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $primaryKey = 'id_kategori';
<<<<<<< HEAD
    
    protected $fillable = ['ket_kategori'];
=======
    protected $fillable = ['ket_kategori'];
    protected $table = 'kategoris';
>>>>>>> 722639d6daabffc6f303b1c182c07a331f2f6475

    public function aspirasis()
    {
        return $this->hasMany(Aspirasi::class, 'id_kategori');
    }

    public function inputAspirasis()
    {
        return $this->hasMany(InputAspirasi::class, 'id_kategori');
    }
}