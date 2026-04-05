<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('input_aspirasis', function (Blueprint $table) {
            // Tambah kolom prioritas jika belum ada
            if (!Schema::hasColumn('input_aspirasis', 'prioritas')) {
                $table->enum('prioritas', ['Rendah', 'Sedang', 'Tinggi'])
                      ->default('Sedang')
                      ->after('ket');
            }
        });
    }

    public function down(): void
    {
        Schema::table('input_aspirasis', function (Blueprint $table) {
            $table->dropColumn('prioritas');
        });
    }
};