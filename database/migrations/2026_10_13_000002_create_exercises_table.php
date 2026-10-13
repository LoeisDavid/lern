<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('exercises', function (Blueprint $table) {
            $table->id();
            $table->foreignId('learning_stage_id')->constrained()->cascadeOnDelete();
            $table->string('level', 10);
            $table->string('type', 20);
            $table->unsignedTinyInteger('position');
            $table->string('title');
            $table->text('description');
            $table->text('instruction');
            $table->text('objective');
            $table->text('answer_guide');
            $table->json('key_points');
            $table->json('rubric');
            $table->json('options')->nullable();
            $table->json('answer_key')->nullable();
            $table->text('explanation');
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->unique(['learning_stage_id', 'level', 'position']);
            $table->index(['learning_stage_id', 'level', 'is_active']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('exercises');
    }
};
