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
  Schema::create('patient_verifications', function (Blueprint $table) {
    $table->id('verification_id');

    $table->unsignedBigInteger('patient_id');
    $table->foreign('patient_id')->references('user_id')->on('users')->cascadeOnDelete();

    $table->enum('type', ['senior','pwd','pregnant']);
    $table->enum('status', ['active','inactive'])->default('active');

    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patient_verification');
    }
};
