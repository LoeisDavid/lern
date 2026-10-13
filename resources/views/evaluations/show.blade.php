@extends('layouts.app')

@section('title', 'Evaluasi · '.$stage->name.' · '.$level->label())

@section('content')
<nav class="breadcrumb" aria-label="Jejak halaman">
    <a href="{{ route('stages.show', $stage) }}">Tahap {{ $stage->number }}: {{ $stage->name }}</a> ›
    <a href="{{ route('exercises.index', [$stage, $level->value]) }}">Level {{ $level->label() }}</a> › Evaluasi
</nav>

<h1>Evaluasi: Tahap {{ $stage->number }} · {{ $level->label() }}</h1>

<section class="card">
    <h2>Ringkasan latihan</h2>
    <ul class="stats">
        <li><strong>{{ $stats['completed'] }} dari {{ $stats['total'] }}</strong> soal telah dikerjakan</li>
        @if ($stats['auto_total'] > 0)
            <li><strong>{{ $stats['auto_correct'] }} dari {{ $stats['auto_total'] }}</strong> soal dijawab benar pada percobaan terakhir (penilaian otomatis)</li>
        @endif
        @if ($stats['paper_total'] > 0)
            <li><strong>{{ $stats['paper_evaluated'] }} dari {{ $stats['paper_total'] }}</strong> soal kertas sudah kamu periksa sendiri (evaluasi mandiri)</li>
        @endif
    </ul>
    @if ($stats['completed'] < $stats['total'])
        <p class="muted">Beberapa soal belum dikerjakan. Kamu tetap bisa membaca panduan, tetapi sebaiknya kerjakan dulu agar evaluasi lebih bermakna.</p>
    @endif
    <p class="muted">Angka di atas menunjukkan aktivitas dan penilaian dirimu, bukan nilai penguasaan materi.</p>
</section>

@foreach ($exercises as $exercise)
    @php
        $prog = $progressMap->get($exercise->id);
        $attempts = $attemptsByExercise->get($exercise->id);
        $last = $attempts?->last();
    @endphp
    <article class="card" id="soal-{{ $exercise->position }}">
        <header class="work-header">
            <h2>Soal {{ $exercise->position }}: {{ $exercise->title }}</h2>
            <span class="badge">{{ $prog?->is_completed ? 'Sudah dikerjakan' : 'Belum dikerjakan' }}</span>
        </header>

        <h3>Deskripsi soal</h3>
        <div class="problem">{!! nl2br(e($exercise->description)) !!}</div>

        <h3>Tujuan latihan</h3>
        <p>{{ $exercise->objective }}</p>

        <h3>{{ $exercise->isAutoGraded() ? 'Penjelasan jawaban' : 'Panduan jawaban / contoh solusi' }}</h3>
        <div class="problem">{!! nl2br(e($exercise->isAutoGraded() ? $exercise->explanation : $exercise->answer_guide)) !!}</div>

        <h3>Poin penting yang seharusnya ada</h3>
        <ul>@foreach ($exercise->key_points as $point)<li>{{ $point }}</li>@endforeach</ul>

        <h3>Kriteria evaluasi</h3>
        <ul>@foreach ($exercise->rubric as $criterion)<li>{{ $criterion }}</li>@endforeach</ul>

        @if ($exercise->isAutoGraded())
            <div class="status-box">
                <h3>Hasil penilaian otomatis</h3>
                @if ($last)
                    <p>Percobaan terakhir: <strong>{{ $last->is_correct ? 'benar' : 'belum tepat' }}</strong> ({{ $attempts->count() }} percobaan).</p>
                @else
                    <p>Soal ini belum dikerjakan.</p>
                @endif
                <a class="btn" href="{{ route('exercises.show', ['stage' => $stage, 'level' => $level->value, 'position' => $exercise->position, 'ulang' => 1]) }}">
                    {{ $last ? 'Coba lagi' : 'Kerjakan soal' }}
                </a>
            </div>
        @else
            <form method="POST" action="{{ route('evaluations.checklist', [$stage, $level->value, $exercise->position]) }}" class="status-box">
                @csrf
                <h3>Checklist evaluasi mandiri</h3>
                @php $checked = $prog?->checklist ?? []; @endphp
                @foreach (config('logika.checklist') as $key => $label)
                    <label class="check">
                        <input type="checkbox" name="checks[]" value="{{ $key }}" @checked(in_array($key, $checked, true))>
                        <span>{{ $label }}</span>
                    </label>
                @endforeach
                <p class="status">Status evaluasi: <strong>{{ $prog?->self_evaluated ? 'Sudah diperiksa sendiri' : 'Belum diperiksa' }}</strong></p>
                <button type="submit" class="btn btn-primary">Simpan evaluasi mandiri</button>
            </form>
        @endif
    </article>
@endforeach

<div class="pager">
    <a class="btn" href="{{ route('exercises.index', [$stage, $level->value]) }}">‹ Kembali ke level</a>
    <a class="btn" href="{{ route('stages.show', $stage) }}">Kembali ke tahap</a>
</div>
@endsection