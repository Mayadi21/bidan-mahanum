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
            COALESCE(u.id, ptt.id) AS id_pasien, -- ID pasien dari users atau pasien_tidak_terdaftar
            COALESCE(u.nama, ptt.nama_pasien) AS pasien_nama, -- Nama pasien dari users atau pasien_tidak_terdaftar
            jt.keluhan, -- Keluhan pasien
            jt.waktu_mulai, -- Waktu janji temu dimulai
            jt.waktu_selesai, -- Waktu janji temu selesai
            jt.status, -- Status janji temu
            jt.keterangan, -- Keterangan tambahan
            ep.judul_promo -- Nama promo dari tabel event_promo
        FROM 
            janji_temu jt
        LEFT JOIN 
            users u ON jt.id_pasien = u.id -- Left join dengan users
        LEFT JOIN 
            pasien_tidak_terdaftar ptt ON jt.pasien_tidak_terdaftar_id = ptt.id -- Left join dengan pasien_tidak_terdaftar
        LEFT JOIN 
            event_promo ep ON jt.promo_id = ep.id -- Left join dengan event_promo
        ORDER BY 
            jt.waktu_mulai DESC;
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