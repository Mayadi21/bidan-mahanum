<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('log', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('modifier_id')->nullable();// id user
            $table->string('table_name'); // nama tabel
            $table->string('log_target');
            $table->enum('log_action', ['insert', 'update', 'delete']); 
            $table->longText('old_value')->nullable();
            $table->longText('new_value')->nullable();
            $table->timestamp('log_time');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('log');
    }
};
