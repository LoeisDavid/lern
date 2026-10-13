<?php

namespace App\Http\Requests;

use App\Enums\ExerciseType;
use App\Models\Exercise;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CheckAnswerRequest extends FormRequest
{
    private ?Exercise $resolved = null;

    /** Soal dicari lewat tahap + level + nomor dari URL, bukan ID dari browser. */
    public function exercise(): Exercise
    {
        return $this->resolved ??= $this->route('stage')
            ->activeExercises($this->route('level'))
            ->where('position', (int) $this->route('position'))
            ->firstOrFail();
    }

    public function authorize(): bool
    {
        return $this->exercise()->isAutoGraded();
    }

    public function rules(): array
    {
        $exercise = $this->exercise();
        $ids = collect($exercise->options ?? [])->pluck('id')->map(fn ($id) => (string) $id)->all();

        return match ($exercise->type) {
            ExerciseType::DragOrder => [
                'answer' => ['required', 'array', 'size:'.count($ids)],
                'answer.*' => ['required', 'string', 'distinct', Rule::in($ids)],
            ],
            ExerciseType::MultipleChoice => [
                'answer' => ['required', 'string', Rule::in($ids)],
            ],
            ExerciseType::MultiSelect => [
                'answer' => ['required', 'array', 'min:1'],
                'answer.*' => ['string', 'distinct', Rule::in($ids)],
            ],
            default => [],
        };
    }

    public function messages(): array
    {
        return [
            'answer.required' => 'Susun atau pilih jawabanmu terlebih dahulu.',
            'answer.size' => 'Gunakan semua blok instruksi sebelum memeriksa jawaban.',
            'answer.min' => 'Pilih minimal satu jawaban.',
            'answer.*.in' => 'Pilihan jawaban tidak valid.',
            'answer.*.distinct' => 'Pilihan jawaban tidak boleh duplikat.',
        ];
    }
}
