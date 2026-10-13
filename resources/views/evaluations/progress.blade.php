@extends('layouts.app')

@section('title', 'Ringkasan Progres')

@section('content')
<h1>Ringkasan Progres</h1>

<section class="card">
    @include('partials.progress-bar', ['done' => $overall['completed'], 'total' => $overall['total']])
    @if ($overall['paper_total'] > 0)
        <p>Evaluasi mandiri: {{ $overall['evaluated'] }} dari {{ $overall['paper_total'] }} soal kertas.</p>
    @endif
    <p class="muted">Progres tersimpan pada sesi browser ini dan menunjukkan soal yang sudah dikerjakan, bukan penguasaan materi.</p>
</section>

@foreach ($stages as $stage)
    <section class="card">
        <h2>Tahap {{ $stage->number }}: {{ $stage->name }}</h2>
        <div class="table-wrap">
            <table class="table">
                <thead>
                <tr><th>Level</th><th>Dikerjakan</th><th>Evaluasi mandiri</th><th></th></tr>
                </thead>
                <tbody>
                @foreach ($levels as $level)
                    @php $row = $summary[$stage->id][$level->value]; @endphp
                    <tr>
                        <td>{{ $level->label() }}</td>
                        <td>{{ $row['completed'] }} dari {{ $row['total'] }} soal</td>
                        <td>{{ $row['paper_total'] > 0 ? $row['evaluated'].' dari '.$row['paper_total'].' soal kertas' : 'Tidak ada soal kertas' }}</td>
                        <td>
                            @if ($row['total'] > 0)
                                <a href="{{ route('exercises.index', [$stage, $level->value]) }}">Buka</a> ·
                                <a href="{{ route('evaluations.show', [$stage, $level->value]) }}">Evaluasi</a>
                            @else
                                <span class="muted">Belum tersedia</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </section>
@endforeach
@endsection