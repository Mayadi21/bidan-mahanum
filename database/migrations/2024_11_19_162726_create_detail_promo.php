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
        Schema::create('detail_promo', function (Blueprint $table) {
            $table->id();
            $table->foreignId('promo_id') // Foreign key ke tabel promo
            ->constrained('promo')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->integer('kuota'); // Kuota per tanggal
            $table->integer('terpakai')->default(0); // jika sama, maka tidak bisa didaftar ke sini
            $table->date('tanggal'); // Tanggal spesifik untuk promo

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_promo');
    }
};
