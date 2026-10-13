<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ExerciseProgress extends Model
{
    protected $table = 'exercise_progress';

    protected $fillable = [
        'visitor_token',
        'exercise_id',
        'is_completed',
        'completed_at',
        'self_evaluated',
        'self_evaluated_at',
        'checklist',
    ];

    protected function casts(): array
    {
        return [
            'is_completed' => 'boolean',
            'completed_at' => 'datetime',
            'self_evaluated' => 'boolean',
            'self_evaluated_at' => 'datetime',
            'checklist' => 'array',
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
