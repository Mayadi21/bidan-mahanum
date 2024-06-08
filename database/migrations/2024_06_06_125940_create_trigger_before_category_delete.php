<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Create trigger
        DB::unprepared('
            CREATE TRIGGER before_category_delete
            BEFORE DELETE ON categories
            FOR EACH ROW
            BEGIN
                UPDATE posts SET category_id = 31 WHERE category_id = OLD.id;  
            END
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop trigger
        DB::unprepared('DROP TRIGGER IF EXISTS before_category_delete');
    }
};
