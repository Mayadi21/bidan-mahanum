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
            ->nullable() //bisa null jika memakai id pasien tidak terdaftar
            ->constrained('users') // Mengacu ke tabel users
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->foreignId('pasien_tidak_terdaftar_id') // Foreign key untuk pasien tidak terdaftar
            ->nullable() // Bisa null jika pasien adalah pengguna terdaftar
            ->constrained('pasien_tidak_terdaftar')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->foreignId('promo_id') // Foreign key untuk tabel promo
            ->nullable() // Bisa null jika tidak mendaftar promo
            ->constrained('promo')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->string('keluhan')->nullable(); // Kolom keluhan
            $table->dateTime('waktu_mulai'); // Kolom waktu janji temu dimulai
            $table->dateTime('waktu_selesai')->nullable(); // Kolom waktu janji temu selesai
            $table->enum('status', ['menunggu konfirmasi', 'ditolak', 'disetujui', 'selesai'])
            ->nullable() // Memungkinkan NULL
            ->default('menunggu konfirmasi'); // Nilai default tetap ada
            $table->string('keterangan')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('janji_temu');
    }
};
