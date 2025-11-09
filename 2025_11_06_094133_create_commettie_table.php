<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('commetties', function (Blueprint $table) {
            $table->id();

            // foreign key to users table
            $table->string('user_id');
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');

            // only attribute in your ERD
            $table->string('designation');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('commetties');
    }
};
