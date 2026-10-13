@php $pct = $total > 0 ? (int) round($done / $total * 100) : 0; @endphp
<div class="progress" role="progressbar" aria-valuenow="{{ $pct }}" aria-valuemin="0" aria-valuemax="100"
     aria-label="Progres pengerjaan">
    <span style="width: {{ $pct }}%"></span>
</div>
<p class="progress-text">{{ $done }} dari {{ $total }} soal telah dikerjakan</p>