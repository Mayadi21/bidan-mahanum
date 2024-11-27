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
        Schema::create('penggajian', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->foreignId('id_bidan') // Foreign key untuk id_bidan
                ->constrained('users') // Mengacu ke tabel users
                ->onUpdate('cascade'); // Update cascade jika data di tabel users diubah
            $table->integer('gaji_pokok'); // Kolom gaji pokok
            $table->integer('bonus')->default(0); // Kolom bonus dengan default 0
            $table->enum('bulan_gaji', [1,2,3,4,5,6,7,8,9,10,11,12]);
            $table->date('tanggal_penggajian')->nullable(); // Kolom tanggal gajian
            $table->integer('tahun_gaji');
            $table->enum('status', ['0', '1'])->default('0'); // Kolom status (0: belum dibayar, 1: sudah dibayar)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penggajian');
    }
};
