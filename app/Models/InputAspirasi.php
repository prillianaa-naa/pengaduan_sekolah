<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InputAspirasi extends Model
{
    protected $primaryKey = 'id_pelaporan';

    protected $fillable = [
<<<<<<< HEAD
        'nis',
        'id_kategori',
        'lokasi',
        'ket',
        'id_aspirasi',
        'judul',        // ini belom ada
        'foto',         // ini juga belom ada
        'prioritas',    // ini juga 
=======
        'nis', 'id_kategori', 'lokasi', 'ket', 'id_aspirasi',
>>>>>>> 722639d6daabffc6f303b1c182c07a331f2f6475
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'nis', 'nis');
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori');
    }

    public function aspirasi()
    {
        return $this->belongsTo(Aspirasi::class, 'id_aspirasi');
    }
}