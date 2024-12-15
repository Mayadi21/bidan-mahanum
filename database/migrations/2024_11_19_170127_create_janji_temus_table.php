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
                ->nullable()
                ->constrained('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('jadwal_id') // Foreign key ke tabel jadwal janji temu
                ->nullable()
                ->constrained('jadwal_janji_temu')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('jadwal_promo_id') // Foreign key ke tabel jadwal
                ->nullable()
                ->constrained('detail_promo')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('keluhan')->nullable(); // Kolom keluhan
            $table->enum('status', ['menunggu konfirmasi', 'ditolak', 'disetujui', 'selesai']) 
                ->default('menunggu konfirmasi'); // Status janji temu
            $table->string('keterangan')->nullable(); // Kolom keterangan tambahan
        });
        
    }

    public function down()
    {
        Schema::dropIfExists('janji_temu');
    }
};
