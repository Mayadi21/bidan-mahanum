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
        Schema::create('detail_transaksi', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->foreignId('transaksi_id') // Foreign key ke tabel transaksi
                  ->constrained('transaksi') // Referensi ke tabel transaksi
                  ->onUpdate('cascade') // Cascade on update
                  ->onDelete('cascade'); // Cascade on delete jika transaksi dihapus
            $table->foreignId('layanan_id') // Foreign key ke tabel layanan
                  ->constrained('layanan') // Referensi ke tabel layanan
                  ->onUpdate('cascade') // Cascade on update
                  ->onDelete('cascade'); // Cascade on delete jika layanan dihapus
            $table->integer('bonus_pegawai')->default(0);
            $table->integer('potongan')->default(0);

            $table->integer('harga'); // Harga layanan

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_transaksi');
    }
};
