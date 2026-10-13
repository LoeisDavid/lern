<?php

namespace App\Http\Requests;

use App\Models\Exercise;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SaveChecklistRequest extends FormRequest
{
    private ?Exercise $resolved = null;

    public function exercise(): Exercise
    {
        return $this->resolved ??= $this->route('stage')
            ->activeExercises($this->route('level'))
            ->where('position', (int) $this->route('position'))
            ->firstOrFail();
    }

    /** Checklist hanya untuk soal kertas. */
    public function authorize(): bool
    {
        return ! $this->exercise()->isAutoGraded();
    }

    public function rules(): array
    {
        return [
            'checks' => ['nullable', 'array'],
            'checks.*' => ['string', Rule::in(array_keys(config('logika.checklist')))],
        ];
    }

    public function messages(): array
    {
        return [
            'checks.*.in' => 'Item checklist tidak valid.',
        ];
    }
}
