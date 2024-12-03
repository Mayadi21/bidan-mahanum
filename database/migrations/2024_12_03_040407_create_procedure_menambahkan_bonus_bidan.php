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
        DB::unprepared('
        DROP PROCEDURE IF EXISTS menambahkan_bonus_bidan;

        CREATE PROCEDURE menambahkan_bonus_bidan(IN transaksiId INT)
        BEGIN
            -- Deklarasi variabel
            DECLARE bonusAmount INT;
            DECLARE bidanRole VARCHAR(255);
            DECLARE bidanId INT;

            -- Ambil ID bidan dari transaksi yang terkait
            SELECT bidan INTO bidanId
            FROM transaksi
            WHERE id = transaksiId;

            -- Ambil role dari bidan
            SELECT role INTO bidanRole
            FROM users
            WHERE id = bidanId;

            -- Periksa apakah role bidan bukan "admin"
            IF bidanRole != "admin" THEN
                -- Ambil besar_bonus dari layanan yang terkait dengan transaksi
                SELECT SUM(layanan.besar_bonus) INTO bonusAmount
                FROM detail_transaksi
                JOIN layanan ON layanan.id = detail_transaksi.layanan_id
                WHERE detail_transaksi.transaksi_id = transaksiId;

                -- Perbarui bonus pada tabel penggajian
                UPDATE penggajian
                SET bonus = bonus + bonusAmount
                WHERE id_bidan = bidanId
                  AND status = "0"; -- Pastikan hanya yang belum dibayar yang diperbarui
            END IF;
        END;
    ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
    }
};
