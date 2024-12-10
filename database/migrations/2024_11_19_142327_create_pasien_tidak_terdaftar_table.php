<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pasien_tidak_terdaftar', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('nama_pasien'); // Nama pasien
            $table->date('tanggal_lahir'); // Primary Key
            $table->string('alamat');
            $table->string('no_hp')->nullable(); // Kontak pasien, jika ada (misalnya nomor telepon)
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pasien_tidak_terdaftar');
    }
};
