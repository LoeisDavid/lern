<?php

namespace App\Http\Controllers;

use App\Models\LearningStage;
use App\Services\ProgressService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(Request $request, ProgressService $progress): View
    {
        $summary = $progress->summary($request->attributes->get('visitor_token'));

        return view('home', [
            'stages' => LearningStage::orderBy('number')->get(),
            'summary' => $summary,
            'overall' => $progress->overall($summary),
        ]);
    }
}
