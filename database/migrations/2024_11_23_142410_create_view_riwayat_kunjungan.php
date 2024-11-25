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
        DB::statement('
            CREATE OR REPLACE VIEW riwayat_kunjungan AS
            SELECT
                t.tanggal,
                u.nama AS bidan, 
                GROUP_CONCAT(l.jenis_layanan ORDER BY l.id SEPARATOR ", ") AS layanan,
                t.keterangan
            FROM
                transaksi t
            JOIN
                users u ON t.bidan = u.id
            JOIN
                detail_transaksi dt ON t.id = dt.transaksi_id
            JOIN
                layanan l ON dt.layanan_id = l.id
            GROUP BY t.tanggal, u.nama, t.keterangan
            ORDER BY t.tanggal DESC;
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
    }
};
