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
   Schema::create('chatbot_questions', function (Blueprint $table) {
    $table->id('question_id');
    $table->text('question_text');
});

Schema::create('chatbot_options', function (Blueprint $table) {
    $table->id('option_id');

    $table->unsignedBigInteger('question_id');
    $table->foreign('question_id')->references('question_id')->on('chatbot_questions')->cascadeOnDelete();

    $table->string('option_text');
    $table->text('response_text')->nullable();

    $table->unsignedBigInteger('next_question_id')->nullable();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chatbot');
    }
};
