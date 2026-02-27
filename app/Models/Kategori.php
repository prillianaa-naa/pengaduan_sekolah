<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $primaryKey = 'id_kategori';
    protected $fillable = ['ket_kategori'];
    protected $table = 'kategoris';

    public function aspirasis()
    {
        return $this->hasMany(Aspirasi::class, 'id_kategori');
    }

    public function inputAspirasis()
    {
        return $this->hasMany(InputAspirasi::class, 'id_kategori');
    }
}