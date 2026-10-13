<?php

namespace App\Http\Controllers;

use App\Enums\ExerciseLevel;
use App\Enums\ExerciseType;
use App\Http\Requests\CheckAnswerRequest;
use App\Models\ExerciseAttempt;
use App\Models\ExerciseProgress;
use App\Models\LearningStage;
use App\Services\ExerciseGrader;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class ExerciseController extends Controller
{
    public function __construct(private ExerciseGrader $grader) {}

    /** Halaman pembuka level: persiapan, nomor soal, tombol mulai/lanjutkan. */
    public function index(Request $request, LearningStage $stage, ExerciseLevel $level): View
    {
        $token = $request->attributes->get('visitor_token');
        $exercises = $stage->activeExercises($level)->get(['id', 'position', 'type']);
        abort_if($exercises->isEmpty(), 404);

        $progressMap = ExerciseProgress::forVisitor($token)
            ->whereIn('exercise_id', $exercises->pluck('id'))
            ->get()
            ->keyBy('exercise_id');

        $next = $exercises->first(fn ($e) => ! $progressMap->get($e->id)?->is_completed) ?? $exercises->first();

        return view('exercises.index', [
            'stage' => $stage,
            'level' => $level,
            'exercises' => $exercises,
            'progressMap' => $progressMap,
            'doneCount' => $progressMap->where('is_completed', true)->count(),
            'next' => $next,
            'isPaper' => $exercises->first()->type === ExerciseType::Paper,
        ]);
    }

    public function show(Request $request, LearningStage $stage, ExerciseLevel $level, int $position): View
    {
        $token = $request->attributes->get('visitor_token');

        $exercise = $stage->activeExercises($level)->where('position', $position)->firstOrFail();
        $exercises = $stage->activeExercises($level)->get(['id', 'position', 'type']);

        $progressMap = ExerciseProgress::forVisitor($token)
            ->whereIn('exercise_id', $exercises->pluck('id'))
            ->get()
            ->keyBy('exercise_id');

        $attempt = null;
        if ($exercise->isAutoGraded() && ! $request->boolean('ulang')) {
            $attempt = ExerciseAttempt::forVisitor($token)
                ->where('exercise_id', $exercise->id)
                ->latest('id')
                ->first();
        }

        return view('exercises.show', [
            'stage' => $stage,
            'level' => $level,
            'exercise' => $exercise,
            'exercises' => $exercises,
            'progressMap' => $progressMap,
            'doneCount' => $progressMap->where('is_completed', true)->count(),
            'progress' => $progressMap->get($exercise->id),
            'attempt' => $attempt,
            'options' => $exercise->publicOptions($token),
            'prev' => $exercises->where('position', '<', $position)->last(),
            'next' => $exercises->where('position', '>', $position)->first(),
        ]);
    }

    /** Pemeriksaan otomatis. Skor dihitung di backend, tidak dari JavaScript. */
    public function check(
        CheckAnswerRequest $request,
        LearningStage $stage,
        ExerciseLevel $level,
        int $position
    ): RedirectResponse {
        $exercise = $request->exercise();
        $token = $request->attributes->get('visitor_token');
        $answer = $request->validated('answer');

        $result = $this->grader->grade($exercise, $answer);

        DB::transaction(function () use ($exercise, $token, $answer, $result) {
            ExerciseAttempt::create([
                'visitor_token' => $token,
                'exercise_id' => $exercise->id,
                'submitted_answer' => is_array($answer) ? $answer : [$answer],
                'is_correct' => $result['is_correct'],
                'result_detail' => $result['detail'],
            ]);

            // "Dikerjakan" berarti sudah mengirim jawaban, terlepas dari benar atau salah.
            $progress = ExerciseProgress::firstOrCreate([
                'visitor_token' => $token,
                'exercise_id' => $exercise->id,
            ]);

            if (! $progress->is_completed) {
                $progress->update(['is_completed' => true, 'completed_at' => now()]);
            }
        });

        return redirect()->route('exercises.show', [
            'stage' => $stage,
            'level' => $level->value,
            'position' => $position,
        ]);
    }

    /** Menandai soal kertas sudah dikerjakan. Tidak ada jawaban atau skor yang disimpan. */
    public function complete(
        Request $request,
        LearningStage $stage,
        ExerciseLevel $level,
        int $position
    ): RedirectResponse {
        $token = $request->attributes->get('visitor_token');
        $exercise = $stage->activeExercises($level)->where('position', $position)->firstOrFail();
        abort_if($exercise->isAutoGraded(), 404);

        $progress = ExerciseProgress::firstOrCreate([
            'visitor_token' => $token,
            'exercise_id' => $exercise->id,
        ]);

        if (! $progress->is_completed) {
            $progress->update(['is_completed' => true, 'completed_at' => now()]);
        }

        $next = $stage->activeExercises($level)->where('position', '>', $position)->first();

        if ($next) {
            return redirect()
                ->route('exercises.show', [$stage, $level->value, $next->position])
                ->with('status', "Soal {$position} ditandai sudah dikerjakan.");
        }

        return redirect()
            ->route('evaluations.show', [$stage, $level->value])
            ->with('status', 'Semua soal sudah dikerjakan. Saatnya evaluasi mandiri.');
    }
}
