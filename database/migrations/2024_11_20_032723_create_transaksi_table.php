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
                  ->constrained('users') // Referensi ke tabel users
                  ->onUpdate('cascade'); // Update cascade

            $table->foreignId('bidan') // Foreign key ke tabel users (bidan)
                  ->constrained('users') // Referensi ke tabel users
                  ->onUpdate('cascade'); // Update cascade

            $table->date('tanggal'); // Kolom tanggal transaksi
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