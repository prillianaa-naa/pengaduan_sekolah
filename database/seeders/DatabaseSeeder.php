<?php

namespace Database\Seeders;

use App\Models\Kategori;
use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create Admin
        Admin::create([
            'name' => 'Administrator',
            'email' => 'admin@sekolah.com',
            'password' => Hash::make('admin123'),
        ]);

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
            'nis' => '12345',
            'nama' => 'Ahmad Test',
            'kelas' => 'X IPA 1',
            'password' => Hash::make('123456'),
        ]);
    }
}