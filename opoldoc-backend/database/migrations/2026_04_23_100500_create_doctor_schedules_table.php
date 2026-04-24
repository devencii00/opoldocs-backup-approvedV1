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
        Schema::create('doctor_schedules', function (Blueprint $table) {
            $table->id('schedule_id');

            $table->unsignedBigInteger('doctor_id');
            $table->foreign('doctor_id')->references('user_id')->on('users')->cascadeOnDelete();

            $table->time('start_time');
            $table->time('end_time');
            $table->integer('max_patients')->nullable();

            $table->timestamps();

            $table->index('doctor_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctor_schedules');
    }
};
