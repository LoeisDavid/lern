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
            'number' => $this->faker->unique()->numberBetween(1, 100),
            'slug' => $this->faker->unique()->slug(),
            'name' => $this->faker->words(3, true),
            'goal' => $this->faker->sentence(),
            'summary' => $this->faker->sentence(),
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
