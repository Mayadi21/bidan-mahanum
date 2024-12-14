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
        Schema::create('jadwal_janji_temu', function (Blueprint $table) {
            $table->id();
            $table->dateTime('waktu_mulai');
            $table->dateTime('waktu_selesai');
            $table->unsignedSmallInteger('kuota');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_janji_temu');
    }
};
