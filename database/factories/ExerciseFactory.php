<?php

namespace Database\Factories;

use App\Enums\ExerciseLevel;
use App\Enums\ExerciseType;
use App\Models\Exercise;
use App\Models\LearningStage;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Exercise>
 */
class ExerciseFactory extends Factory
{
    protected $model = Exercise::class;

    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'learning_stage_id' => LearningStage::factory(),
            'level' => fake()->randomElement(ExerciseLevel::cases()),
            'type' => ExerciseType::DragOrder,
            'position' => fake()->numberBetween(1, 5),
            'title' => fake()->sentence(3),
            'description' => fake()->paragraph(),
            'instruction' => 'Susun langkah-langkah berikut ke dalam urutan yang tepat.',
            'objective' => fake()->sentence(),
            'answer_guide' => fake()->paragraph(),
            'key_points' => [
                'Langkah awal jelas',
                'Ketergantungan logis terpenuhi',
                'Keluaran akhir tercapai',
            ],
            'rubric' => [
                'Kriteria pemahaman masalah',
                'Kriteria logika alur',
                'Kriteria batasan solusi',
            ],
            'options' => [
                ['id' => 'b1', 'label' => 'Langkah pertama'],
                ['id' => 'b2', 'label' => 'Langkah kedua'],
                ['id' => 'b3', 'label' => 'Langkah ketiga'],
            ],
            'answer_key' => ['b1', 'b2', 'b3'],
            'explanation' => fake()->paragraph(),
            'is_active' => true,
        ];
    }

    public function easy(): static
    {
        return $this->state(fn () => [
            'level' => ExerciseLevel::Easy,
        ]);
    }

    public function medium(): static
    {
        return $this->state(fn () => [
            'level' => ExerciseLevel::Medium,
            'type' => ExerciseType::Paper,
            'options' => null,
            'answer_key' => null,
        ]);
    }

    public function hard(): static
    {
        return $this->state(fn () => [
            'level' => ExerciseLevel::Hard,
            'type' => ExerciseType::Paper,
            'options' => null,
            'answer_key' => null,
        ]);
    }

    public function choice(): static
    {
        return $this->state(fn () => [
            'type' => ExerciseType::MultipleChoice,
            'options' => [
                ['id' => 'a', 'label' => 'Opsi A'],
                ['id' => 'b', 'label' => 'Opsi B'],
            ],
            'answer_key' => [
                'correct' => 'a',
                'feedback' => ['b' => 'Opsi B salah'],
            ],
        ]);
    }
}
