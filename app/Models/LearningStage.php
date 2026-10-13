<?php

namespace App\Models;

use App\Enums\ExerciseLevel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LearningStage extends Model
{
    use HasFactory;

    protected $fillable = [
        'number',
        'slug',
        'name',
        'goal',
        'summary',
        'skills',
        'level_methods',
    ];

    protected function casts(): array
    {
        return [
            'number' => 'integer',
            'skills' => 'array',
            'level_methods' => 'array',
        ];
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function exercises(): HasMany
    {
        return $this->hasMany(Exercise::class)->orderBy('position');
    }

    public function activeExercises(ExerciseLevel $level): HasMany
    {
        return $this->exercises()
            ->where('level', $level->value)
            ->where('is_active', true);
    }

    public function methodFor(ExerciseLevel $level): string
    {
        return $this->level_methods[$level->value] ?? '';
    }
}
