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
        $sql = "
        DROP TRIGGER IF EXISTS before_insert_jadwal_janji_temu;

        CREATE TRIGGER before_insert_jadwal_janji_temu
        BEFORE INSERT ON jadwal_janji_temu
        FOR EACH ROW
        BEGIN
            -- Validasi 1: Tanggal harus minimal hari ini
            IF NEW.waktu_mulai < CURRENT_TIMESTAMP THEN
                SIGNAL SQLSTATE '45000'
                SET MESSAGE_TEXT = 'Tanggal dan waktu mulai harus minimal hari ini.';
            END IF;

            -- Validasi 2: Pastikan waktu tidak bertabrakan dengan jadwal lain
            IF EXISTS (
                SELECT 1 
                FROM jadwal_janji_temu 
                WHERE 
                    (NEW.waktu_mulai BETWEEN waktu_mulai AND waktu_selesai 
                    OR NEW.waktu_selesai BETWEEN waktu_mulai AND waktu_selesai 
                    OR (NEW.waktu_mulai < waktu_mulai AND NEW.waktu_selesai > waktu_selesai))
            ) THEN
                SIGNAL SQLSTATE '45000'
                SET MESSAGE_TEXT = 'Jadwal input bertabrakan dengan jadwal yang sudah ada.';
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
