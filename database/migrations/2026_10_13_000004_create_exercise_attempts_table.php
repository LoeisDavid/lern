<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('exercise_attempts', function (Blueprint $table) {
            $table->id();
            $table->char('visitor_token', 36);
            $table->foreignId('exercise_id')->constrained()->cascadeOnDelete();
            $table->json('submitted_answer');
            $table->boolean('is_correct');
            $table->json('result_detail')->nullable();
            $table->timestamps();

            $table->index(['visitor_token', 'exercise_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('exercise_attempts');
    }
};
