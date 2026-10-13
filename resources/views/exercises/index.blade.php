@extends('layouts.app')

@section('title', 'Level '.$level->label().' · '.$stage->name)

@section('content')
<nav class="breadcrumb" aria-label="Jejak halaman">
    <a href="{{ route('stages.index') }}">Tahap Belajar</a> ›
    <a href="{{ route('stages.show', $stage) }}">{{ $stage->name }}</a> › {{ $level->label() }}
</nav>

<h1>Tahap {{ $stage->number }} · Level {{ $level->label() }}</h1>
<p class="lead">{{ $stage->methodFor($level) }}</p>

@if ($isPaper)
    <section class="notice">
        <h2>Persiapan</h2>
        <p>Siapkan kertas dan alat tulis sebelum memulai. Setiap soal memiliki nomor. Tuliskan nomor soal pada setiap jawaban agar kamu dapat mencocokkannya saat evaluasi di akhir latihan. Website tidak mengumpulkan atau mengoreksi jawaban yang kamu tulis.</p>
    </section>
@endif

<section class="card">
    <h2>{{ $exercises->count() }} soal</h2>
    @include('partials.progress-bar', ['done' => $doneCount, 'total' => $exercises->count()])
    @include('partials.question-nav', ['current' => null])

    <div class="actions">
        <a class="btn btn-primary btn-lg" href="{{ route('exercises.show', [$stage, $level->value, $next->position]) }}">
            {{ $doneCount > 0 ? 'Lanjutkan latihan' : 'Mulai latihan' }}
        </a>
        <a class="btn" href="{{ route('evaluations.show', [$stage, $level->value]) }}">Lihat evaluasi</a>
    </div>
</section>
@endsection