<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;


return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('ulasan', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->foreignId('id_pengguna') // Foreign key ke tabel users
                  ->constrained('users') // Mengacu ke tabel users
                  ->onUpdate('cascade'); // Update cascade jika data di tabel users diubah
            $table->foreignId('layanan_id') // Foreign key ke tabel layanan
                  ->constrained('layanan') // Mengacu ke tabel layanan
                  ->onUpdate('cascade'); // Update cascade jika data di tabel layanan diubah
            $table->string('ulasan'); // Kolom untuk teks ulasan
            $table->enum('status', ['aktif','tidak aktif']); // Kolom untuk status ulasan
            $table->date('tanggal_ulasan')->default(DB::raw('CURRENT_DATE')); // Default ke tanggal sekarang
        });
    }

    public function down()
    {
        Schema::dropIfExists('ulasan');
    }
};