<?php

namespace Tests\Feature;

use App\Enums\ExerciseLevel;
use App\Enums\ExerciseType;
use App\Models\Exercise;
use App\Models\LearningStage;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExerciseFlowTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_database_has_3_stages_and_45_seeded_exercises(): void
    {
        $this->assertDatabaseCount('learning_stages', 3);
        $this->assertDatabaseCount('exercises', 45);

        foreach (LearningStage::all() as $stage) {
            foreach (ExerciseLevel::cases() as $level) {
                $count = Exercise::where('learning_stage_id', $stage->id)
                    ->where('level', $level->value)
                    ->count();

                $this->assertSame(5, $count, "Stage {$stage->number} level {$level->value} harus memiliki 5 soal.");
            }
        }
    }

    public function test_home_page_loads_successfully_with_stages_and_hero(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('LOGIKA');
        $response->assertSee('Menyusun Alur Berpikir');
        $response->assertSee('Menganalisis Masalah');
        $response->assertSee('Menguji dan Memperbaiki Solusi');
        $response->assertSee('Petunjuk pengerjaan');
    }

    public function test_stage_index_and_detail_pages_load(): void
    {
        $stage1 = LearningStage::where('number', 1)->firstOrFail();

        $responseIndex = $this->get(route('stages.index'));
        $responseIndex->assertStatus(200);
        $responseIndex->assertSee('Tahap Belajar');

        $responseShow = $this->get(route('stages.show', $stage1));
        $responseShow->assertStatus(200);
        $responseShow->assertSee('Tahap 1: Menyusun Alur Berpikir');
        $responseShow->assertSee('Easy');
        $responseShow->assertSee('Medium');
        $responseShow->assertSee('Hard');
    }

    public function test_stage_1_easy_drag_and_drop_check_answer_and_retry(): void
    {
        $stage1 = LearningStage::where('number', 1)->firstOrFail();
        $exercise = Exercise::where('learning_stage_id', $stage1->id)
            ->where('level', ExerciseLevel::Easy->value)
            ->where('position', 1)
            ->firstOrFail();

        $this->assertSame(ExerciseType::DragOrder, $exercise->type);

        // Buka halaman soal
        $responseShow = $this->get(route('exercises.show', [$stage1, 'easy', 1]));
        $responseShow->assertStatus(200);
        $responseShow->assertSee($exercise->title);

        // Kirim jawaban benar
        $correctAnswer = $exercise->answer_key;
        $responseCorrect = $this->post(route('exercises.check', [$stage1, 'easy', 1]), [
            'answer' => $correctAnswer,
        ]);
        $responseCorrect->assertRedirect(route('exercises.show', [$stage1, 'easy', 1]));

        $this->assertDatabaseHas('exercise_attempts', [
            'exercise_id' => $exercise->id,
            'is_correct' => true,
        ]);
        $this->assertDatabaseHas('exercise_progress', [
            'exercise_id' => $exercise->id,
            'is_completed' => true,
        ]);

        // Kirim jawaban salah
        $reversed = array_reverse($correctAnswer);
        $responseWrong = $this->post(route('exercises.check', [$stage1, 'easy', 1]), [
            'answer' => $reversed,
        ]);
        $responseWrong->assertRedirect(route('exercises.show', [$stage1, 'easy', 1]));

        $this->assertDatabaseHas('exercise_attempts', [
            'exercise_id' => $exercise->id,
            'is_correct' => false,
        ]);
    }

    public function test_stage_2_easy_multiple_choice_and_multi_select(): void
    {
        $stage2 = LearningStage::where('number', 2)->firstOrFail();
        $ex1 = Exercise::where('learning_stage_id', $stage2->id)
            ->where('level', 'easy')
            ->where('position', 1)
            ->firstOrFail();

        $this->assertSame(ExerciseType::MultipleChoice, $ex1->type);

        // Jawaban benar multiple choice
        $correctKey = $ex1->answer_key['correct'];
        $resMc = $this->post(route('exercises.check', [$stage2, 'easy', 1]), [
            'answer' => $correctKey,
        ]);
        $resMc->assertRedirect(route('exercises.show', [$stage2, 'easy', 1]));

        $this->assertDatabaseHas('exercise_attempts', [
            'exercise_id' => $ex1->id,
            'is_correct' => true,
        ]);

        // Soal 2 multi_select
        $ex2 = Exercise::where('learning_stage_id', $stage2->id)
            ->where('level', 'easy')
            ->where('position', 2)
            ->firstOrFail();

        $this->assertSame(ExerciseType::MultiSelect, $ex2->type);
        $correctMulti = $ex2->answer_key['correct'];

        $resMulti = $this->post(route('exercises.check', [$stage2, 'easy', 2]), [
            'answer' => $correctMulti,
        ]);
        $resMulti->assertRedirect(route('exercises.show', [$stage2, 'easy', 2]));

        $this->assertDatabaseHas('exercise_attempts', [
            'exercise_id' => $ex2->id,
            'is_correct' => true,
        ]);
    }

    public function test_stage_3_easy_multiple_choice(): void
    {
        $stage3 = LearningStage::where('number', 3)->firstOrFail();
        $ex1 = Exercise::where('learning_stage_id', $stage3->id)
            ->where('level', 'easy')
            ->where('position', 1)
            ->firstOrFail();

        $this->assertSame(ExerciseType::MultipleChoice, $ex1->type);

        $res = $this->post(route('exercises.check', [$stage3, 'easy', 1]), [
            'answer' => $ex1->answer_key['correct'],
        ]);
        $res->assertRedirect(route('exercises.show', [$stage3, 'easy', 1]));

        $this->assertDatabaseHas('exercise_attempts', [
            'exercise_id' => $ex1->id,
            'is_correct' => true,
        ]);
    }

    public function test_paper_exercise_completion_and_self_evaluation(): void
    {
        $stage1 = LearningStage::where('number', 1)->firstOrFail();
        $exercise = Exercise::where('learning_stage_id', $stage1->id)
            ->where('level', 'medium')
            ->where('position', 1)
            ->firstOrFail();

        $this->assertSame(ExerciseType::Paper, $exercise->type);

        // Menandai selesai pengerjaan di kertas
        $resComplete = $this->post(route('exercises.complete', [$stage1, 'medium', 1]));
        $resComplete->assertRedirect(route('exercises.show', [$stage1, 'medium', 2]));

        $this->assertDatabaseHas('exercise_progress', [
            'exercise_id' => $exercise->id,
            'is_completed' => true,
        ]);

        // Soal kertas tidak memiliki rekaman attempt nilai otomatis
        $this->assertDatabaseMissing('exercise_attempts', [
            'exercise_id' => $exercise->id,
        ]);

        // Simpan checklist evaluasi mandiri
        $resChecklist = $this->post(route('evaluations.checklist', [$stage1, 'medium', 1]), [
            'checks' => ['understood', 'logical', 'constraints', 'compared'],
        ]);
        $resChecklist->assertRedirect(route('evaluations.show', [$stage1, 'medium']).'#soal-1');

        $this->assertDatabaseHas('exercise_progress', [
            'exercise_id' => $exercise->id,
            'self_evaluated' => true,
        ]);
    }

    public function test_progress_page_renders_with_overall_summary(): void
    {
        $response = $this->get(route('progress.index'));

        $response->assertStatus(200);
        $response->assertSee('Ringkasan Progres');
        $response->assertSee('Tahap 1');
        $response->assertSee('Tahap 2');
        $response->assertSee('Tahap 3');
    }
}
