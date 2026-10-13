<?php

namespace App\Services;

use App\Enums\ExerciseLevel;
use App\Enums\ExerciseType;
use App\Models\Exercise;
use App\Models\ExerciseProgress;
use App\Models\LearningStage;

class ProgressService
{
    /**
     * Ringkasan progres satu pengunjung: [stage_id][level] => data.
     * Semua tahap dan level selalu ada, walaupun belum punya soal.
     *
     * @return array<int, array<string, array<string, mixed>>>
     */
    public function summary(string $token): array
    {
        $exercises = Exercise::active()->get(['id', 'learning_stage_id', 'level', 'position', 'type']);

        $progress = ExerciseProgress::forVisitor($token)
            ->whereIn('exercise_id', $exercises->pluck('id'))
            ->get()
            ->keyBy('exercise_id');

        $byStage = $exercises->groupBy('learning_stage_id');
        $result = [];

        foreach (LearningStage::pluck('id') as $stageId) {
            foreach (ExerciseLevel::cases() as $level) {
                $items = ($byStage->get($stageId) ?? collect())
                    ->filter(fn ($e) => $e->level === $level)
                    ->sortBy('position')
                    ->values();

                $completed = $items->filter(fn ($e) => $progress->get($e->id)?->is_completed)->count();
                $paper = $items->filter(fn ($e) => $e->type === ExerciseType::Paper);
                $evaluated = $paper->filter(fn ($e) => $progress->get($e->id)?->self_evaluated)->count();
                $next = $items->first(fn ($e) => ! $progress->get($e->id)?->is_completed) ?? $items->first();
                $total = $items->count();

                $result[$stageId][$level->value] = [
                    'total' => $total,
                    'completed' => $completed,
                    'paper_total' => $paper->count(),
                    'evaluated' => $evaluated,
                    'next_position' => $next?->position,
                    'status' => match (true) {
                        $total === 0 => 'kosong',
                        $completed === 0 => 'belum',
                        $completed < $total => 'berjalan',
                        default => 'selesai',
                    },
                ];
            }
        }

        return $result;
    }

    /** @return array{total:int, completed:int, paper_total:int, evaluated:int} */
    public function overall(array $summary): array
    {
        $levels = collect($summary)->flatten(1);

        return [
            'total' => (int) $levels->sum('total'),
            'completed' => (int) $levels->sum('completed'),
            'paper_total' => (int) $levels->sum('paper_total'),
            'evaluated' => (int) $levels->sum('evaluated'),
        ];
    }
}
