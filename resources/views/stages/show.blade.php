@extends('layouts.app')

@section('title', 'Tahap '.$stage->number.': '.$stage->name)

@section('content')
<nav class="breadcrumb" aria-label="Jejak halaman">
    <a href="{{ route('stages.index') }}">Tahap Belajar</a> › Tahap {{ $stage->number }}
</nav>

<h1>Tahap {{ $stage->number }}: {{ $stage->name }}</h1>
<p class="lead">{{ $stage->goal }}</p>

<section class="card">
    <h2>Kemampuan yang dilatih</h2>
    <ul>
        @foreach ($stage->skills as $skill)
            <li>{{ $skill }}</li>
        @endforeach
    </ul>
</section>

<h2>Pilih level</h2>
<div class="grid grid-3">
    @foreach ($levels as $level)
        @include('partials.level-card', ['data' => $levelData[$level->value]])
    @endforeach
</div>
@endsection