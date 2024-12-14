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
            u.id AS id_pasien, -- ID pasien dari users
            u.nama AS pasien_nama, -- Nama pasien dari users
            jt.keluhan, -- Keluhan pasien
            jt.status, -- Status janji temu
            jt.keterangan, -- Keterangan tambahan
            ep.judul_promo, -- Nama promo dari tabel promo
            -- Menambahkan waktu mulai dan waktu selesai dari tabel jadwal_janji_temu atau promo
            CASE
                WHEN jt.jadwal_id IS NOT NULL THEN jj.waktu_mulai -- Jika jadwal_id ada, ambil waktu mulai dari jadwal_janji_temu
                WHEN jt.promo_id IS NOT NULL THEN ep.tanggal_mulai -- Jika promo_id ada, ambil tanggal mulai dari promo
                ELSE NULL
            END AS waktu_mulai, -- Waktu mulai
            CASE
                WHEN jt.jadwal_id IS NOT NULL THEN jj.waktu_selesai -- Jika jadwal_id ada, ambil waktu selesai dari jadwal_janji_temu
                WHEN jt.promo_id IS NOT NULL THEN ep.tanggal_selesai -- Jika promo_id ada, ambil tanggal selesai dari promo
                ELSE NULL
            END AS waktu_selesai -- Waktu selesai
        FROM 
            janji_temu jt
        LEFT JOIN 
            users u ON jt.id_pasien = u.id -- Left join dengan users
        LEFT JOIN 
            promo ep ON jt.promo_id = ep.id -- Left join dengan promo
        LEFT JOIN 
            jadwal_janji_temu jj ON jt.jadwal_id = jj.id -- Left join dengan jadwal_janji_temu untuk mendapatkan waktu mulai dan selesai
        ORDER BY waktu_mulai DESC");
    

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