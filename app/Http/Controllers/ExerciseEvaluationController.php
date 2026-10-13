<?php

namespace App\Http\Controllers;

use App\Enums\ExerciseLevel;
use App\Http\Requests\SaveChecklistRequest;
use App\Models\ExerciseAttempt;
use App\Models\ExerciseProgress;
use App\Models\LearningStage;
use App\Services\ProgressService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class ExerciseEvaluationController extends Controller
{
    public function show(Request $request, LearningStage $stage, ExerciseLevel $level): View
    {
        $token = $request->attributes->get('visitor_token');

        $exercises = $stage->activeExercises($level)->get();
        abort_if($exercises->isEmpty(), 404);
        $ids = $exercises->pluck('id');

        $progressMap = ExerciseProgress::forVisitor($token)->whereIn('exercise_id', $ids)->get()->keyBy('exercise_id');

        $attemptsByExercise = ExerciseAttempt::forVisitor($token)
            ->whereIn('exercise_id', $ids)
            ->orderBy('id')
            ->get()
            ->groupBy('exercise_id');

        $auto = $exercises->filter(fn ($e) => $e->isAutoGraded());
        $paper = $exercises->reject(fn ($e) => $e->isAutoGraded());

        return view('evaluations.show', [
            'stage' => $stage,
            'level' => $level,
            'exercises' => $exercises,
            'progressMap' => $progressMap,
            'attemptsByExercise' => $attemptsByExercise,
            'stats' => [
                'total' => $exercises->count(),
                'completed' => $progressMap->where('is_completed', true)->count(),
                'auto_total' => $auto->count(),
                'auto_correct' => $auto->filter(
                    fn ($e) => $attemptsByExercise->get($e->id)?->last()?->is_correct
                )->count(),
                'paper_total' => $paper->count(),
                'paper_evaluated' => $paper->filter(
                    fn ($e) => $progressMap->get($e->id)?->self_evaluated
                )->count(),
            ],
        ]);
    }

    /** Menyimpan checklist evaluasi mandiri. Hanya catatan pengguna, bukan nilai. */
    public function saveChecklist(
        SaveChecklistRequest $request,
        LearningStage $stage,
        ExerciseLevel $level,
        int $position
    ): RedirectResponse {
        $exercise = $request->exercise();
        $token = $request->attributes->get('visitor_token');
        $checks = array_values(array_unique($request->validated('checks') ?? []));

        DB::transaction(function () use ($exercise, $token, $checks) {
            $progress = ExerciseProgress::firstOrCreate([
                'visitor_token' => $token,
                'exercise_id' => $exercise->id,
            ]);

            $progress->update([
                'checklist' => $checks,
                'self_evaluated' => true,
                'self_evaluated_at' => now(),
            ]);
        });

        return redirect()
            ->to(route('evaluations.show', [$stage, $level->value]).'#soal-'.$position)
            ->with('status', "Evaluasi mandiri soal {$position} tersimpan.");
    }

    public function progress(Request $request, ProgressService $progress): View
    {
        $summary = $progress->summary($request->attributes->get('visitor_token'));

        return view('evaluations.progress', [
            'stages' => LearningStage::orderBy('number')->get(),
            'levels' => ExerciseLevel::cases(),
            'summary' => $summary,
            'overall' => $progress->overall($summary),
        ]);
    }
}
