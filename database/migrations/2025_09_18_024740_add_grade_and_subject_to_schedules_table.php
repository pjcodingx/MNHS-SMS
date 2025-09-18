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
        Schema::table('schedules', function (Blueprint $table) {
        $table->unsignedBigInteger('grade_level_id')->after('id');
        $table->unsignedBigInteger('subject_id')->nullable()->after('grade_level_id');


        $table->foreign('grade_level_id')->references('id')->on('grade_levels')->onDelete('cascade');
        $table->foreign('subject_id')->references('id')->on('subjects')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('schedules', function (Blueprint $table) {
             $table->dropForeign(['grade_level_id']);
        $table->dropForeign(['subject_id']);
        $table->dropColumn(['grade_level_id', 'subject_id']);
        });
    }
};
