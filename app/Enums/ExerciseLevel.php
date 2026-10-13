<?php

namespace App\Enums;

enum ExerciseLevel: string
{
    case Easy = 'easy';
    case Medium = 'medium';
    case Hard = 'hard';

    public function label(): string
    {
        return match ($this) {
            self::Easy => 'Easy',
            self::Medium => 'Medium',
            self::Hard => 'Hard',
        };
    }

    public function order(): int
    {
        return match ($this) {
            self::Easy => 1,
            self::Medium => 2,
            self::Hard => 3,
        };
    }
}
