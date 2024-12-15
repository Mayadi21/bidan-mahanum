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
DROP TRIGGER IF EXISTS after_ulasan_insert;
CREATE TRIGGER after_ulasan_insert
AFTER INSERT ON ulasan
FOR EACH ROW
BEGIN
    INSERT INTO log (modifier_id, table_name, log_target, log_action, old_value, new_value, log_time)
    VALUES (
        @modifier_id,
        'ulasan',
        NEW.id,
        'insert',
        NULL,
        JSON_OBJECT(
            'id_pengguna', NEW.id_pengguna,
            'layanan_id', NEW.layanan_id,
            'ulasan', NEW.ulasan,
            'status', NEW.status,
            'tanggal_ulasan', NEW.tanggal_ulasan
        ),
        NOW()
    );
END;
        ";
        
        DB::unprepared($sql_insert);
        
        $sql_update = "
DROP TRIGGER IF EXISTS after_ulasan_update;
CREATE TRIGGER after_ulasan_update
AFTER UPDATE ON ulasan
FOR EACH ROW
BEGIN
    INSERT INTO log (modifier_id, table_name, log_target, log_action, old_value, new_value, log_time)
    VALUES (
        @modifier_id,
        'ulasan',
        NEW.id,
        'update',
        JSON_OBJECT(
            'id_pengguna', OLD.id_pengguna,
            'layanan_id', OLD.layanan_id,
            'ulasan', OLD.ulasan,
            'status', OLD.status,
            'tanggal_ulasan', OLD.tanggal_ulasan
        ),
        JSON_OBJECT(
            'id_pengguna', NEW.id_pengguna,
            'layanan_id', NEW.layanan_id,
            'ulasan', NEW.ulasan,
            'status', NEW.status,
            'tanggal_ulasan', NEW.tanggal_ulasan
        ),
        NOW()
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
        Schema::dropIfExists('trigger_after_ulasan_change');
    }
};
