<?php

namespace Database\Seeders;

class Stage2ExerciseSeeder extends BaseExerciseSeeder
{
    protected function stageNumber(): int
    {
        return 2;
    }

    protected function exercises(): array
    {
        return [
            'easy' => [
                [
                    'type' => 'multiple_choice',
                    'title' => 'Inti masalah keterlambatan tugas',
                    'desc' => [
                        'Di sebuah kelas, banyak siswa terlambat mengumpulkan tugas. Guru mencari tahu dan menemukan bahwa sebagian besar siswa baru mulai mengerjakan tugas pada malam sebelum tenggat karena mereka tidak punya jadwal untuk mencicil tugas.',
                        'Pertanyaan: Apa inti masalah dalam kasus ini?',
                    ],
                    'obj' => 'Melatih menemukan inti masalah dari cerita singkat.',
                    'o' => [
                        'a' => 'Guru memberikan terlalu banyak tugas',
                        'b' => 'Siswa tidak merencanakan waktu untuk mencicil tugas',
                        'c' => 'Siswa tidak menyukai pelajaran',
                        'd' => 'Tenggat pengumpulan terlalu cepat',
                    ],
                    'k' => [
                        'correct' => 'b',
                        'feedback' => [
                            'a' => 'Kasus tidak menyebut jumlah tugas berlebihan.',
                            'c' => 'Kasus tidak membahas minat siswa.',
                            'd' => 'Kasus tidak menyebut tenggat yang terlalu singkat.',
                        ],
                    ],
                    'exp' => 'Informasi kunci adalah siswa baru mulai pada malam sebelum tenggat dan tidak punya jadwal mencicil. Itu menunjuk pada kurangnya perencanaan waktu. Pilihan lain tidak didukung oleh fakta di kasus.',
                ],
                [
                    'type' => 'multi_select',
                    'title' => 'Informasi yang relevan untuk membeli buku',
                    'desc' => [
                        'Rina ingin tahu berapa buku yang bisa ia beli dengan uang sakunya. Uang saku Rina Rp150.000. Harga setiap buku Rp35.000. Rina suka warna biru dan akan berjalan kaki ke toko yang berjarak 2 km dari rumah. Ia berencana pergi hari Minggu.',
                        'Pilih informasi yang diperlukan untuk menghitung jumlah buku yang bisa dibeli.',
                    ],
                    'obj' => 'Melatih memilah informasi yang relevan dari informasi tambahan.',
                    'o' => [
                        'a' => 'Uang saku Rina Rp150.000',
                        'b' => 'Harga setiap buku Rp35.000',
                        'c' => 'Rina suka warna biru',
                        'd' => 'Toko berjarak 2 km dan Rina berjalan kaki',
                        'e' => 'Rina pergi pada hari Minggu',
                    ],
                    'k' => [
                        'correct' => ['a', 'b'],
                        'feedback' => [
                            'c' => 'Warna kesukaan tidak memengaruhi jumlah buku.',
                            'd' => 'Rina berjalan kaki, jadi jarak tidak menambah biaya.',
                            'e' => 'Hari pergi tidak memengaruhi perhitungan.',
                        ],
                    ],
                    'exp' => 'Jumlah buku bergantung pada uang yang dimiliki dan harga per buku (150.000 / 35.000, dibulatkan ke bawah menjadi 4 buku). Warna kesukaan, jarak, dan hari tidak memengaruhi hasil.',
                ],
                [
                    'type' => 'multiple_choice',
                    'title' => 'Membedakan tujuan dan gejala',
                    'desc' => [
                        'Sebuah warung makan sepi pembeli. Dalam sebulan terakhir jumlah pelanggan menurun dan beberapa pelanggan mengeluh tentang rasa masakan. Pemilik warung ingin menambah jumlah pelanggan, menemukan penyebab penurunan, dan memperbaiki rasa masakan.',
                        'Pertanyaan: Manakah yang merupakan gejala masalah, bukan tujuan atau solusi?',
                    ],
                    'obj' => 'Melatih membedakan gejala yang teramati dari tujuan dan solusi.',
                    'o' => [
                        'a' => 'Menambah jumlah pelanggan',
                        'b' => 'Jumlah pelanggan menurun dalam sebulan terakhir',
                        'c' => 'Menemukan penyebab penurunan',
                        'd' => 'Memperbaiki rasa masakan',
                    ],
                    'k' => [
                        'correct' => 'b',
                        'feedback' => [
                            'a' => 'Ini adalah tujuan yang ingin dicapai.',
                            'c' => 'Ini adalah langkah analisis, bukan kondisi yang teramati.',
                            'd' => 'Ini adalah solusi yang diusulkan.',
                        ],
                    ],
                    'exp' => 'Gejala adalah kondisi yang teramati: pelanggan menurun. Tujuan adalah keadaan yang diinginkan, sedangkan memperbaiki rasa adalah solusi. Gejala perlu ditelusuri penyebabnya sebelum memilih solusi.',
                ],
                [
                    'type' => 'multi_select',
                    'title' => 'Data untuk menilai kapasitas perpustakaan',
                    'desc' => [
                        'Sekolah ingin mengetahui apakah ruang perpustakaan cukup menampung siswa yang berkunjung saat jam istirahat.',
                        'Pilih data yang dibutuhkan untuk menjawab pertanyaan tersebut.',
                    ],
                    'obj' => 'Melatih menentukan data yang benar-benar dibutuhkan untuk menjawab pertanyaan.',
                    'o' => [
                        'a' => 'Jumlah kursi yang tersedia di perpustakaan',
                        'b' => 'Jumlah siswa yang biasa berkunjung saat jam istirahat',
                        'c' => 'Warna cat dinding perpustakaan',
                        'd' => 'Jumlah judul buku di koleksi perpustakaan',
                        'e' => 'Nama penjaga perpustakaan',
                    ],
                    'k' => [
                        'correct' => ['a', 'b'],
                        'feedback' => [
                            'c' => 'Warna cat tidak memengaruhi daya tampung.',
                            'd' => 'Jumlah judul buku tidak menentukan daya tampung ruang.',
                            'e' => 'Nama penjaga tidak relevan terhadap kapasitas.',
                        ],
                    ],
                    'exp' => 'Untuk menilai daya tampung, bandingkan jumlah tempat duduk dengan jumlah pengunjung saat istirahat. Data lain tidak membantu menjawab pertanyaan itu.',
                ],
                [
                    'type' => 'multiple_choice',
                    'title' => 'Penyebab langsung lampu tidak menyala',
                    'desc' => [
                        'Lampu kamar tidak menyala. Saat diperiksa, listrik rumah normal, sakelar sudah dalam posisi ON, dan bola lampu terlihat putus. Bola lampu itu sudah dipakai lebih dari dua tahun.',
                        'Pertanyaan: Apa penyebab langsung lampu tidak menyala?',
                    ],
                    'obj' => 'Melatih mengenali penyebab langsung dibanding kondisi lain di sekitarnya.',
                    'o' => [
                        'a' => 'Listrik rumah padam',
                        'b' => 'Bola lampu putus',
                        'c' => 'Sakelar dalam posisi OFF',
                        'd' => 'Bola lampu dipakai lebih dari dua tahun',
                    ],
                    'k' => [
                        'correct' => 'b',
                        'feedback' => [
                            'a' => 'Kasus menyebut listrik rumah normal.',
                            'c' => 'Kasus menyebut sakelar sudah ON.',
                            'd' => 'Ini kondisi latar belakang yang mungkin menyebabkan putus, bukan penyebab langsungnya.',
                        ],
                    ],
                    'exp' => 'Penyebab langsung adalah faktor yang secara langsung membuat lampu tidak menyala, yaitu bola lampu putus. Usia pemakaian adalah faktor yang lebih jauh.',
                ],
            ],

            'medium' => [
                [
                    'type' => 'paper',
                    'title' => 'Analisis keterlambatan pengantaran kue',
                    'desc' => [
                        'Toko Roti Mawar menerima pesanan kue lewat WhatsApp dan mengantarnya ke pelanggan. Dalam seminggu, 6 dari 20 pengantaran terlambat lebih dari 30 menit. Toko berdiri sejak 2015 dan baru mengganti logo tahun lalu. Toko memiliki 2 kurir. Kue-kue dipanggang bersamaan dan hampir selalu selesai sekitar pukul 10.00. Keterlambatan terjadi pada hari ketika lebih dari 4 pesanan siap bersamaan. Kurir mengendarai motor berwarna merah. Harga kue naik 5% bulan lalu.',
                        'Tuliskan di kertas: (1) masalah utama, (2) informasi yang relevan, (3) tujuan penyelesaian, (4) informasi yang tidak diperlukan.',
                    ],
                    'obj' => 'Melatih menganalisis kasus dengan memilah informasi relevan dan tidak relevan.',
                    'guide' => [
                        'Masalah utama: kapasitas pengantaran (2 kurir) tidak sebanding dengan pesanan yang selesai serentak, sehingga pengantaran terlambat.',
                        'Informasi relevan: 6 dari 20 pengantaran terlambat; hanya ada 2 kurir; kue selesai bersamaan sekitar 10.00; keterlambatan terjadi saat lebih dari 4 pesanan siap bersamaan.',
                        'Tujuan: pengantaran tepat waktu (tidak terlambat lebih dari 30 menit).',
                        'Tidak diperlukan: tahun berdiri, penggantian logo, warna motor, kenaikan harga.',
                    ],
                    'points' => [
                        'Masalah dirumuskan sebagai ketidakseimbangan kapasitas kurir dan waktu selesai pesanan.',
                        'Pola keterlambatan (lebih dari 4 pesanan serentak) disebutkan.',
                        'Tujuan dirumuskan terukur (tepat waktu).',
                        'Informasi tidak relevan dikenali: logo, warna motor, tahun berdiri, kenaikan harga.',
                    ],
                ],
                [
                    'type' => 'paper',
                    'title' => 'Analisis kesalahan data nilai kelas',
                    'desc' => [
                        'Laporan menunjukkan rata-rata nilai ujian kelas 9B adalah 48, padahal biasanya sekitar 78. Kelas 9B terdiri atas 18 siswa. Guru menemukan 7 siswa tercatat bernilai 0 padahal mereka hadir saat ujian. Data nilai diketik operator ke lembar kerja. Pada 7 baris tersebut, kolom nilai dibiarkan kosong karena lembar jawaban belum selesai dikoreksi, dan rumus rata-rata menganggap sel kosong sebagai 0. Sebelas siswa lainnya memiliki nilai yang rata-ratanya sekitar 78. Ujian berlangsung di ruang laboratorium dan terdiri dari 40 soal pilihan ganda. Sekolah memiliki 12 kelas.',
                        'Tuliskan di kertas: (1) masalah utama, (2) informasi yang relevan, (3) tujuan penyelesaian, (4) informasi yang tidak diperlukan.',
                    ],
                    'obj' => 'Melatih menelusuri sumber kesalahan data sebelum menyimpulkan.',
                    'guide' => [
                        'Masalah utama: rata-rata kelas terlihat rendah karena nilai yang belum ada dihitung sebagai 0.',
                        'Informasi relevan: 7 dari 18 siswa hadir tetapi bernilai 0; sel nilai kosong; rumus menganggap kosong sebagai 0; lembar jawaban belum selesai dikoreksi; 11 siswa lain rata-rata sekitar 78. Pembuktian: (11 × 78) / 18 ≈ 47,7, sesuai dengan rata-rata 48 yang dilaporkan.',
                        'Tujuan: rata-rata kelas mencerminkan nilai sebenarnya dan data yang belum lengkap tidak dihitung sebagai 0.',
                        'Tidak diperlukan: lokasi ujian di laboratorium, jumlah 40 soal, jumlah 12 kelas.',
                    ],
                    'points' => [
                        'Penyebab data salah dikaitkan dengan sel kosong yang dihitung 0.',
                        'Disebutkan bahwa siswa hadir, jadi nilai 0 bukan nilai sebenarnya.',
                        'Tujuan menekankan data akurat dan perlakuan data belum lengkap.',
                        'Informasi lokasi ujian, jumlah soal, dan jumlah kelas dikenali tidak diperlukan.',
                    ],
                ],
                [
                    'type' => 'paper',
                    'title' => 'Analisis pengelolaan stok susu kafe',
                    'desc' => [
                        'Sebuah kafe sering kehabisan susu pada Jumat sore, sementara pada Senin stok susu berlebih dan sebagian kedaluwarsa. Pemesanan dilakukan setiap Senin dengan jumlah tetap 20 liter. Penjualan susu pada akhir pekan sekitar dua kali lipat hari biasa. Pemasok tidak mengantar pada Sabtu dan Minggu. Lemari pendingin muat 40 liter. Kafe memiliki 3 barista dan memutar musik jazz.',
                        'Tuliskan di kertas: (1) masalah utama, (2) informasi yang relevan, (3) tujuan penyelesaian, (4) informasi yang tidak diperlukan.',
                    ],
                    'obj' => 'Melatih mengenali ketidakcocokan antara pola kebutuhan dan cara pemesanan.',
                    'guide' => [
                        'Masalah utama: jumlah pesanan tetap tidak mengikuti pola permintaan yang berbeda tiap hari, sehingga kekurangan di akhir pekan dan kelebihan di awal pekan.',
                        'Informasi relevan: pemesanan tiap Senin 20 liter tetap; penjualan akhir pekan dua kali lipat; pemasok tidak mengantar akhir pekan; kehabisan Jumat sore dan kedaluwarsa pada Senin; kapasitas lemari 40 liter.',
                        'Tujuan: stok cukup sepanjang pekan tanpa banyak yang kedaluwarsa.',
                        'Tidak diperlukan: jumlah barista dan musik jazz.',
                    ],
                    'points' => [
                        'Masalah dirumuskan sebagai pesanan tetap versus permintaan yang bervariasi.',
                        'Batasan pemasok akhir pekan dan kapasitas lemari dikenali.',
                        'Tujuan mencakup kecukupan stok dan pengurangan kedaluwarsa.',
                        'Jumlah barista dan musik dikenali tidak relevan.',
                    ],
                ],
                [
                    'type' => 'paper',
                    'title' => 'Analisis antrean layanan puskesmas',
                    'desc' => [
                        'Pasien sebuah puskesmas mengeluh antre lebih dari 90 menit antara pukul 08.00 dan 10.00. Pendaftaran hanya dilayani 1 loket secara manual, dengan waktu sekitar 4 menit per pasien. Sekitar 30 pasien datang tepat saat puskesmas buka pukul 08.00. Setelah pukul 10.00 puskesmas relatif sepi. Terdapat 3 dokter yang siap memeriksa. Dinding puskesmas dicat hijau dan lahan parkirnya luas.',
                        'Tuliskan di kertas: (1) masalah utama, (2) informasi yang relevan, (3) tujuan penyelesaian, (4) informasi yang tidak diperlukan.',
                    ],
                    'obj' => 'Melatih menemukan titik hambatan dari data pada kasus layanan.',
                    'guide' => [
                        'Masalah utama: pendaftaran menjadi titik hambatan karena 30 pasien datang bersamaan pada satu loket manual (30 × 4 menit = 120 menit untuk pasien terakhir).',
                        'Informasi relevan: antre lebih dari 90 menit pukul 08.00 sampai 10.00; 1 loket; 4 menit per pasien; 30 pasien datang tepat pukul 08.00; sepi setelah 10.00; 3 dokter siap.',
                        'Tujuan: mengurangi waktu tunggu pendaftaran pada jam sibuk awal.',
                        'Tidak diperlukan: warna dinding dan luas lahan parkir.',
                    ],
                    'points' => [
                        'Hambatan diidentifikasi pada pendaftaran, bukan pada dokter.',
                        'Perhitungan sederhana (30 × 4 menit) dipakai untuk mendukung kesimpulan.',
                        'Pola kedatangan serentak di awal dikenali.',
                        'Warna dinding dan parkir dikenali tidak relevan.',
                    ],
                ],
                [
                    'type' => 'paper',
                    'title' => 'Analisis kegagalan transaksi donasi',
                    'desc' => [
                        'Sebuah aplikasi donasi mencatat 12% transaksi gagal setiap malam pukul 20.00 sampai 22.00 dengan pesan "timeout". Pada jam itu penyedia pembayaran pihak ketiga membutuhkan lebih dari 30 detik untuk merespons, sedangkan aplikasi hanya menunggu 15 detik. Jumlah pengguna melonjak ketika ada siaran langsung penggalangan dana. Tombol donasi berwarna hijau dan aplikasi berada pada versi 3.2.',
                        'Tuliskan di kertas: (1) masalah utama, (2) informasi yang relevan, (3) tujuan penyelesaian, (4) informasi yang tidak diperlukan.',
                    ],
                    'obj' => 'Melatih menghubungkan gejala kegagalan dengan batas waktu dan beban sistem.',
                    'guide' => [
                        'Masalah utama: transaksi gagal karena batas tunggu aplikasi (15 detik) lebih singkat daripada waktu respons penyedia pembayaran saat beban tinggi (lebih dari 30 detik).',
                        'Informasi relevan: 12% gagal pukul 20.00-22.00; pesan timeout; respons lebih dari 30 detik; batas tunggu 15 detik; lonjakan pengguna saat siaran langsung.',
                        'Tujuan: menurunkan kegagalan transaksi pada jam sibuk tanpa mengorbankan keamanan transaksi.',
                        'Tidak diperlukan: warna tombol dan nomor versi aplikasi.',
                    ],
                    'points' => [
                        'Kegagalan dikaitkan dengan perbedaan batas waktu dan respons pihak ketiga.',
                        'Pola waktu dan lonjakan pengguna disebutkan.',
                        'Tujuan menyebut penurunan kegagalan pada jam sibuk.',
                        'Warna tombol dan versi aplikasi dikenali tidak relevan.',
                    ],
                ],
            ],

            'hard' => [
                [
                    'type' => 'paper',
                    'title' => 'Penurunan penjualan toko online',
                    'desc' => [
                        'Penjualan sebuah toko online turun 25% dalam dua bulan terakhir. Data yang tersedia:',
                        '- Jumlah pengunjung turun 10%.',
                        '- Persentase pengunjung yang membeli (konversi) turun 17%.',
                        '- Jumlah keranjang yang ditinggalkan sebelum bayar naik.',
                        '- Ongkos kirim naik 15% bulan lalu.',
                        '- Aplikasi Android diperbarui 3 minggu lalu.',
                        '- Produk terlaris kosong selama 2 minggu.',
                        '- Survei kepuasan pelanggan belum pernah dilakukan.',
                        'Tuliskan di kertas: (1) masalah utama, (2) kemungkinan penyebab, (3) asumsi yang perlu diuji, (4) batasan penyelesaian, (5) informasi yang belum tersedia.',
                    ],
                    'obj' => 'Melatih membedakan beberapa kemungkinan penyebab dan menentukan apa yang perlu diuji.',
                    'guide' => [
                        'Masalah utama: penjualan turun terutama karena konversi turun lebih besar daripada penurunan pengunjung. Pembuktian: 0,90 × 0,83 = 0,747, yaitu turun sekitar 25%.',
                        'Kemungkinan penyebab: kenaikan ongkos kirim; kendala pada aplikasi Android setelah pembaruan; produk terlaris kosong; kompetitor atau faktor luar (belum ada data).',
                        'Asumsi yang perlu diuji: keranjang ditinggalkan banyak di Android; ongkos kirim menjadi alasan utama pembatalan; produk kosong memengaruhi sebagian besar penjualan.',
                        'Batasan: data penyebab belum lengkap; perubahan terjadi bersamaan sehingga sulit dipisahkan.',
                        'Informasi belum tersedia: konversi per platform; alasan keranjang ditinggalkan; kontribusi produk terlaris; kondisi pesaing; hasil survei.',
                    ],
                    'points' => [
                        'Masalah utama merujuk pada konversi, bukan hanya pengunjung.',
                        'Minimal tiga kemungkinan penyebab yang didukung data disebutkan.',
                        'Asumsi dirumuskan sebagai hal yang dapat diuji.',
                        'Informasi yang belum tersedia disebutkan secara spesifik.',
                    ],
                ],
                [
                    'type' => 'paper',
                    'title' => 'Evaluasi aplikasi belajar dan asumsi tersembunyi',
                    'desc' => [
                        'Sebuah sekolah menggunakan aplikasi belajar baru selama satu semester. Rata-rata nilai ujian akhir semester tidak naik dibanding semester lalu. Pimpinan menyimpulkan bahwa aplikasi tersebut tidak efektif dan ingin menghentikannya. Data tambahan:',
                        '- Hanya 60% siswa login minimal sekali seminggu.',
                        '- Guru memakai aplikasi dengan cara yang berbeda-beda; sebagian hanya untuk mengumpulkan tugas.',
                        '- Soal ujian akhir semester ini dibuat lebih sulit.',
                        '- Aplikasi baru dipasang pada minggu ke-4 semester.',
                        'Tuliskan di kertas: (1) masalah utama yang sebenarnya perlu dijawab, (2) kemungkinan penyebab nilai tidak naik, (3) asumsi tersembunyi dalam kesimpulan pimpinan, (4) batasan, (5) informasi yang belum tersedia.',
                    ],
                    'obj' => 'Melatih mengenali asumsi tersembunyi di balik sebuah kesimpulan.',
                    'guide' => [
                        'Masalah yang sebenarnya perlu dijawab: apakah aplikasi berpengaruh terhadap hasil belajar, dengan perbandingan yang adil.',
                        'Kemungkinan penyebab nilai tidak naik: aplikasi kurang dipakai; cara pakai tidak seragam; soal lebih sulit; durasi pemakaian singkat; aplikasi memang tidak efektif.',
                        'Asumsi tersembunyi: nilai kedua semester sebanding; semua siswa memakai aplikasi; ujian mengukur hal yang sama; tidak ada faktor lain yang berubah; satu semester cukup untuk melihat pengaruh.',
                        'Batasan: hanya ada satu semester data; tidak ada kelas pembanding.',
                        'Informasi belum tersedia: tingkat kesulitan soal terukur; nilai siswa yang aktif vs tidak aktif; kelas pembanding tanpa aplikasi; umpan balik guru dan siswa.',
                    ],
                    'points' => [
                        'Disebutkan bahwa kesimpulan pimpinan memakai perbandingan yang belum tentu adil.',
                        'Lebih dari satu penyebab selain aplikasi tidak efektif diajukan.',
                        'Asumsi tersembunyi dirumuskan eksplisit.',
                        'Informasi yang diperlukan untuk menguji kesimpulan disebutkan.',
                    ],
                ],
                [
                    'type' => 'paper',
                    'title' => 'Waktu tunggu klinik setelah penjadwalan online',
                    'desc' => [
                        'Setelah klinik memakai sistem janji temu online, keluhan waktu tunggu pasien meningkat. Data yang ada:',
                        '- Rata-rata waktu tunggu naik dari 20 menit menjadi 45 menit.',
                        '- Jumlah janji temu per hari naik 30%.',
                        '- Jumlah dokter tetap 3 orang.',
                        '- Durasi konsultasi rata-rata belum pernah diukur.',
                        'Tuliskan di kertas: (1) masalah utama, (2) kemungkinan penyebab, (3) asumsi yang perlu diuji, (4) batasan, (5) informasi yang belum tersedia dan mengapa informasi itu penting.',
                    ],
                    'obj' => 'Melatih mengenali informasi penting yang belum ada sebelum mengambil kesimpulan.',
                    'guide' => [
                        'Masalah utama: waktu tunggu pasien meningkat setelah jumlah janji temu naik tanpa penambahan kapasitas dokter.',
                        'Kemungkinan penyebab: janji temu naik 30% dengan 3 dokter tetap; jadwal slot tidak sesuai durasi konsultasi; janji ganda atau pasien datang tidak sesuai jam; pasien tanpa janji ikut menumpuk.',
                        'Asumsi yang perlu diuji: durasi konsultasi tidak berubah; pasien datang sesuai jadwal; seluruh pasien memakai sistem online.',
                        'Batasan: jumlah dokter tidak dapat segera ditambah; jam operasional klinik tetap.',
                        'Informasi belum tersedia: durasi konsultasi rata-rata; jumlah pasien tidak hadir atau terlambat; kemungkinan janji ganda; jumlah pasien tanpa janji; jam paling padat. Informasi ini menentukan apakah masalahnya kapasitas, penjadwalan, atau kedatangan.',
                    ],
                    'points' => [
                        'Hubungan janji naik 30% dengan kapasitas dokter dikenali.',
                        'Lebih dari satu penyebab selain kapasitas disebutkan.',
                        'Informasi yang belum ada disebutkan beserta alasannya.',
                        'Batasan penyelesaian dikenali.',
                    ],
                ],
                [
                    'type' => 'paper',
                    'title' => 'Sampah menumpuk di desa wisata',
                    'desc' => [
                        'Sebuah desa wisata mengalami penumpukan sampah setiap akhir pekan. Data yang ada:',
                        '- Pengunjung sekitar 800 orang per hari pada akhir pekan.',
                        '- Tersedia 10 tempat sampah.',
                        '- Ada 2 petugas kebersihan.',
                        '- Truk pengangkut sampah milik kota hanya datang setiap hari Rabu.',
                        '- Anggaran kebersihan desa Rp5 juta per bulan.',
                        'Tuliskan di kertas: (1) masalah utama, (2) kemungkinan penyebab, (3) asumsi yang perlu diuji, (4) batasan sumber daya, (5) informasi yang belum tersedia.',
                    ],
                    'obj' => 'Melatih menganalisis masalah dengan batasan sumber daya yang nyata.',
                    'guide' => [
                        'Masalah utama: volume sampah akhir pekan melebihi kapasitas penampungan dan pengangkutan.',
                        'Kemungkinan penyebab: tempat sampah terlalu sedikit untuk 800 pengunjung; jadwal angkut hanya Rabu sehingga sampah akhir pekan menumpuk berhari-hari; petugas terbatas; perilaku pengunjung membuang sampah sembarangan.',
                        'Asumsi yang perlu diuji: sampah memang berasal terutama dari pengunjung; tempat sampah penuh sebelum akhir hari; petugas tidak sempat mengosongkan.',
                        'Batasan: anggaran Rp5 juta per bulan; 2 petugas; jadwal truk tidak dapat diubah desa.',
                        'Informasi belum tersedia: volume sampah per hari; kapasitas tempat sampah; biaya angkut tambahan; kemungkinan kerja sama pengelolaan sampah.',
                    ],
                    'points' => [
                        'Masalah utama dirumuskan sebagai ketidakcocokan volume dan kapasitas.',
                        'Penyebab dari sisi fasilitas, jadwal, tenaga, dan perilaku dipertimbangkan.',
                        'Batasan anggaran, tenaga, dan jadwal truk disebutkan.',
                        'Informasi yang belum tersedia disebutkan secara spesifik.',
                    ],
                ],
                [
                    'type' => 'paper',
                    'title' => 'Menentukan prioritas tiga masalah aplikasi',
                    'desc' => [
                        'Tim pengembang aplikasi dompet digital menghadapi tiga masalah sekaligus:',
                        '1. Aplikasi menutup sendiri (crash) pada sekitar 5% perangkat lama.',
                        '2. Fitur pencarian riwayat transaksi lambat, rata-rata 6 detik.',
                        '3. Seorang pengguna melaporkan riwayat transaksinya bisa dilihat orang lain lewat tautan publik, tetapi belum diverifikasi.',
                        'Tim hanya punya 2 pengembang dan waktu 1 minggu. Tuliskan di kertas: (1) masalah utama, (2) urutan prioritas dan alasannya, (3) asumsi yang perlu diuji, (4) batasan, (5) informasi yang belum tersedia.',
                    ],
                    'obj' => 'Melatih menentukan prioritas berdasarkan dampak, risiko, dan keterbatasan sumber daya.',
                    'guide' => [
                        'Masalah utama: tiga masalah bersaing untuk sumber daya terbatas dengan tingkat risiko berbeda.',
                        'Prioritas yang masuk akal: (1) dugaan kebocoran data, segera diverifikasi dan dibatasi karena risiko privasi dan kepercayaan pengguna paling berat meskipun belum terbukti; (2) crash pada perangkat lama karena langsung menghalangi penggunaan; (3) pencarian lambat karena mengganggu tetapi tidak menghentikan penggunaan.',
                        'Asumsi yang perlu diuji: laporan kebocoran benar; crash terkait versi sistem tertentu; 6 detik lambat bagi sebagian besar pengguna.',
                        'Batasan: 2 pengembang dan 1 minggu; kebocoran harus ditangani terlebih dahulu sehingga pekerjaan lain tertunda.',
                        'Informasi belum tersedia: apakah kebocoran benar terjadi dan berapa pengguna terdampak; perangkat dan versi yang mengalami crash; jumlah pengguna yang terkena pencarian lambat.',
                        'Jawaban lain dapat diterima jika alasannya jelas dan memperhitungkan dampak serta risiko.',
                    ],
                    'points' => [
                        'Prioritas disusun dengan alasan berbasis dampak dan risiko.',
                        'Dugaan kebocoran data diperlakukan serius walaupun belum terverifikasi.',
                        'Batasan waktu dan tenaga diperhitungkan.',
                        'Informasi yang belum tersedia untuk memperkuat keputusan disebutkan.',
                    ],
                ],
            ],
        ];
    }
}
