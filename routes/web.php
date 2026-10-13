<?php

use App\Http\Controllers\ExerciseController;
use App\Http\Controllers\ExerciseEvaluationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LearningStageController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/progres', [ExerciseEvaluationController::class, 'progress'])->name('progress.index');

Route::get('/tahap', [LearningStageController::class, 'index'])->name('stages.index');
Route::get('/tahap/{stage}', [LearningStageController::class, 'show'])->name('stages.show');

Route::prefix('/tahap/{stage}/{level}')->group(function () {
    Route::get('/', [ExerciseController::class, 'index'])->name('exercises.index');

    Route::get('/soal/{position}', [ExerciseController::class, 'show'])
        ->whereNumber('position')->name('exercises.show');
    Route::post('/soal/{position}/periksa', [ExerciseController::class, 'check'])
        ->whereNumber('position')->name('exercises.check');
    Route::post('/soal/{position}/selesai', [ExerciseController::class, 'complete'])
        ->whereNumber('position')->name('exercises.complete');

    Route::get('/evaluasi', [ExerciseEvaluationController::class, 'show'])->name('evaluations.show');
    Route::post('/evaluasi/{position}/checklist', [ExerciseEvaluationController::class, 'saveChecklist'])
        ->whereNumber('position')->name('evaluations.checklist');
});
