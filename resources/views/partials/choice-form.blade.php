@php $multi = $exercise->type === \App\Enums\ExerciseType::MultiSelect; @endphp
<form method="POST" action="{{ route('exercises.check', [$stage, $level->value, $exercise->position]) }}">
    @csrf
    <fieldset class="choices">
        <legend>{{ $multi ? 'Pilih semua jawaban yang sesuai:' : 'Pilih satu jawaban:' }}</legend>
        @foreach ($options as $option)
            <label class="choice">
                <input type="{{ $multi ? 'checkbox' : 'radio' }}"
                       name="{{ $multi ? 'answer[]' : 'answer' }}"
                       value="{{ $option['id'] }}"
                       @if ($multi && is_array(old('answer')) && in_array($option['id'], old('answer'), true)) checked @endif
                       @if (! $multi && old('answer') === $option['id']) checked @endif>
                <span>{{ $option['label'] }}</span>
            </label>
        @endforeach
    </fieldset>
    <button type="submit" class="btn btn-primary">Periksa jawaban</button>
</form>