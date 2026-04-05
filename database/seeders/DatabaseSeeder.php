<?php

namespace Database\Seeders;

<<<<<<< HEAD
use App\Models\Admin;
use App\Models\Kategori;
use App\Models\Siswa;
=======
use App\Models\Kategori;
use App\Models\Admin;
>>>>>>> 722639d6daabffc6f303b1c182c07a331f2f6475
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
<<<<<<< HEAD
        // ✅ Buat Admin
=======
        // Create Admin
>>>>>>> 722639d6daabffc6f303b1c182c07a331f2f6475
        Admin::create([
            'name' => 'Administrator',
            'email' => 'admin@sekolah.com',
            'password' => Hash::make('admin123'),
        ]);

<<<<<<< HEAD
        // Buat Sample Siswa
        Siswa::create([
=======
        // Create Categories
        $categories = [
            'Fasilitas Kelas',
            'Toilet',
            'Perpustakaan',
            'Laboratorium',
            'Lapangan Olahraga',
            'Kantin',
            'Parkir',
            'AC/Kipas Angin',
            'Listrik',
            'Air Bersih',
        ];

        foreach ($categories as $category) {
            Kategori::create(['ket_kategori' => $category]);
        }

        // Create Sample Siswa
        \App\Models\Siswa::create([
>>>>>>> 722639d6daabffc6f303b1c182c07a331f2f6475
            'nis' => '12345',
            'nama' => 'Ahmad Test',
            'kelas' => 'X IPA 1',
            'password' => Hash::make('123456'),
        ]);
<<<<<<< HEAD

        // Buat Kategori
        $categories = [
            'Fasilitas Kelas', 'Toilet', 'Perpustakaan', 
            'Laboratorium', 'Lapangan Olahraga', 'Kantin'
        ];
        foreach ($categories as $cat) {
            Kategori::create(['ket_kategori' => $cat]);
        }
=======
>>>>>>> 722639d6daabffc6f303b1c182c07a331f2f6475
    }
}