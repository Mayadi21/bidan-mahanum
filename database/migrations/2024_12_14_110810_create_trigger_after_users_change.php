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
        DROP TRIGGER IF EXISTS after_users_insert;

        CREATE TRIGGER after_users_insert
        AFTER INSERT ON users
        FOR EACH ROW
        BEGIN
        -- Memasukkan data log untuk operasi INSERT
        INSERT INTO log (modifier_id, table_name, log_target, log_action, old_value, new_value, log_time)
        VALUES (
        @modifier_id, -- ID pengguna yang memodifikasi
        'users', -- Nama tabel
        NEW.id, -- ID dari baris yang dimodifikasi
        'insert', -- Aksi yang dilakukan
        NULL, -- Tidak ada nilai lama untuk operasi INSERT
        JSON_OBJECT(
            'nama', NEW.nama,
            'email', NEW.email,
            'tanggal_lahir', NEW.tanggal_lahir,
            'alamat', NEW.alamat,
            'pekerjaan', NEW.pekerjaan,
            'no_hp', NEW.no_hp,
            'status', NEW.status,
            'role', NEW.role
        ), -- Nilai baru
        NOW() -- Waktu log
        );
        END;
        ";

        DB::unprepared($sql_insert);

        $sql_update = "
        DROP TRIGGER IF EXISTS after_users_update;

        CREATE TRIGGER after_users_update
        AFTER UPDATE ON users
        FOR EACH ROW
        BEGIN
        INSERT INTO log (modifier_id, table_name, log_target, log_action, old_value, new_value, log_time)
        VALUES (
        @modifier_id, -- ID pengguna yang memodifikasi
        'users', -- Nama tabel
        NEW.id, -- ID dari baris yang dimodifikasi
        'update', -- Aksi yang dilakukan
        JSON_OBJECT(
            'nama', OLD.nama,
            'email', OLD.email,
            'tanggal_lahir', OLD.tanggal_lahir,
            'alamat', OLD.alamat,
            'pekerjaan', OLD.pekerjaan,
            'no_hp', OLD.no_hp,
            'status', OLD.status,
            'role', OLD.role
        ), -- Tidak ada nilai lama untuk operasi INSERT
        JSON_OBJECT(
            'nama', NEW.nama,
            'email', NEW.email,
            'tanggal_lahir', NEW.tanggal_lahir,
            'alamat', NEW.alamat,
            'pekerjaan', NEW.pekerjaan,
            'no_hp', NEW.no_hp,
            'status', NEW.status,
            'role', NEW.role
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
    }
};
