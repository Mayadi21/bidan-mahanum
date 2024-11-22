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
            $table->date('tanggal_gajian'); // Kolom tanggal gajian
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
