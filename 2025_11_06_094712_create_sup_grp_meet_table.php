<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('sup_grp_mees', function (Blueprint $table) {
            $table->id('sup_grp_mee_id');
            $table->unsignedBigInteger('supervisor_id');
            $table->unsignedBigInteger('group_id');
            $table->unsignedBigInteger('meeting_id');
            $table->string('status')->default('scheduled'); // scheduled, completed, cancelled

            // Foreign keys
            $table->foreign('supervisor_id')->references('id')->on('supervisors')->onDelete('cascade');
            $table->foreign('group_id')->references('gr_id')->on('groups')->onDelete('cascade');
            $table->foreign('meeting_id')->references('meeting_id')->on('meetings')->onDelete('cascade');
        });
    }

    public function down():void
    {
        Schema::dropIfExists('sup_grp_meet');
    }
};
