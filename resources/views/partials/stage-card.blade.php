@php
    $levelRows = collect($summary[$stage->id] ?? []);
    $stageTotal = (int) $levelRows->sum('total');
    $stageDone = (int) $levelRows->sum('completed');
@endphp
<article class="card stage-card">
    <span class="badge">Tahap {{ $stage->number }}</span>
    <h3>{{ $stage->name }}</h3>
    <p>{{ $stage->summary }}</p>
    @include('partials.progress-bar', ['done' => $stageDone, 'total' => $stageTotal])
    <a class="btn btn-primary" href="{{ route('stages.show', $stage) }}">
        {{ $stageDone > 0 ? 'Lanjutkan latihan' : 'Mulai latihan' }}
    </a>
</article>