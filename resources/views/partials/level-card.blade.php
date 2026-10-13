@php
    $statusLabel = [
        'kosong' => 'Soal belum tersedia',
        'belum' => 'Belum dimulai',
        'berjalan' => 'Sedang dikerjakan',
        'selesai' => 'Semua soal sudah dikerjakan',
    ][$data['status']];
@endphp
<article class="card level-card">
    <span class="badge badge-{{ $level->value }}">{{ $level->label() }}</span>
    <p>{{ $stage->methodFor($level) }}</p>
    @include('partials.progress-bar', ['done' => $data['completed'], 'total' => $data['total']])
    <p class="status">{{ $statusLabel }}</p>

    @if ($data['total'] > 0)
        <a class="btn btn-primary" href="{{ route('exercises.index', [$stage, $level->value]) }}">
            {{ match ($data['status']) {
                'belum' => 'Mulai latihan',
                'berjalan' => 'Lanjutkan latihan',
                default => 'Buka latihan',
            } }}
        </a>
    @else
        <span class="btn btn-disabled" aria-disabled="true">Belum tersedia</span>
    @endif
</article>