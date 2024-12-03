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
        Schema::create('log_transaksi', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->integer('id_pasien'); 
            $table->integer('transaksi_id'); 
            $table->string('pasien'); // Nama pasien
            $table->string('bidan'); // Nama bidan
            $table->string('layanan'); // Nama layanan
            $table->date('tanggal'); // Tanggal log transaksi
            $table->integer('biaya'); // Biaya transaksi
            $table->datetime('waktu_log')->useCurrent(); // Waktu pembuatan log, default waktu saat ini

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('log_transaksi');
    }
};
