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
        Schema::create('promo', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('judul_promo'); // Nama promo
            $table->text('deskripsi'); // Deskripsi promo
            $table->foreignId('layanan_id') // Foreign key ke tabel layanan
                    ->constrained('layanan')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            $table->integer('diskon'); // Besar diskon
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promo');
    }
};
