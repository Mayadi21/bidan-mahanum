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
DROP TRIGGER IF EXISTS after_penggajian_insert;
CREATE TRIGGER after_penggajian_insert
AFTER INSERT ON penggajian
FOR EACH ROW
BEGIN
    INSERT INTO log (modifier_id, table_name, log_target, log_action, old_value, new_value, log_time)
    VALUES (
        @modifier_id,
        'penggajian',
        NEW.id,
        'insert',
        NULL,
        JSON_OBJECT(
            'id_bidan', NEW.id_bidan,
            'gaji_pokok', NEW.gaji_pokok,
            'bonus', NEW.bonus,
            'bulan_gaji', NEW.bulan_gaji,
            'tanggal_penggajian', NEW.tanggal_penggajian,
            'tahun_gaji', NEW.tahun_gaji,
            'status', NEW.status
        ),
        NOW()
    );
END;
        ";
        
        DB::unprepared($sql_insert);
        
        $sql_update = "
DROP TRIGGER IF EXISTS after_penggajian_update;
CREATE TRIGGER after_penggajian_update
AFTER UPDATE ON penggajian
FOR EACH ROW
BEGIN
    INSERT INTO log (modifier_id, table_name, log_target, log_action, old_value, new_value, log_time)
    VALUES (
        @modifier_id,
        'penggajian',
        NEW.id,
        'update',
        JSON_OBJECT(
            'id_bidan', OLD.id_bidan,
            'gaji_pokok', OLD.gaji_pokok,
            'bonus', OLD.bonus,
            'bulan_gaji', OLD.bulan_gaji,
            'tanggal_penggajian', OLD.tanggal_penggajian,
            'tahun_gaji', OLD.tahun_gaji,
            'status', OLD.status
        ),
        JSON_OBJECT(
            'id_bidan', NEW.id_bidan,
            'gaji_pokok', NEW.gaji_pokok,
            'bonus', NEW.bonus,
            'bulan_gaji', NEW.bulan_gaji,
            'tanggal_penggajian', NEW.tanggal_penggajian,
            'tahun_gaji', NEW.tahun_gaji,
            'status', NEW.status
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
        Schema::dropIfExists('trigger_after_penggajian_change');
    }
};