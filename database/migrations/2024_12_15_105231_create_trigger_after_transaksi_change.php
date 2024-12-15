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
DROP TRIGGER IF EXISTS after_transaksi_insert;
CREATE TRIGGER after_transaksi_insert
AFTER INSERT ON transaksi
FOR EACH ROW
BEGIN
    INSERT INTO log (modifier_id, table_name, log_target, log_action, old_value, new_value, log_time)
    VALUES (
        @modifier_id,
        'transaksi',
        NEW.id,
        'insert',
        NULL,
        JSON_OBJECT(
            'id_pasien', NEW.id_pasien,
            'janji_id', NEW.janji_id,
            'bidan', NEW.bidan,
            'keterangan', NEW.keterangan,
            'tanggal', NEW.tanggal
        ),
        NOW()
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
        Schema::dropIfExists('trigger_after_transaksi_change');
    }
};
