<?php

namespace Database\Seeders;

use App\Models\LearningStage;
use Illuminate\Database\Seeder;

class LearningStageSeeder extends Seeder
{
    public function run(): void
    {
        $stages = [
            [
                'number' => 1,
                'slug' => 'menyusun-alur-berpikir',
                'name' => 'Menyusun Alur Berpikir',
                'goal' => 'Melatih kamu menyusun langkah-langkah logis untuk mencapai tujuan tertentu.',
                'summary' => 'Latih kemampuan menyusun urutan langkah dan algoritma, dari menyusun blok sampai merancang solusi sendiri.',
                'skills' => [
                    'Mengurutkan langkah secara logis',
                    'Menggunakan percabangan dan pengulangan dalam alur berpikir',
                    'Merancang algoritma yang memenuhi aturan dan batasan',
                ],
                'level_methods' => [
                    'easy' => 'Susun blok instruksi dengan drag-and-drop menjadi urutan yang benar. Jawabanmu diperiksa otomatis dan kamu mendapat penjelasan.',
                    'medium' => 'Susun algoritma sendiri di kertas. Website hanya menampilkan masalah, tujuan, dan batasan, lalu menyediakan panduan di akhir latihan.',
                    'hard' => 'Pelajari studi kasus, tentukan masalah dan aturannya, lalu rancang algoritma sendiri di kertas tanpa petunjuk langkah.',
                ],
            ],
            [
                'number' => 2,
                'slug' => 'menganalisis-masalah',
                'name' => 'Menganalisis Masalah',
                'goal' => 'Melatih kamu memahami masalah dengan baik sebelum menentukan solusi.',
                'summary' => 'Latih kemampuan menemukan inti masalah, memilah informasi, dan memahami penyebabnya sebelum mencari solusi.',
                'skills' => [
                    'Menemukan inti masalah',
                    'Memilah informasi yang relevan dan tidak relevan',
                    'Membedakan tujuan, gejala, dan penyebab',
                    'Mengenali asumsi, batasan, dan informasi yang belum tersedia',
                ],
                'level_methods' => [
                    'easy' => 'Baca masalah singkat, lalu jawab pertanyaan pilihan ganda atau pilih beberapa informasi penting. Jawabanmu diperiksa otomatis.',
                    'medium' => 'Baca kasus yang memuat informasi penting dan tambahan, lalu analisis di kertas. Panduan evaluasi tersedia di akhir.',
                    'hard' => 'Analisis studi kasus kompleks dengan beberapa kemungkinan penyebab di kertas, lalu evaluasi sendiri dengan panduan.',
                ],
            ],
            [
                'number' => 3,
                'slug' => 'menguji-memperbaiki-solusi',
                'name' => 'Menguji dan Memperbaiki Solusi',
                'goal' => 'Melatih kamu mengevaluasi hasil, menemukan kesalahan, dan memperbaiki solusi.',
                'summary' => 'Latih kemampuan menelusuri algoritma, menemukan kesalahan logika, dan memperbaiki solusi lewat berbagai skenario uji.',
                'skills' => [
                    'Menelusuri hasil eksekusi algoritma',
                    'Menemukan kesalahan logika',
                    'Menguji solusi pada berbagai skenario, termasuk kasus batas',
                    'Memperbaiki solusi dan menjelaskan alasannya',
                ],
                'level_methods' => [
                    'easy' => 'Telusuri algoritma sederhana dan tentukan hasilnya. Jawabanmu diperiksa otomatis.',
                    'medium' => 'Temukan kesalahan logika pada algoritma, jelaskan penyebabnya, dan perbaiki di kertas. Contoh perbaikan tersedia di akhir.',
                    'hard' => 'Uji solusi pada banyak skenario di kertas, temukan kegagalannya, dan usulkan perbaikan yang lebih tepat.',
                ],
            ],
        ];

        foreach ($stages as $data) {
            LearningStage::updateOrCreate(
                ['number' => $data['number']],
                $data
            );
        }
    }
}
