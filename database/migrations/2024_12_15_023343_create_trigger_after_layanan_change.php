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
        DROP TRIGGER IF EXISTS after_layanan_insert;

        CREATE TRIGGER after_layanan_insert
        AFTER INSERT ON layanan
        FOR EACH ROW
        BEGIN
        -- Memasukkan data log untuk operasi INSERT
        INSERT INTO log (modifier_id, table_name, log_target, log_action, old_value, new_value, log_time)
        VALUES (
        @modifier_id, -- ID pengguna yang memodifikasi
        'layanan', -- Nama tabel
        NEW.id, -- ID dari baris yang dimodifikasi
        'insert', -- Aksi yang dilakukan
        NULL, -- Tidak ada nilai lama untuk operasi INSERT
        JSON_OBJECT(
            'jenis_layanan', NEW.jenis_layanan,
            'deskripsi', NEW.deskripsi,
            'harga', NEW.harga,
            'gambar', NEW.besar_bonus,
            'status', NEW.status
        ), -- Nilai baru
        NOW() -- Waktu log
        );
        END;
        ";

        DB::unprepared($sql_insert);

        $sql_update = "
        DROP TRIGGER IF EXISTS after_layanan_update;

        CREATE TRIGGER after_layanan_update
        AFTER UPDATE ON layanan
        FOR EACH ROW
        BEGIN
            SET NEW.modifier_id = @modifier_id;
        INSERT INTO log (modifier_id, table_name, log_target, log_action, old_value, new_value, log_time)
        VALUES (
        @modifier_id, -- ID pengguna yang memodifikasi
        'layanan', -- Nama tabel
        NEW.id, -- ID dari baris yang dimodifikasi
        'update', -- Aksi yang dilakukan
        JSON_OBJECT(
            'jenis_layanan', NEW.jenis_layanan,
            'deskripsi', OLD.deskripsi,
            'harga', OLD.harga,
            'gambar', OLD.besar_bonus,
            'status', OLD.status
        ), -- Tidak ada nilai lama untuk operasi INSERT
        JSON_OBJECT(
            'jenis_layanan', NEW.jenis_layanan,
            'deskripsi', NEW.deskripsi,
            'harga', NEW.harga,
            'gambar', NEW.besar_bonus,
            'status', NEW.status
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
        Schema::dropIfExists('trigger_after_layanan_change');
    }
};
