<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Tambah kolom di tabel aspirasis
        Schema::table('aspirasis', function (Blueprint $table) {
            $table->enum('prioritas', ['Rendah', 'Sedang', 'Tinggi'])
                  ->default('Sedang')
                  ->after('id_kategori');
        });

        // Tambah kolom di tabel input_aspirasis
        Schema::table('input_aspirasis', function (Blueprint $table) {
            // $table->string('judul', 100)->after('id_pelaporan');
            $table->string('judul', 100)->default('Pengaduan Sarana')->change();
        });
    }

    public function down(): void
    {
        Schema::table('aspirasis', function (Blueprint $table) {
            $table->dropColumn('prioritas');
        });

        Schema::table('input_aspirasis', function (Blueprint $table) {
            $table->dropColumn(['judul', 'foto']);
        });
    }
};