<?php

namespace App\Enums;

enum ExerciseType: string
{
    case DragOrder = 'dnd_order';
    case MultipleChoice = 'multiple_choice';
    case MultiSelect = 'multi_select';
    case Paper = 'paper';

    public function label(): string
    {
        return match ($this) {
            self::DragOrder => 'Susun Urutan (Drag-and-Drop)',
            self::MultipleChoice => 'Pilihan Ganda',
            self::MultiSelect => 'Pilih Beberapa Jawaban',
            self::Paper => 'Dikerjakan di Kertas',
        };
    }

    /** Hanya tipe ini yang diperiksa otomatis oleh backend. */
    public function isAutoGraded(): bool
    {
        return $this !== self::Paper;
    }
}
