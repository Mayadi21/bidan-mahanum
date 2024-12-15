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
DROP TRIGGER IF EXISTS after_promo_insert;
CREATE TRIGGER after_promo_insert
AFTER INSERT ON promo
FOR EACH ROW
BEGIN
    INSERT INTO log (modifier_id, table_name, log_target, log_action, old_value, new_value, log_time)
    VALUES (
        @modifier_id,
        'promo',
        NEW.id,
        'insert',
        NULL,
        JSON_OBJECT(
            'judul_promo', NEW.judul_promo,
            'deskripsi', NEW.deskripsi,
            'layanan_id', NEW.layanan_id,
            'diskon', NEW.diskon
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
        Schema::dropIfExists('trigger_after_promo_change');
    }
};
