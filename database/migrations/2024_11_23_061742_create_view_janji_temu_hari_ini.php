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
        jt.id, -- ID Janji Temu
        u.id AS id_pasien, -- ID pasien dari tabel users
        u.nama AS pasien_nama, -- Nama pasien dari tabel users
        jt.keluhan, -- Keluhan pasien
        jt.status, -- Status janji temu
        jt.keterangan, -- Keterangan tambahan
        p.judul_promo, -- Nama promo dari tabel promo
        -- Menambahkan waktu mulai dan waktu selesai dari tabel jadwal_janji_temu atau detail_promo
        CASE
            WHEN jt.jadwal_promo_id IS NOT NULL THEN dp.tanggal -- Jika jadwal_promo_id ada, ambil tanggal dari detail_promo
            WHEN jt.jadwal_id IS NOT NULL THEN jj.waktu_mulai -- Jika jadwal_id ada, ambil waktu mulai dari jadwal_janji_temu
            ELSE NULL
        END AS waktu_mulai, -- Waktu mulai
        CASE
            WHEN jt.jadwal_promo_id IS NOT NULL THEN dp.tanggal -- Jika jadwal_promo_id ada, ambil tanggal dari detail_promo
            WHEN jt.jadwal_id IS NOT NULL THEN jj.waktu_selesai -- Jika jadwal_id ada, ambil waktu selesai dari jadwal_janji_temu
            ELSE NULL -- Tidak ada waktu selesai untuk promo karena mengacu pada tanggal promo saja
        END AS waktu_selesai -- Waktu selesai
    FROM 
        janji_temu jt
    LEFT JOIN 
        users u ON jt.id_pasien = u.id -- Left join dengan users untuk mendapatkan info pasien
    LEFT JOIN 
        detail_promo dp ON jt.jadwal_promo_id = dp.id -- Left join dengan detail_promo untuk mendapatkan informasi tanggal promo spesifik
    LEFT JOIN 
        promo p ON dp.promo_id = p.id -- Left join dengan promo untuk mendapatkan judul promo
    LEFT JOIN 
        jadwal_janji_temu jj ON jt.jadwal_id = jj.id -- Left join dengan jadwal_janji_temu untuk mendapatkan waktu mulai dan selesai
    ORDER BY waktu_mulai DESC;
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