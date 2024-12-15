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
        DROP TRIGGER IF EXISTS after_jadwal_janji_temu_insert;

        CREATE TRIGGER after_jadwal_janji_temu_insert
        AFTER INSERT ON jadwal_janji_temu
        FOR EACH ROW
        BEGIN
        -- Memasukkan data log untuk operasi INSERT
        INSERT INTO log (modifier_id, table_name, log_target, log_action, old_value, new_value, log_time)
        VALUES (
        @modifier_id, -- ID pengguna yang memodifikasi
        'jadwal_janji_temu', -- Nama tabel
        NEW.id, -- ID dari baris yang dimodifikasi
        'insert', -- Aksi yang dilakukan
        NULL, -- Tidak ada nilai lama untuk operasi INSERT
        JSON_OBJECT(
            'waktu_mulai', NEW.waktu_mulai,
            'waktu_selesai', NEW.waktu_selesai,
            'kuota', NEW.kuota,
        ), -- Nilai baru
        NOW() -- Waktu log
        );
        END;
        ";
        
        DB::unprepared($sql_insert);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trigger_after_jadwal_janji_temu_change');
    }
};
