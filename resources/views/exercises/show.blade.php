@extends('layouts.app')

@section('title', 'Soal '.$exercise->position.' · '.$stage->name.' · '.$level->label())

@section('content')
<nav class="breadcrumb" aria-label="Jejak halaman">
    <a href="{{ route('stages.show', $stage) }}">Tahap {{ $stage->number }}: {{ $stage->name }}</a> ›
    <a href="{{ route('exercises.index', [$stage, $level->value]) }}">Level {{ $level->label() }}</a>
</nav>

<header class="work-header">
    <h1>Soal {{ $exercise->position }} <small>dari {{ $exercises->count() }}</small></h1>
    <span class="badge badge-{{ $level->value }}">{{ $level->label() }}</span>
    <span class="badge">{{ $exercise->type->label() }}</span>
</header>

@include('partials.progress-bar', ['done' => $doneCount, 'total' => $exercises->count()])
@include('partials.question-nav', ['current' => $exercise->position])

<section class="card">
    <h2>{{ $exercise->title }}</h2>
    <p class="instruction"><strong>Instruksi:</strong> {{ $exercise->instruction }}</p>
    <div class="problem">{!! nl2br(e($exercise->description)) !!}</div>
</section>

<section class="card" aria-label="Area pengerjaan">
    @if ($attempt)
        @include('partials.attempt-result')
    @endif

    @switch($exercise->type->value)
        @case('dnd_order')
            @include('partials.dnd-board')
            @break
        @case('multiple_choice')
        @case('multi_select')
            @include('partials.choice-form')
            @break
        @default
            @include('partials.paper-panel')
    @endswitch
</section>

<div class="pager">
    @if ($prev)
        <a class="btn" href="{{ route('exercises.show', [$stage, $level->value, $prev->position]) }}">‹ Soal sebelumnya</a>
    @else
        <span></span>
    @endif

    <a class="btn btn-outline" href="{{ route('evaluations.show', [$stage, $level->value]) }}">Selesai latihan</a>

    @if ($next)
        <a class="btn" href="{{ route('exercises.show', [$stage, $level->value, $next->position]) }}">Soal berikutnya ›</a>
    @else
        <span></span>
    @endif
</div>
@endsection