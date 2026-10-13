<?php

namespace Database\Seeders;

use App\Models\Exercise;
use App\Models\LearningStage;
use Illuminate\Database\Seeder;

abstract class BaseExerciseSeeder extends Seeder
{
    abstract protected function stageNumber(): int;

    /**
     * @return array{
     *     easy: array<int, array<string, mixed>>,
     *     medium: array<int, array<string, mixed>>,
     *     hard: array<int, array<string, mixed>>
     * }
     */
    abstract protected function exercises(): array;

    public function run(): void
    {
        $stage = LearningStage::where('number', $this->stageNumber())->firstOrFail();

        foreach ($this->exercises() as $level => $items) {
            foreach ($items as $index => $item) {
                $position = $index + 1;
                $type = $item['type'];

                $description = is_array($item['desc'])
                    ? implode("\n\n", $item['desc'])
                    : (string) $item['desc'];

                $objective = (string) ($item['obj'] ?? '');

                $instruction = $item['instruction'] ?? match ($type) {
                    'dnd_order' => 'Susun blok instruksi berikut ke dalam urutan langkah yang benar dan logis.',
                    'multiple_choice' => 'Pilihlah satu jawaban yang paling tepat berdasarkan kasus di atas.',
                    'multi_select' => 'Pilihlah semua jawaban yang benar dan relevan berdasarkan kasus di atas.',
                    'paper' => $level === 'hard'
                        ? 'Pelajari studi kasus ini dengan saksama. Tuliskan analisis dan rancangan solusi lengkapmu di kertas, lalu cocokkan dengan panduan saat evaluasi akhir.'
                        : 'Kerjakan latihan ini di kertas atau buku catatan secara mandiri. Tuliskan nomor soal pada lembar jawabanmu agar mudah dicocokkan saat evaluasi.',
                    default => 'Kerjakan soal ini sesuai petunjuk.',
                };

                $options = null;
                $answerKey = null;

                if ($type === 'dnd_order') {
                    $options = [];
                    $answerKey = [];
                    foreach ($item['o'] as $idx => $label) {
                        $blockId = 'b'.($idx + 1);
                        $options[] = [
                            'id' => $blockId,
                            'label' => (string) $label,
                        ];
                        $answerKey[] = $blockId;
                    }
                } elseif ($type === 'multiple_choice' || $type === 'multi_select') {
                    $options = [];
                    foreach ($item['o'] as $optKey => $label) {
                        $options[] = [
                            'id' => (string) $optKey,
                            'label' => (string) $label,
                        ];
                    }
                    $answerKey = $item['k'] ?? null;
                }

                $explanation = '';
                if (isset($item['exp'])) {
                    $explanation = is_array($item['exp'])
                        ? implode("\n\n", $item['exp'])
                        : (string) $item['exp'];
                }

                $answerGuide = '';
                if (isset($item['guide'])) {
                    $answerGuide = is_array($item['guide'])
                        ? implode("\n\n", $item['guide'])
                        : (string) $item['guide'];
                } elseif ($explanation !== '') {
                    $answerGuide = $explanation;
                }

                $keyPoints = [];
                if (isset($item['points'])) {
                    $keyPoints = (array) $item['points'];
                } elseif ($type === 'dnd_order') {
                    $keyPoints = [
                        'Memahami ketergantungan urutan antarlangkah',
                        'Menyusun urutan instruksi secara logis dari awal hingga akhir',
                        'Mencapai hasil yang diharapkan tanpa langkah yang terbalik',
                    ];
                } elseif ($type === 'multiple_choice' || $type === 'multi_select') {
                    $keyPoints = [
                        'Mengidentifikasi informasi inti dari kasus yang diberikan',
                        'Membedakan fakta relevan dari opsi pengecoh',
                        'Menarik kesimpulan logis sesuai kondisi masalah',
                    ];
                } else {
                    $keyPoints = [
                        'Pemahaman terhadap inti masalah dan tujuan penyelesaian',
                        'Langkah penyelesaian yang runtut, terstruktur, dan masuk akal',
                        'Kepatuhan terhadap seluruh batasan kasus yang ditentukan',
                    ];
                }

                $rubric = [];
                if (isset($item['rubric'])) {
                    $rubric = (array) $item['rubric'];
                } else {
                    $rubric = [
                        'Kejelasan dan ketepatan pemahaman masalah',
                        'Kelogisan alur pemikiran dan tahapan solusi',
                        'Kesesuaian solusi dengan seluruh aturan dan batasan yang ditentukan',
                    ];
                }

                Exercise::updateOrCreate(
                    [
                        'learning_stage_id' => $stage->id,
                        'level' => $level,
                        'position' => $position,
                    ],
                    [
                        'type' => $type,
                        'title' => (string) $item['title'],
                        'description' => $description,
                        'instruction' => $instruction,
                        'objective' => $objective,
                        'answer_guide' => $answerGuide,
                        'key_points' => $keyPoints,
                        'rubric' => $rubric,
                        'options' => $options,
                        'answer_key' => $answerKey,
                        'explanation' => $explanation,
                        'is_active' => true,
                    ]
                );
            }
        }
    }
}
