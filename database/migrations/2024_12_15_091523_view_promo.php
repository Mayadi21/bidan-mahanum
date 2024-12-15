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
    {        DB::statement("
       CREATE OR REPLACE VIEW promo_view AS
SELECT 
    p.id AS promo_id, 
    p.judul_promo AS judul_promo, 
    p.deskripsi AS deskripsi, 
    l.jenis_layanan AS jenis_layanan, 
    p.diskon AS diskon, 
    SUM(dp.kuota) AS total_kuota, 
    MIN(dp.tanggal) AS tanggal_mulai, 
    MAX(dp.tanggal) AS tanggal_selesai
FROM 
    promo p
    JOIN layanan l ON p.layanan_id = l.id
    JOIN detail_promo dp ON p.id = dp.promo_id
GROUP BY 
    p.id, 
    p.judul_promo, 
    p.deskripsi, 
    l.jenis_layanan, 
    p.diskon;

    ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
