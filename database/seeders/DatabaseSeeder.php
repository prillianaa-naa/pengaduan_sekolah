<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Kategori;
use App\Models\Siswa;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ✅ Buat Admin
        Admin::create([
            'name' => 'Administrator',
            'email' => 'admin@sekolah.com',
            'password' => Hash::make('admin123'),
        ]);

        // Buat Sample Siswa
        Siswa::create([
            'nis' => '12345',
            'nama' => 'Ahmad Test',
            'kelas' => 'X IPA 1',
            'password' => Hash::make('123456'),
        ]);

        // Buat Kategori
        $categories = [
            'Fasilitas Kelas', 'Toilet', 'Perpustakaan', 
            'Laboratorium', 'Lapangan Olahraga', 'Kantin'
        ];
        foreach ($categories as $cat) {
            Kategori::create(['ket_kategori' => $cat]);
        }
    }
}