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
        Schema::table('students', function (Blueprint $table) {
            $table->string('lrn')->unique()->after('id');
            $table->string('last_name')->after('lrn');
            $table->string('first_name')->after('last_name');
            $table->string('middle_initial', 1)->nullable()->after('first_name');
            $table->enum('sex', ['Male','Female'])->after('middle_initial');
            $table->unsignedBigInteger('section_id')->nullable()->after('sex');

            $table->foreign('section_id')->references('id')->on('sections')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('students', function (Blueprint $table) {
            $table->dropForeign(['section_id']);
            $table->dropColumn(['lrn','last_name','first_name','middle_initial','sex','section_id']);
        });
    }
};
