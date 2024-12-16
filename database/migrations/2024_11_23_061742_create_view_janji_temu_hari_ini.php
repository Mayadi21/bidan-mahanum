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
        // Membuat View
        DB::statement("
CREATE OR REPLACE VIEW view_jadwal_janji_temu AS
SELECT 
    jt.id,
    jt.id_pasien,
    u.nama AS pasien_nama,
    jt.keluhan,
    jt.status,
    jt.keterangan,
    jt.jadwal_promo_id,
    p.judul_promo,
    
    -- Waktu mulai dan selesai berdasarkan kondisi jadwal
    CASE
        WHEN jt.jadwal_promo_id IS NOT NULL THEN dp.tanggal
        WHEN jt.jadwal_id IS NOT NULL THEN jj.waktu_mulai
        ELSE NULL
    END AS waktu_mulai,
    CASE
        WHEN jt.jadwal_promo_id IS NOT NULL THEN dp.tanggal
        WHEN jt.jadwal_id IS NOT NULL THEN jj.waktu_selesai
        ELSE NULL
    END AS waktu_selesai,
    
    l.id AS id_layanan,
    l.jenis_layanan,
    l.harga,
    p.diskon
FROM 
    janji_temu jt
LEFT JOIN users u ON jt.id_pasien = u.id
LEFT JOIN jadwal_janji_temu jj ON jt.jadwal_id = jj.id
LEFT JOIN detail_promo dp ON jt.jadwal_promo_id = dp.id
LEFT JOIN promo p ON dp.promo_id = p.id
LEFT JOIN layanan l ON p.layanan_id = l.id;
");
    

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    }
};