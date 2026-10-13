<?php

namespace App\Services;

use App\Enums\ExerciseType;
use App\Models\Exercise;
use InvalidArgumentException;

class ExerciseGrader
{
    /**
     * Penilaian selalu terjadi di backend memakai kunci jawaban dari database.
     *
     * @return array{is_correct: bool, detail: array<string, mixed>}
     */
    public function grade(Exercise $exercise, mixed $answer): array
    {
        return match ($exercise->type) {
            ExerciseType::DragOrder => $this->gradeOrder($exercise, array_map('strval', (array) $answer)),
            ExerciseType::MultipleChoice => $this->gradeChoice($exercise, (string) $answer),
            ExerciseType::MultiSelect => $this->gradeMulti($exercise, array_map('strval', (array) $answer)),
            ExerciseType::Paper => throw new InvalidArgumentException('Soal kertas tidak dinilai otomatis.'),
        };
    }

    private function labels(Exercise $exercise): array
    {
        return collect($exercise->options ?? [])->pluck('label', 'id')->all();
    }

    private function gradeOrder(Exercise $exercise, array $submitted): array
    {
        $expected = array_map('strval', array_values($exercise->answer_key ?? []));
        $submitted = array_values($submitted);
        $labels = $this->labels($exercise);

        $rows = [];
        foreach ($expected as $index => $expectedId) {
            $givenId = $submitted[$index] ?? null;
            $rows[] = [
                'position' => $index + 1,
                'submitted_label' => $labels[$givenId] ?? '-',
                'expected_label' => $labels[$expectedId] ?? '-',
                'is_correct' => $givenId === $expectedId,
            ];
        }

        return [
            'is_correct' => $submitted === $expected,
            'detail' => [
                'rows' => $rows,
                'correct_order' => array_map(fn ($id) => $labels[$id] ?? $id, $expected),
            ],
        ];
    }

    private function gradeChoice(Exercise $exercise, string $selected): array
    {
        $key = $exercise->answer_key ?? [];
        $correct = (string) ($key['correct'] ?? '');
        $labels = $this->labels($exercise);
        $isCorrect = $selected === $correct;

        return [
            'is_correct' => $isCorrect,
            'detail' => [
                'selected_label' => $labels[$selected] ?? '-',
                'correct_label' => $labels[$correct] ?? '-',
                'feedback' => $isCorrect ? null : ($key['feedback'][$selected] ?? null),
            ],
        ];
    }

    private function gradeMulti(Exercise $exercise, array $selected): array
    {
        $key = $exercise->answer_key ?? [];
        $correct = array_map('strval', $key['correct'] ?? []);
        $labels = $this->labels($exercise);

        $missed = array_values(array_diff($correct, $selected));
        $extra = array_values(array_diff($selected, $correct));

        return [
            'is_correct' => $missed === [] && $extra === [],
            'detail' => [
                'selected_labels' => array_map(fn ($id) => $labels[$id] ?? $id, $selected),
                'correct_labels' => array_map(fn ($id) => $labels[$id] ?? $id, $correct),
                'missed_labels' => array_map(fn ($id) => $labels[$id] ?? $id, $missed),
                'extra' => array_map(fn ($id) => [
                    'label' => $labels[$id] ?? $id,
                    'feedback' => $key['feedback'][$id] ?? null,
                ], $extra),
            ],
        ];
    }
}
