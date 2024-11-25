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
        Schema::create('rujukan', function (Blueprint $table) {
            $table->id();  
            $table->foreignId('id_pasien') // Foreign key untuk user
                  ->constrained('users') // Mengacu ke tabel users
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
            $table->date('tanggal_rujukan');
            $table->string('tujuan_rujukan');
            $table->string('keterangan')->nullable();



        });
    }

    public function down()
    {
        Schema::dropIfExists('rujukan');
    }
};