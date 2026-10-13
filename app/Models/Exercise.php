<?php

namespace App\Models;

use App\Enums\ExerciseLevel;
use App\Enums\ExerciseType;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Exercise extends Model
{
    use HasFactory;

    protected $fillable = [
        'learning_stage_id',
        'level',
        'type',
        'position',
        'title',
        'description',
        'instruction',
        'objective',
        'answer_guide',
        'key_points',
        'rubric',
        'options',
        'answer_key',
        'explanation',
        'is_active',
    ];

    /**
     * Mencegah kunci jawaban ikut terserialisasi (JSON/array) ke browser.
     * Tampilan pengerjaan tidak boleh membaca atribut-atribut ini.
     */
    protected $hidden = [
        'answer_key',
        'answer_guide',
        'key_points',
        'rubric',
        'explanation',
    ];

    protected function casts(): array
    {
        return [
            'level' => ExerciseLevel::class,
            'type' => ExerciseType::class,
            'position' => 'integer',
            'key_points' => 'array',
            'rubric' => 'array',
            'options' => 'array',
            'answer_key' => 'array',
            'is_active' => 'boolean',
        ];
    }

    public function stage(): BelongsTo
    {
        return $this->belongsTo(LearningStage::class, 'learning_stage_id');
    }

    public function attempts(): HasMany
    {
        return $this->hasMany(ExerciseAttempt::class);
    }

    public function progressRecords(): HasMany
    {
        return $this->hasMany(ExerciseProgress::class);
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function scopeForLevel(Builder $query, ExerciseLevel $level): Builder
    {
        return $query->where('level', $level->value);
    }

    public function isAutoGraded(): bool
    {
        return $this->type->isAutoGraded();
    }

    /**
     * Data aman untuk ditampilkan saat pengerjaan.
     * Untuk dnd_order, urutan blok diacak secara deterministik per pengunjung
     * agar tidak sama dengan urutan jawaban acuan.
     */
    public function publicOptions(string $seed = ''): array
    {
        $options = $this->options ?? [];

        if ($this->type === ExerciseType::DragOrder) {
            usort($options, fn ($a, $b) => strcmp(
                md5($seed.$this->id.$a['id']),
                md5($seed.$this->id.$b['id'])
            ));
        }

        return $options;
    }
}
