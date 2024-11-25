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
        DB::statement("
            CREATE OR REPLACE VIEW view_transaksi AS
            SELECT 
                t.id AS transaksi_id,
                pasien.nama AS nama_pasien,  -- Mengambil nama pasien dari tabel users
                bidan.nama AS nama_bidan,    -- Mengambil nama bidan dari tabel users
                t.keterangan,
                t.tanggal,
                GROUP_CONCAT(l.jenis_layanan ORDER BY l.id SEPARATOR ', ') AS layanan,
                SUM(dt.harga) AS total_harga
            FROM 
                transaksi t
            LEFT JOIN 
                detail_transaksi dt ON t.id = dt.transaksi_id
            LEFT JOIN 
                layanan l ON dt.layanan_id = l.id
            LEFT JOIN 
                users pasien ON t.id_pasien = pasien.id  -- JOIN dengan tabel users untuk pasien
            LEFT JOIN 
                users bidan ON t.bidan = bidan.id  -- JOIN dengan tabel users untuk bidan
            GROUP BY 
                t.id, pasien.nama, bidan.nama, t.keterangan, t.tanggal;
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

    }
};