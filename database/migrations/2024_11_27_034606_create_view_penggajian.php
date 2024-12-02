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
        DB::statement("
            CREATE OR REPLACE VIEW view_penggajian AS
            SELECT 
                penggajian.id AS id_penggajian,
                users.nama AS nama_bidan,
                penggajian.gaji_pokok,
                penggajian.bonus,
                (penggajian.gaji_pokok + penggajian.bonus) AS total_gaji,
                CASE 
                    WHEN penggajian.bulan_gaji = 1 THEN 'Januari'
                    WHEN penggajian.bulan_gaji = 2 THEN 'Februari'
                    WHEN penggajian.bulan_gaji = 3 THEN 'Maret'
                    WHEN penggajian.bulan_gaji = 4 THEN 'April'
                    WHEN penggajian.bulan_gaji = 5 THEN 'Mei'
                    WHEN penggajian.bulan_gaji = 6 THEN 'Juni'
                    WHEN penggajian.bulan_gaji = 7 THEN 'Juli'
                    WHEN penggajian.bulan_gaji = 8 THEN 'Agustus'
                    WHEN penggajian.bulan_gaji = 9 THEN 'September'
                    WHEN penggajian.bulan_gaji = 10 THEN 'Oktober'
                    WHEN penggajian.bulan_gaji = 11 THEN 'November'
                    WHEN penggajian.bulan_gaji = 12 THEN 'Desember'
                END AS bulan_gaji,
                penggajian.tahun_gaji,
                CASE 
                    WHEN penggajian.status = '0' THEN 'Belum Diserahkan'
                    WHEN penggajian.status = '1' THEN 'Sudah Diserahkan'
                END AS status,
                penggajian.tanggal_penggajian

            FROM penggajian
            INNER JOIN users ON penggajian.id_bidan = users.id
            ORDER BY penggajian.tanggal_penggajian DESC
        ");
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

    }
};
