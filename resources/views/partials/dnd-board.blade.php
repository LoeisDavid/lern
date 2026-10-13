<form method="POST" action="{{ route('exercises.check', [$stage, $level->value, $exercise->position]) }}"
      class="dnd" data-dnd>
    @csrf

    <p class="muted">Seret blok ke area jawaban. Di layar sentuh, gunakan tombol Tambah, Naik, Turun, dan Hapus.</p>

    <div class="dnd-grid">
        <div>
            <h3>Blok instruksi</h3>
            <ul class="dnd-list" data-list="pool" aria-label="Blok instruksi yang tersedia">
                @foreach ($options as $option)
                    <li class="dnd-block" draggable="true" data-id="{{ $option['id'] }}">
                        <span class="dnd-label">{{ $option['label'] }}</span>
                        <span class="dnd-controls">
                            <button type="button" class="mini pool-only" data-action="add">Tambah ›</button>
                            <button type="button" class="mini answer-only" data-action="up" aria-label="Naikkan blok">↑</button>
                            <button type="button" class="mini answer-only" data-action="down" aria-label="Turunkan blok">↓</button>
                            <button type="button" class="mini answer-only" data-action="remove">Hapus</button>
                        </span>
                    </li>
                @endforeach
            </ul>
        </div>

        <div>
            <h3>Area jawaban (urut dari atas)</h3>
            <ol class="dnd-list dnd-answer" data-list="answer" aria-label="Urutan jawabanmu"></ol>
        </div>
    </div>

    <p class="form-message" data-dnd-message role="alert"></p>

    <div class="actions">
        <button type="submit" class="btn btn-primary">Periksa jawaban</button>
        <button type="button" class="btn" data-action="reset">Kosongkan jawaban</button>
    </div>
</form>

@push('scripts')
    <script src="{{ asset('assets/js/dnd.js') }}" defer></script>
@endpush