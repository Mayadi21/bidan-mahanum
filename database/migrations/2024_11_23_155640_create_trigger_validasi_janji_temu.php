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
        $sql = "

DROP TRIGGER IF EXISTS cek_semua_logika_janji_temu;

CREATE TRIGGER cek_semua_logika_janji_temu
BEFORE INSERT ON janji_temu
FOR EACH ROW 
BEGIN
    -- 1. Cek apakah pasien memiliki janji temu `disetujui` yang belum selesai (kecuali jika pasien daftar promo)
    IF NEW.promo_id IS NULL AND EXISTS (
        SELECT 1 
        FROM janji_temu 
        WHERE id_pasien = NEW.id_pasien 
          AND status = 'disetujui'
    ) THEN
        SIGNAL SQLSTATE '45000' 
        SET MESSAGE_TEXT = 'Terjadi kesalahan: Pasien ini masih memiliki janji temu yang disetujui dan belum selesai.';
    END IF;

    -- 2. Cek apakah pasien sudah mendaftar ke promo ini
    IF NEW.promo_id IS NOT NULL AND EXISTS (
        SELECT 1 
        FROM janji_temu 
        WHERE id_pasien = NEW.id_pasien 
          AND promo_id = NEW.promo_id 
          AND status NOT IN ('ditolak')
    ) THEN
        SIGNAL SQLSTATE '45000' 
        SET MESSAGE_TEXT = 'Pasien ini sudah memiliki janji temu dengan promo ini.';
    END IF;

    -- 3. Cek apakah kuota promo masih tersedia
    IF NEW.promo_id IS NOT NULL THEN
        -- Variabel sesi untuk menyimpan total penggunaan kuota
        SET @total_penggunaan_kuota = (
            SELECT COUNT(*) 
            FROM janji_temu 
            WHERE promo_id = NEW.promo_id 
              AND status NOT IN ('ditolak')
        );

        -- Tambahkan jumlah transaksi dari tabel transaksi
        SET @total_penggunaan_kuota = @total_penggunaan_kuota + (
            SELECT COUNT(*) 
            FROM transaksi 
            WHERE promo_id = NEW.promo_id
        );

        -- Variabel sesi untuk menyimpan kuota promo
        SET @kuota_promo = (
            SELECT kuota 
            FROM promo 
            WHERE id = NEW.promo_id
        );

        -- Jika kuota promo penuh, batalkan proses
        IF @total_penggunaan_kuota >= @kuota_promo THEN
            SIGNAL SQLSTATE '45000' 
            SET MESSAGE_TEXT = 'Kuota promo telah habis.';
        END IF;
    END IF;
END; 




        ";
        DB::unprepared($sql);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
    }
};