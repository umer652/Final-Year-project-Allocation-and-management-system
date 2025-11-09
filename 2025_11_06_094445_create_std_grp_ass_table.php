<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('std_grp_ass', function (Blueprint $table) {
            $table->id('id');

            // Foreign keys
            $table->unsignedBigInteger('student_id');   // FK → students
            $table->unsignedBigInteger('group_id');     // FK → groups
            $table->unsignedBigInteger('session_id');   // FK → academic_sessions

            $table->string('technology')->nullable();

            // Define relationships
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
            $table->foreign('group_id')->references('gr_id')->on('groups')->onDelete('cascade');
            $table->foreign('session_id')->references('session_id')->on('academic_sessions')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('std_grp_ass');
    }
};
