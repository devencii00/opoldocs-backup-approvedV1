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
        Schema::create('doctor_schedule_days', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('schedule_id');
            $table->foreign('schedule_id')->references('schedule_id')->on('doctor_schedules')->cascadeOnDelete();

            $table->enum('day_of_week', ['mon', 'tue', 'wed', 'thu', 'fri', 'sat', 'sun']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctor_schedule_days');
    }
};
