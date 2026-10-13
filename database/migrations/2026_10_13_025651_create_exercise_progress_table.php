<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('exercise_progress', function (Blueprint $table) {
            $table->id();
            $table->char('visitor_token', 36);
            $table->foreignId('exercise_id')->constrained()->cascadeOnDelete();
            $table->boolean('is_completed')->default(false);
            $table->timestamp('completed_at')->nullable();
            $table->boolean('self_evaluated')->default(false);
            $table->timestamp('self_evaluated_at')->nullable();
            $table->json('checklist')->nullable();
            $table->timestamps();

            $table->unique(['visitor_token', 'exercise_id']);
            $table->index('visitor_token');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('exercise_progress');
    }
};
