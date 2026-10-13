<nav class="qnav" aria-label="Nomor soal">
    @foreach ($exercises as $item)
        @php
            $isDone = (bool) $progressMap->get($item->id)?->is_completed;
            $isCurrent = ($current ?? null) === $item->position;
        @endphp
        <a href="{{ route('exercises.show', [$stage, $level->value, $item->position]) }}"
           @class(['qnav-item', 'is-done' => $isDone, 'is-current' => $isCurrent])
           @if ($isCurrent) aria-current="step" @endif>
            {{ $item->position }}
            @if ($isDone)<span class="sr-only"> (sudah dikerjakan)</span>@endif
        </a>
    @endforeach
</nav>