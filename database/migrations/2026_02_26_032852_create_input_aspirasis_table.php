<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('input_aspirasis', function (Blueprint $table) {
            $table->id('id_pelaporan');
            $table->foreignId('nis')->constrained('siswas', 'nis')->onDelete('cascade');
            $table->foreignId('id_kategori')->constrained('kategoris', 'id_kategori')->onDelete('cascade');
            $table->string('lokasi', 50);
            $table->string('ket', 50);
            $table->foreignId('id_aspirasi')->constrained('aspirasis', 'id_aspirasi')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('input_aspirasis');
    }
};