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
            penggajian.id_bidan,
            penggajian.id AS id_penggajian,
            users.nama AS nama_bidan,
            penggajian.gaji_pokok,
            penggajian.bonus,
            (penggajian.gaji_pokok + penggajian.bonus) AS total_gaji,
            CASE 
                WHEN penggajian.status = '0' THEN 'Belum Dibayar'
                WHEN penggajian.status = '1' THEN 'Sudah Dibayar'
            END AS status,
            penggajian.awal_periode_gaji,
            penggajian.akhir_periode_gaji,
            penggajian.tanggal_penggajian

        FROM penggajian
        INNER JOIN users ON penggajian.id_bidan = users.id
        ORDER BY penggajian.tanggal_penggajian DESC;

        ");
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

    }
};
