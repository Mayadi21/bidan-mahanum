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
        $sql_insert = "
        DROP TRIGGER IF EXISTS after_janji_temu_insert;

        CREATE TRIGGER after_janji_temu_insert
        AFTER INSERT ON janji_temu
        FOR EACH ROW
        BEGIN
        -- Memasukkan data log untuk operasi INSERT
        INSERT INTO log (modifier_id, table_name, log_target, log_action, old_value, new_value, log_time)
        VALUES (
        @modifier_id, -- ID pengguna yang memodifikasi
        'janji_temu', -- Nama tabel
        NEW.id, -- ID dari baris yang dimodifikasi
        'insert', -- Aksi yang dilakukan
        NULL, -- Tidak ada nilai lama untuk operasi INSERT
        JSON_OBJECT(
            'id_pasien', NEW.id_pasien,
            'jadwal_id', NEW.jadwal_id,
            'promo_id', NEW.promo_id,
            'keluhan', NEW.keluhan,
            'keterangan', NEW.keterangan,
        ), -- Nilai baru
        NOW() -- Waktu log
        );
        END;
        ";
        
        DB::unprepared($sql_insert);
        
        $sql_update = "
        DROP TRIGGER IF EXISTS after_janji_temu_update;

        CREATE TRIGGER after_janji_temu_update
        AFTER UPDATE ON janji_temu
        FOR EACH ROW
        BEGIN
        INSERT INTO log (modifier_id, table_name, log_target, log_action, old_value, new_value, log_time)
        VALUES (
        @modifier_id, -- ID pengguna yang memodifikasi
        'janji_temu', -- Nama tabel
        NEW.id, -- ID dari baris yang dimodifikasi
        'update', -- Aksi yang dilakukan
        JSON_OBJECT(
            'id_pasien', OLD.id_pasien,
            'jadwal_id', OLD.jadwal_id,
            'promo_id', OLD.promo_id,
            'status', OLD.status,
            'keterangan', OLD.keterangan,
        ), -- Tidak ada nilai lama untuk operasi INSERT
        JSON_OBJECT(
            'id_pasien', NEW.id_pasien,
            'jadwal_id', NEW.jadwal_id,
            'promo_id', NEW.promo_id,
            'status', NEW.status,
            'keterangan', NEW.keterangan
        ), -- Nilai baru
        NOW() -- Waktu log
        );
        END;
        ";
        DB::unprepared($sql_update);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trigger_after_janji_temu_change');
    }
};
