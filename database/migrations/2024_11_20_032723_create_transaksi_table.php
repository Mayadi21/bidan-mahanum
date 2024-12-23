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
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->foreignId('id_pasien') // Foreign key ke tabel users (id_pasien)
                  ->constrained('users')
                  ->onDelete('cascade') // Referensi ke tabel users
                  ->onUpdate('cascade'); // Update cascade


            $table->foreignId('janji_id') 
            ->nullable()
            ->constrained('janji_temu') 
            ->onUpdate('cascade')
            ->onDelete('cascade'); // Update cascade

            $table->foreignId('bidan') // Foreign key ke tabel users (bidan)
                  ->constrained('users') // Referensi ke tabel users
                  ->onUpdate('cascade')
                  ->onDelete('cascade'); // Update cascade

            $table->string('keterangan')->nullable(); // Kolom untuk teks ulasan


            $table->datetime('tanggal')->useCurrent(); // Kolom tanggal transaksi
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaksi');
    }
};