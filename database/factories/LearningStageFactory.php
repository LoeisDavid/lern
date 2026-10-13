<?php

namespace Database\Factories;

use App\Models\LearningStage;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<LearningStage>
 */
class LearningStageFactory extends Factory
{
    protected $model = LearningStage::class;

    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'number' => fake()->unique()->numberBetween(1, 100),
            'slug' => fake()->unique()->slug(),
            'name' => fake()->words(3, true),
            'goal' => fake()->sentence(),
            'summary' => fake()->sentence(),
            'skills' => [
                'Mengurutkan langkah secara logis',
                'Menganalisis masalah dan batasan',
                'Menguji dan mengevaluasi solusi',
            ],
            'level_methods' => [
                'easy' => 'Metode latihan level Easy',
                'medium' => 'Metode latihan level Medium',
                'hard' => 'Metode latihan level Hard',
            ],
        ];
    }
}
