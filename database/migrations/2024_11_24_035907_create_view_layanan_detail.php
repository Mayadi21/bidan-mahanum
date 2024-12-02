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
            CREATE OR REPLACE VIEW view_layanan_detail AS
            SELECT 
                layanan.id AS layanan_id,
                layanan.jenis_layanan,
                layanan.deskripsi AS deskripsi_layanan,
                layanan.harga,
                layanan.gambar,
                layanan.besar_bonus,
                layanan.status AS status_layanan,
                ulasan.id AS ulasan_id,
                ulasan.ulasan AS isi_ulasan,
                ulasan.status AS status_ulasan,
                ulasan.tanggal_ulasan,
                users.id AS pengguna_id,
                users.nama AS nama_pengguna
            FROM layanan
            LEFT JOIN ulasan ON layanan.id = ulasan.layanan_id
            LEFT JOIN users ON ulasan.id_pengguna = users.id;

        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
    }
};
