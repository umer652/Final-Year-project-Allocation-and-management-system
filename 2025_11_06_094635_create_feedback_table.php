<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('feedbacks', function (Blueprint $table) {
            $table->id('feedback_id');

            // Foreign keys - match PKs in related tables
            $table->unsignedBigInteger('student_id');
            $table->unsignedBigInteger('group_id');
            $table->unsignedBigInteger('meeting_id');

            $table->foreign('student_id')->references('id')->on('students')->cascadeOnDelete();
            $table->foreign('group_id')->references('gr_id')->on('groups')->cascadeOnDelete();
            $table->foreign('meeting_id')->references('meeting_id')->on('meetings')->cascadeOnDelete();

            $table->time('start_time');
            $table->time('end_time')->nullable();
            $table->text('remarks')->nullable();
            
            // Prevent duplicate feedback from same student in same meeting & group
            $table->unique(['student_id','group_id','meeting_id'], 'uniq_feedback_student_group_meeting');
        });
    }

    public function down(): void {
        Schema::dropIfExists('feedbacks');
    }
};
