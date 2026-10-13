<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            LearningStageSeeder::class,
            Stage1ExerciseSeeder::class,
            Stage2ExerciseSeeder::class,
            Stage3ExerciseSeeder::class,
        ]);
    }
}
