<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('assigned_projects', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('project_id');
            $table->unsignedBigInteger('group_id');
            $table->unsignedBigInteger('supervisor_id');
            $table->unsignedBigInteger('session_id');

            $table->string('result')->nullable();     // e.g., Pass/Fail/Grade
            $table->enum('fyp_phase', ['FYP-I','FYP-II']);  // restrict to 2 phases

            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
            $table->foreign('group_id')->references('gr_id')->on('groups')->onDelete('cascade');
            $table->foreign('supervisor_id')->references('id')->on('supervisors')->onDelete('cascade');
            $table->foreign('session_id')->references('id')->on('academic_session')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('assigned_projects');
    }
};
