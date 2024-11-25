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
            Schema::create('layanan', function (Blueprint $table) {
                $table->id();
                $table->string('jenis_layanan');
                $table->text('deskripsi')->nullable();
                $table->integer('harga'); // Kolom untuk harga layanan
                $table->string('gambar')->nullable();
                $table->integer('besar_bonus')->default(0); // Kolom untuk besar bonus ketika bidan melakukan pelayanan
                $table->enum('status', ['aktif','tidak aktif']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('layanan');
    }
};