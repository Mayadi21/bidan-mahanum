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
DROP TRIGGER IF EXISTS after_gaji_pokok_insert;
CREATE TRIGGER after_gaji_pokok_insert
AFTER INSERT ON gaji_pokok
FOR EACH ROW
BEGIN
    INSERT INTO log (modifier_id, table_name, log_target, log_action, old_value, new_value, log_time)
    VALUES (
        @modifier_id,
        'gaji_pokok',
        NEW.id,
        'insert',
        NULL,
        JSON_OBJECT(
            'id_bidan', NEW.id_bidan,
            'gaji_pokok', NEW.gaji_pokok
        ),
        NOW()
    );
END;
        ";
        
        DB::unprepared($sql_insert);
        
        $sql_update = "
DROP TRIGGER IF EXISTS after_gaji_pokok_update;
CREATE TRIGGER after_gaji_pokok_update
AFTER UPDATE ON gaji_pokok
FOR EACH ROW
BEGIN
    INSERT INTO log (modifier_id, table_name, log_target, log_action, old_value, new_value, log_time)
    VALUES (
        @modifier_id,
        'gaji_pokok',
        NEW.id,
        'update',
        JSON_OBJECT(
            'id_bidan', OLD.id_bidan,
            'gaji_pokok', OLD.gaji_pokok
        ),
        JSON_OBJECT(
            'id_bidan', NEW.id_bidan,
            'gaji_pokok', NEW.gaji_pokok
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
        Schema::dropIfExists('trigger_after_gaji_pokok_change');
    }
};
