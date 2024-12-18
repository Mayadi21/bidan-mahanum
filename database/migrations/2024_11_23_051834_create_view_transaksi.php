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
                    t.id_pasien,
                    t.janji_id, -- Menambahkan kolom janji_id
                    pasien.nama AS nama_pasien,  -- Mengambil nama pasien dari tabel users
                    bidan.nama AS nama_bidan,    -- Mengambil nama bidan dari tabel users
                    t.keterangan,
                    t.tanggal,
                    GROUP_CONCAT(l.jenis_layanan ORDER BY l.id SEPARATOR ', ') AS layanan,
                    -- Menggabungkan jenis_layanan, harga, dan potongan
                    GROUP_CONCAT(
                        CONCAT(
                            l.jenis_layanan, 
                            ' (Harga: ', IFNULL(dt.harga, 0), 
                            ', Potongan: ', IFNULL(dt.potongan, 0), ')'
                        ) 
                        ORDER BY l.id 
                        SEPARATOR '; '
                    ) AS detail_layanan, -- Nama layanan, harga, dan potongan
                    SUM(dt.harga - IFNULL(dt.potongan, 0)) AS total_harga, -- Total transaksi
                    p.judul_promo -- Menambahkan judul promo jika ada
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
                LEFT JOIN 
                    janji_temu jt ON t.janji_id = jt.id -- JOIN dengan tabel janji_temu
                LEFT JOIN 
                    detail_promo dp ON jt.jadwal_promo_id = dp.id -- Menghubungkan janji_temu dengan promo
                LEFT JOIN 
                    promo p ON dp.promo_id = p.id -- Mengambil judul promo dari tabel promo
                GROUP BY 
                    t.id, t.id_pasien, t.janji_id, pasien.nama, bidan.nama, t.keterangan, t.tanggal, p.judul_promo; 
                    
                    ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

    }
};