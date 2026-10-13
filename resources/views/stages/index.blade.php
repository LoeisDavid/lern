@extends('layouts.app')

@section('title', 'Tahap Belajar')

@section('content')
<h1>Tahap Belajar</h1>
<p class="lead">Kerjakan berurutan dari Tahap 1 sampai Tahap 3, atau langsung ke tahap yang ingin kamu latih.</p>

<div class="grid grid-3">
    @forelse ($stages as $stage)
        @include('partials.stage-card')
    @empty
        <p class="notice">Data tahap belum tersedia. Jalankan <code>php artisan db:seed</code>.</p>
    @endforelse
</div>
@endsection