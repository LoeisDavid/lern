<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ExerciseAttempt extends Model
{
    protected $fillable = [
        'visitor_token',
        'exercise_id',
        'submitted_answer',
        'is_correct',
        'result_detail',
    ];

    protected function casts(): array
    {
        return [
            'submitted_answer' => 'array',
            'is_correct' => 'boolean',
            'result_detail' => 'array',
        ];
    }

    public function exercise(): BelongsTo
    {
        return $this->belongsTo(Exercise::class);
    }

    public function scopeForVisitor(Builder $query, string $token): Builder
    {
        return $query->where('visitor_token', $token);
    }
}
