<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('janji_temu', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->foreignId('id_pasien') // Foreign key untuk user
                  ->constrained('users') // Mengacu ke tabel users
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
            $table->foreignId('layanan_id') // Foreign key untuk layanan
                  ->constrained('layanan') // Mengacu ke tabel layanan
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
            $table->string('keluhan'); // Kolom keluhan
            $table->dateTime('waktu_janji'); // Kolom waktu janji temu
            $table->enum('status', ['menunggu konfirmasi', 'ditolak', 'disetujui', 'selesai']); // Kolom status
            $table->string('keterangan')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('janji_temu');
    }
};