@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
<section class="hero">
    <h1>Latih cara berpikirmu, langkah demi langkah.</h1>
    <p class="lead">LOGIKA adalah platform latihan untuk membangun kemampuan berpikir terstruktur, analitis, dan kritis melalui tiga tahap pembelajaran dengan level Easy, Medium, dan Hard.</p>
    <a class="btn btn-primary btn-lg" href="{{ route('stages.index') }}">Mulai berlatih</a>
</section>

<section aria-labelledby="judul-tahap">
    <h2 id="judul-tahap">Tiga tahap pembelajaran</h2>
    <div class="grid grid-3">
        @forelse ($stages as $stage)
            @include('partials.stage-card')
        @empty
            <p class="notice">Data tahap belum tersedia. Jalankan <code>php artisan db:seed</code>.</p>
        @endforelse
    </div>
</section>

<section class="card" aria-labelledby="judul-progres">
    <h2 id="judul-progres">Progresmu</h2>
    @include('partials.progress-bar', ['done' => $overall['completed'], 'total' => $overall['total']])
    @if ($overall['paper_total'] > 0)
        <p>Evaluasi mandiri: {{ $overall['evaluated'] }} dari {{ $overall['paper_total'] }} soal kertas sudah diperiksa sendiri.</p>
    @endif
    <p class="muted">Progres menunjukkan jumlah soal yang sudah dikerjakan di perangkat ini, bukan tingkat penguasaan materi.</p>
    <a href="{{ route('progress.index') }}">Lihat rincian progres</a>
</section>

<section class="card" aria-labelledby="judul-petunjuk">
    <h2 id="judul-petunjuk">Petunjuk pengerjaan</h2>
    <ol>
        <li>Pilih tahap, lalu pilih level Easy, Medium, atau Hard.</li>
        <li>Easy: soal diperiksa otomatis dan kamu mendapat penjelasan.</li>
        <li>Medium dan Hard: kerjakan di kertas. Website tidak mengumpulkan atau mengoreksi jawaban tertulismu.</li>
        <li>Setelah selesai, buka halaman evaluasi untuk membandingkan jawabanmu dengan panduan.</li>
        <li>Progresmu tersimpan pada sesi browser ini, jadi kamu bisa melanjutkan nanti.</li>
    </ol>
</section>
@endsection