<div class="notice">
    <strong>Kerjakan di kertas.</strong>
    Tuliskan <strong>nomor soal {{ $exercise->position }}</strong> pada jawabanmu agar bisa dicocokkan saat evaluasi.
    Website tidak mengumpulkan atau mengoreksi jawaban yang kamu tulis.
</div>

@if ($progress?->is_completed)
    <p class="status">✓ Soal ini sudah kamu tandai selesai dikerjakan.</p>
@else
    <form method="POST" action="{{ route('exercises.complete', [$stage, $level->value, $exercise->position]) }}">
        @csrf
        <button type="submit" class="btn btn-primary">Tandai sudah dikerjakan</button>
    </form>
@endif