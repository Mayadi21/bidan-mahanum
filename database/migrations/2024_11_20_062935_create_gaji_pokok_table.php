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
        Schema::create('gaji_pokok', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->foreignId('id_bidan') // Foreign key ke tabel users
                ->constrained('users')
                ->onUpdate('cascade'); // Update cascade jika id pada users berubah
            $table->integer('gaji_pokok'); // Gaji pokok bidan
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gaji_pokok');
    }
};
