@php $d = $attempt->result_detail; @endphp
<section class="result {{ $attempt->is_correct ? 'result-ok' : 'result-bad' }}" aria-live="polite">
    <h2>{{ $attempt->is_correct ? 'Jawaban benar' : 'Jawaban belum tepat' }}</h2>

    @if ($exercise->type === \App\Enums\ExerciseType::DragOrder)
        <table class="table">
            <thead><tr><th>Posisi</th><th>Jawabanmu</th><th>Seharusnya</th><th>Hasil</th></tr></thead>
            <tbody>
            @foreach ($d['rows'] as $row)
                <tr>
                    <td>{{ $row['position'] }}</td>
                    <td>{{ $row['submitted_label'] }}</td>
                    <td>{{ $row['expected_label'] }}</td>
                    <td>{{ $row['is_correct'] ? '✓ Tepat' : '✗ Keliru' }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        @unless ($attempt->is_correct)
            <h3>Urutan yang benar</h3>
            <ol>
                @foreach ($d['correct_order'] as $label)
                    <li>{{ $label }}</li>
                @endforeach
            </ol>
        @endunless
    @elseif ($exercise->type === \App\Enums\ExerciseType::MultipleChoice)
        <p>Jawabanmu: <strong>{{ $d['selected_label'] }}</strong></p>
        @unless ($attempt->is_correct)
            <p>Jawaban yang tepat: <strong>{{ $d['correct_label'] }}</strong></p>
            @if ($d['feedback'])<p>{{ $d['feedback'] }}</p>@endif
        @endunless
    @else
        <p>Pilihanmu: {{ implode('; ', $d['selected_labels']) }}</p>
        @unless ($attempt->is_correct)
            @if ($d['missed_labels'])
                <p>Informasi penting yang belum kamu pilih:</p>
                <ul>@foreach ($d['missed_labels'] as $label)<li>{{ $label }}</li>@endforeach</ul>
            @endif
            @if ($d['extra'])
                <p>Pilihan yang sebenarnya tidak tepat:</p>
                <ul>
                    @foreach ($d['extra'] as $extra)
                        <li>{{ $extra['label'] }}@if ($extra['feedback']): {{ $extra['feedback'] }}@endif</li>
                    @endforeach
                </ul>
            @endif
        @endunless
    @endif

    <h3>Penjelasan</h3>
    <p>{{ $exercise->explanation }}</p>

    <a class="btn" href="{{ route('exercises.show', ['stage' => $stage, 'level' => $level->value, 'position' => $exercise->position, 'ulang' => 1]) }}">Coba lagi</a>
</section>