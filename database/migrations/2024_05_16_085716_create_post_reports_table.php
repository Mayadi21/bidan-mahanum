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
    Schema::table('post_reports', function (Blueprint $table) {
        $table->string('report_name');
        $table->text('report_description');
        $table->id();
        $table->foreignId('post_id')->constrained()->onDelete('cascade');
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->foreignId('report_id')->constrained('reports')->onDelete('cascade');
        $table->timestamps();
    });
}

public function down()
{
    Schema::table('post_reports', function (Blueprint $table) {
        $table->dropColumn(['report_name', 'report_description']);
    });
}
};