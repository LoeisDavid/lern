<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('learning_stages', function (Blueprint $table) {
            $table->id();
            $table->unsignedTinyInteger('number')->unique();
            $table->string('slug')->unique();
            $table->string('name');
            $table->text('goal');
            $table->text('summary');
            $table->json('skills');
            $table->json('level_methods');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('learning_stages');
    }
};
