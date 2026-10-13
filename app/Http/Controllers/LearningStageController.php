<?php

namespace App\Http\Controllers;

use App\Enums\ExerciseLevel;
use App\Models\LearningStage;
use App\Services\ProgressService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LearningStageController extends Controller
{
    public function index(Request $request, ProgressService $progress): View
    {
        return view('stages.index', [
            'stages' => LearningStage::orderBy('number')->get(),
            'summary' => $progress->summary($request->attributes->get('visitor_token')),
        ]);
    }

    public function show(Request $request, LearningStage $stage, ProgressService $progress): View
    {
        $summary = $progress->summary($request->attributes->get('visitor_token'));

        return view('stages.show', [
            'stage' => $stage,
            'levels' => ExerciseLevel::cases(),
            'levelData' => $summary[$stage->id],
        ]);
    }
}
