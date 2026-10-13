<?php

namespace Database\Seeders;

class Stage1ExerciseSeeder extends BaseExerciseSeeder
{
    protected function stageNumber(): int
    {
        return 1;
    }

    protected function exercises(): array
    {
        return [
            'easy' => [
                [
                    'type' => 'dnd_order',
                    'title' => 'Menyeduh teh manis',
                    'desc' => 'Dinda ingin membuat segelas teh manis hangat dari kantong teh dan air di panci. Susun langkah-langkahnya dengan urutan yang benar.',
                    'obj' => 'Melatih menyusun aktivitas sehari-hari menjadi urutan langkah yang logis berdasarkan ketergantungan antarlangkah.',
                    'o' => [
                        'Isi panci dengan air',
                        'Rebus air di panci hingga mendidih',
                        'Tuang air mendidih ke dalam gelas',
                        'Masukkan kantong teh ke dalam air panas di gelas',
                        'Diamkan 3 menit lalu angkat kantong teh',
                        'Setelah kantong teh diangkat, tambahkan gula ke dalam teh lalu aduk',
                    ],
                    'exp' => 'Air harus ada di panci sebelum direbus, dan baru bisa dituang setelah mendidih. Kantong teh dimasukkan ke air panas yang sudah ada di gelas, didiamkan, lalu diangkat. Gula ditambahkan terakhir setelah kantong teh diangkat.',
                ],
                [
                    'type' => 'dnd_order',
                    'title' => 'Menentukan bilangan genap atau ganjil',
                    'desc' => 'Susun algoritma yang menerima sebuah bilangan bulat, lalu menampilkan apakah bilangan tersebut genap atau ganjil.',
                    'obj' => 'Melatih urutan masukan, proses, dan keluaran pada algoritma dengan percabangan.',
                    'o' => [
                        'Mulai',
                        'Baca sebuah bilangan bulat',
                        'Hitung sisa bagi bilangan tersebut dengan 2',
                        'Jika sisa 0 tampilkan "Genap", jika tidak tampilkan "Ganjil"',
                        'Selesai',
                    ],
                    'exp' => 'Bilangan harus dibaca lebih dulu, lalu sisa baginya dihitung. Keputusan genap atau ganjil baru bisa dibuat setelah sisa bagi diketahui.',
                ],
                [
                    'type' => 'dnd_order',
                    'title' => 'Menghitung luas persegi panjang',
                    'desc' => 'Sebuah program harus menghitung luas persegi panjang dari panjang dan lebar yang dimasukkan pengguna.',
                    'obj' => 'Melatih menyusun alur masukan, perhitungan, dan keluaran.',
                    'o' => [
                        'Mulai',
                        'Baca nilai panjang dan lebar',
                        'Hitung luas = panjang × lebar',
                        'Tampilkan luas',
                        'Selesai',
                    ],
                    'exp' => 'Luas tidak dapat dihitung sebelum panjang dan lebar diketahui, dan hasil tidak dapat ditampilkan sebelum dihitung.',
                ],
                [
                    'type' => 'dnd_order',
                    'title' => 'Menentukan kelulusan siswa',
                    'desc' => 'Seorang siswa dinyatakan lulus jika nilai ujiannya minimal 70. Susun algoritma untuk menentukan status kelulusan dan menampilkannya.',
                    'obj' => 'Melatih penggunaan perbandingan dan keputusan dalam alur berpikir.',
                    'o' => [
                        'Mulai',
                        'Baca nilai ujian siswa',
                        'Bandingkan nilai dengan batas kelulusan 70',
                        'Tentukan status: "Lulus" jika nilai minimal 70, jika tidak "Tidak lulus"',
                        'Tampilkan status kelulusan',
                        'Selesai',
                    ],
                    'exp' => 'Nilai dibaca, dibandingkan dengan batas, status ditentukan dari hasil perbandingan, lalu status ditampilkan.',
                ],
                [
                    'type' => 'dnd_order',
                    'title' => 'Menghitung total belanja',
                    'desc' => 'Seorang kasir memasukkan harga setiap barang pelanggan satu per satu. Susun algoritma yang menghitung total belanja dari seluruh barang.',
                    'obj' => 'Melatih penggunaan penampung hasil dan pengulangan.',
                    'o' => [
                        'Mulai',
                        'Siapkan total belanja dengan nilai awal 0 sebelum barang pertama diproses',
                        'Ambil harga barang berikutnya',
                        'Tambahkan harga tersebut ke total belanja',
                        'Ulangi dua langkah sebelumnya sampai semua barang diproses',
                        'Tampilkan total belanja',
                        'Selesai',
                    ],
                    'exp' => 'Total harus disiapkan dari 0 sebelum ada penjumlahan. Pengulangan dilakukan sampai semua barang diproses, dan total ditampilkan setelah pengulangan selesai.',
                ],
            ],

            'medium' => [
                [
                    'type' => 'paper',
                    'title' => 'Angka terbesar dari dua angka',
                    'desc' => [
                        'Buatlah algoritma untuk menentukan angka terbesar dari dua angka yang dimasukkan pengguna.',
                        'Tujuan: pengguna mengetahui angka mana yang lebih besar.',
                        'Batasan: kedua angka bisa sama besar, dan algoritma harus tetap memberi hasil yang jelas.',
                    ],
                    'obj' => 'Melatih penyusunan algoritma percabangan dengan seluruh kemungkinan hasil.',
                    'guide' => [
                        '1. Mulai.',
                        '2. Baca angka A dan angka B.',
                        '3. Jika A > B, tampilkan A.',
                        '4. Jika tidak, jika B > A, tampilkan B.',
                        '5. Jika tidak (A sama dengan B), tampilkan "Kedua angka sama besar".',
                        '6. Selesai.',
                    ],
                    'points' => [
                        'Kedua angka dibaca sebelum dibandingkan.',
                        'Ada perbandingan antara dua angka.',
                        'Tiga kemungkinan ditangani: A lebih besar, B lebih besar, dan sama besar.',
                        'Hasil ditampilkan di akhir.',
                    ],
                ],
                [
                    'type' => 'paper',
                    'title' => 'Total belanja dengan diskon',
                    'desc' => [
                        'Sebuah toko memberi diskon 10% jika total belanja pelanggan minimal Rp200.000. Jika kurang dari itu, tidak ada diskon.',
                        'Buatlah algoritma yang menerima total belanja dan menampilkan jumlah yang harus dibayar.',
                        'Batasan: total belanja tepat Rp200.000 sudah mendapat diskon.',
                    ],
                    'obj' => 'Melatih penyusunan algoritma dengan syarat batas dan perhitungan.',
                    'guide' => [
                        '1. Mulai.',
                        '2. Baca total belanja.',
                        '3. Jika total belanja >= 200000: diskon = total belanja × 10 / 100, jika tidak diskon = 0.',
                        '4. Jumlah bayar = total belanja - diskon.',
                        '5. Tampilkan jumlah bayar.',
                        '6. Selesai.',
                    ],
                    'points' => [
                        'Total belanja dibaca lebih dulu.',
                        'Syarat memakai "lebih dari atau sama dengan" 200000, bukan hanya "lebih dari".',
                        'Diskon dihitung 10% dari total, dan nol jika syarat tidak terpenuhi.',
                        'Jumlah bayar adalah total dikurangi diskon.',
                    ],
                ],
                [
                    'type' => 'paper',
                    'title' => 'Kelulusan berdasarkan beberapa nilai',
                    'desc' => [
                        'Seorang siswa lulus jika rata-rata nilai tiga mata pelajaran (Matematika, IPA, Bahasa) minimal 70 dan tidak ada nilai yang di bawah 60.',
                        'Buatlah algoritma yang menerima tiga nilai tersebut dan menampilkan status kelulusan.',
                    ],
                    'obj' => 'Melatih penggabungan beberapa syarat dalam satu keputusan.',
                    'guide' => [
                        '1. Mulai.',
                        '2. Baca nilai Matematika, IPA, dan Bahasa.',
                        '3. Hitung rata-rata = (Matematika + IPA + Bahasa) / 3.',
                        '4. Tentukan nilai terendah dari ketiga nilai.',
                        '5. Jika rata-rata >= 70 DAN nilai terendah >= 60, tampilkan "Lulus".',
                        '6. Jika tidak, tampilkan "Tidak lulus".',
                        '7. Selesai.',
                    ],
                    'points' => [
                        'Rata-rata dihitung dari tiga nilai.',
                        'Nilai terendah diperiksa terpisah.',
                        'Kedua syarat digabung dengan DAN, bukan ATAU.',
                        'Ada hasil untuk kasus lulus dan tidak lulus.',
                    ],
                ],
                [
                    'type' => 'paper',
                    'title' => 'Tarif parkir berdasarkan kondisi',
                    'desc' => [
                        'Tarif parkir sebuah gedung: motor Rp2.000 untuk jam pertama dan Rp1.000 untuk setiap jam berikutnya; mobil Rp5.000 untuk jam pertama dan Rp2.000 untuk setiap jam berikutnya.',
                        'Durasi parkir dimasukkan dalam menit dan dibulatkan ke atas ke jam penuh. Durasi minimal dihitung 1 jam.',
                        'Buatlah algoritma yang menerima jenis kendaraan dan durasi, lalu menampilkan tarif.',
                    ],
                    'obj' => 'Melatih penyusunan algoritma dengan pembulatan, percabangan, dan penanganan masukan tidak dikenal.',
                    'guide' => [
                        '1. Mulai.',
                        '2. Baca jenis kendaraan dan durasi dalam menit.',
                        '3. jam = durasi / 60 dibulatkan ke atas. Jika jam < 1, setel jam = 1.',
                        '4. Jika jenis = motor: tarif = 2000 + 1000 × (jam - 1).',
                        '5. Jika jenis = mobil: tarif = 5000 + 2000 × (jam - 1).',
                        '6. Jika bukan keduanya, tampilkan "Jenis kendaraan tidak dikenal" dan berhenti.',
                        '7. Tampilkan tarif. Selesai.',
                        'Contoh: mobil 130 menit menjadi 3 jam, sehingga tarif = 5000 + 2000 × 2 = 9000.',
                    ],
                    'points' => [
                        'Durasi menit dikonversi ke jam dan dibulatkan ke atas.',
                        'Durasi minimal 1 jam ditangani.',
                        'Tarif jam pertama dipisahkan dari jam berikutnya.',
                        'Tarif motor dan mobil dipisahkan dengan percabangan.',
                    ],
                ],
                [
                    'type' => 'paper',
                    'title' => 'Urutan proses pendaftaran akun',
                    'desc' => [
                        'Sebuah situs kursus online menyediakan pendaftaran akun. Pengguna mengisi formulir (nama, email, kata sandi). Sistem harus memeriksa kelengkapan isian, memeriksa apakah email sudah terdaftar, mengirim kode verifikasi ke email, memeriksa kode yang dimasukkan pengguna, dan membuat akun.',
                        'Susun urutan proses yang logis, termasuk yang terjadi jika data belum lengkap, email sudah terdaftar, atau kode salah.',
                    ],
                    'obj' => 'Melatih menyusun urutan proses beserta penanganan kondisi gagal.',
                    'guide' => [
                        '1. Mulai. Tampilkan formulir pendaftaran.',
                        '2. Pengguna mengisi nama, email, dan kata sandi.',
                        '3. Jika ada isian kosong, tampilkan pesan dan kembali ke langkah 2.',
                        '4. Jika email sudah terdaftar, tampilkan pesan dan kembali ke langkah 2.',
                        '5. Kirim kode verifikasi ke email.',
                        '6. Pengguna memasukkan kode.',
                        '7. Jika kode salah, tampilkan pesan dan kembali ke langkah 6.',
                        '8. Jika kode benar, buat akun dan tampilkan pesan berhasil.',
                        '9. Selesai.',
                    ],
                    'points' => [
                        'Kelengkapan data diperiksa sebelum proses lain.',
                        'Pemeriksaan email dilakukan sebelum kode dikirim.',
                        'Akun hanya dibuat setelah kode benar.',
                        'Setiap kondisi gagal punya langkah lanjutan yang jelas.',
                    ],
                ],
            ],

            'hard' => [
                [
                    'type' => 'paper',
                    'title' => 'Sistem antrean dengan prioritas',
                    'desc' => [
                        'Sebuah sistem antrean harus melayani pelanggan berdasarkan urutan kedatangan. Pelanggan prioritas boleh didahulukan dari pelanggan reguler, tetapi selama masih ada pelanggan reguler yang menunggu, paling banyak 3 pelanggan prioritas boleh dilayani berturut-turut. Jika tidak ada pelanggan reguler yang menunggu, pelanggan prioritas tetap dilayani. Pelanggan baru dapat datang kapan saja.',
                        'Buatlah algoritma yang memenuhi aturan tersebut. Tentukan sendiri masalah utama, tujuan, informasi yang relevan, aturan dan batasan, serta urutan langkah penyelesaiannya.',
                    ],
                    'obj' => 'Melatih merancang algoritma dengan aturan yang saling berimbang.',
                    'guide' => [
                        'Masalah utama: menyeimbangkan prioritas dengan keadilan bagi pelanggan reguler.',
                        'Data: antrean prioritas dan antrean reguler (masing-masing urut kedatangan), penghitung prioritasBerturut = 0, batas = 3.',
                        '1. Mulai. Setel prioritasBerturut = 0.',
                        '2. Selama masih ada pelanggan yang menunggu, ulangi langkah 3 dan 4.',
                        '3. Jika ada pelanggan prioritas DAN (tidak ada pelanggan reguler menunggu ATAU prioritasBerturut < 3): layani prioritas paling awal. Jika saat itu ada pelanggan reguler menunggu, tambah prioritasBerturut 1.',
                        '4. Jika tidak: layani pelanggan reguler paling awal dan setel prioritasBerturut = 0.',
                        '5. Pelanggan baru masuk ke antrean sesuai jenisnya. Berhenti jika tidak ada yang menunggu.',
                        'Uji: 5 prioritas (P1-P5) dan 2 reguler (R1-R2) menunggu bersamaan menghasilkan urutan P1, P2, P3, R1, P4, P5, R2.',
                    ],
                    'points' => [
                        'Dua kelompok pelanggan dibedakan dan masing-masing tetap urut kedatangan.',
                        'Ada penghitung prioritas berturut-turut dengan batas 3.',
                        'Penghitung di-reset setelah pelanggan reguler dilayani.',
                        'Kasus tanpa pelanggan reguler ditangani agar prioritas tetap dilayani.',
                    ],
                ],
                [
                    'type' => 'paper',
                    'title' => 'Inventaris dengan stok minimum',
                    'desc' => [
                        'Sebuah gudang mencatat barang masuk dan barang keluar. Setiap barang punya stok minimum. Barang keluar tidak boleh melebihi stok yang tersedia. Jika setelah transaksi stok berada di bawah stok minimum, sistem membuat satu peringatan pemesanan ulang, dan tidak boleh membuat peringatan baru lagi sampai stok kembali mencapai minimal stok minimum.',
                        'Rancang algoritma untuk memproses satu transaksi (masuk atau keluar) beserta aturan peringatannya.',
                    ],
                    'obj' => 'Melatih merancang algoritma dengan status yang harus diingat antar transaksi.',
                    'guide' => [
                        'Data per barang: stok, stokMinimum, peringatanAktif (benar/salah).',
                        '1. Baca barang, jenis transaksi, dan jumlah. Jika jumlah <= 0, tolak transaksi.',
                        '2. Jika jenis = masuk: stok = stok + jumlah. Jika stok >= stokMinimum, setel peringatanAktif = salah.',
                        '3. Jika jenis = keluar: jika jumlah > stok, tolak dengan pesan "Stok tidak cukup" dan berhenti.',
                        '4. Jika diterima: stok = stok - jumlah.',
                        '5. Setelah barang keluar, jika stok < stokMinimum DAN peringatanAktif = salah: buat peringatan pemesanan ulang dan setel peringatanAktif = benar.',
                        '6. Simpan stok terbaru dan tampilkan hasil transaksi.',
                    ],
                    'points' => [
                        'Transaksi keluar ditolak jika melebihi stok.',
                        'Peringatan dibuat hanya saat stok turun di bawah minimum.',
                        'Ada penanda peringatanAktif agar peringatan tidak berulang.',
                        'Penanda dikembalikan saat stok kembali mencapai minimum.',
                    ],
                ],
                [
                    'type' => 'paper',
                    'title' => 'Sistem peminjaman alat',
                    'desc' => [
                        'Sebuah laboratorium meminjamkan alat kepada anggota dengan aturan: satu anggota maksimal memiliki 3 pinjaman aktif; anggota yang masih punya denda belum lunas tidak boleh meminjam; alat harus berstatus tersedia; lama pinjam 7 hari. Jika dikembalikan terlambat, denda Rp1.000 per hari keterlambatan. Pelunasan denda terjadi di luar algoritma ini; algoritma hanya membaca status denda anggota.',
                        'Rancang algoritma untuk proses peminjaman dan proses pengembalian.',
                    ],
                    'obj' => 'Melatih merancang dua alur proses yang saling berhubungan dengan banyak syarat.',
                    'guide' => [
                        'PEMINJAMAN:',
                        '1. Baca anggota dan alat.',
                        '2. Jika anggota punya denda belum lunas, tolak dengan alasan denda.',
                        '3. Jika pinjaman aktif anggota >= 3, tolak dengan alasan batas pinjaman.',
                        '4. Jika alat tidak tersedia, tolak dengan alasan alat tidak tersedia.',
                        '5. Jika semua syarat terpenuhi: catat pinjaman, tenggat = hari ini + 7 hari, ubah status alat menjadi dipinjam, tambah pinjaman aktif anggota 1.',
                        'PENGEMBALIAN:',
                        '1. Baca alat yang dikembalikan dan cari pinjaman aktifnya.',
                        '2. Hitung hariTerlambat = tanggal kembali - tenggat. Jika negatif, setel 0.',
                        '3. Jika hariTerlambat > 0, denda = hariTerlambat × 1000 dan tambahkan ke denda anggota.',
                        '4. Ubah status alat menjadi tersedia dan kurangi pinjaman aktif anggota 1.',
                    ],
                    'points' => [
                        'Tiga syarat peminjaman diperiksa sebelum peminjaman dicatat.',
                        'Alasan penolakan dibedakan.',
                        'Tenggat dihitung 7 hari dari tanggal pinjam.',
                        'Denda hanya dihitung saat terlambat dan status alat serta pinjaman anggota diperbarui.',
                    ],
                ],
                [
                    'type' => 'paper',
                    'title' => 'Pemesanan dengan kondisi pembayaran',
                    'desc' => [
                        'Sebuah toko online mencadangkan stok selama 30 menit setelah pesanan dibuat. Jika pembayaran berhasil dalam 30 menit, pesanan diproses. Jika pembayaran gagal atau waktu habis, stok yang dicadangkan dilepas kembali. Jika pembayaran ternyata masuk setelah waktu habis, pesanan hanya diproses jika stok masih tersedia, sedangkan jika tidak, dana dikembalikan.',
                        'Rancang algoritma yang menangani seluruh kondisi tersebut.',
                    ],
                    'obj' => 'Melatih merancang alur dengan kondisi waktu dan keadaan yang bercabang.',
                    'guide' => [
                        '1. Pesanan dibuat: jika stok >= jumlah pesan, kurangi stok tersedia (cadangkan) dan catat waktuBuat. Jika tidak, tolak pesanan.',
                        '2. Tunggu hasil pembayaran atau waktu mencapai waktuBuat + 30 menit.',
                        '3. Jika pembayaran berhasil dan waktu <= batas: ubah status menjadi diproses.',
                        '4. Jika pembayaran gagal: lepas cadangan (tambahkan stok kembali), status dibatalkan.',
                        '5. Jika waktu habis tanpa pembayaran: lepas cadangan, status kedaluwarsa.',
                        '6. Jika pembayaran masuk setelah status kedaluwarsa: jika stok tersedia >= jumlah, cadangkan lagi dan proses pesanan. Jika tidak, kembalikan dana dan status dibatalkan.',
                        'Pastikan pelepasan cadangan hanya terjadi satu kali per pesanan.',
                    ],
                    'points' => [
                        'Stok dicadangkan saat pesanan dibuat.',
                        'Tiga hasil dibedakan: berhasil tepat waktu, gagal atau habis waktu, dan masuk terlambat.',
                        'Cadangan stok dilepas pada kegagalan dan kedaluwarsa, dan tidak dilepas dua kali.',
                        'Pembayaran terlambat memeriksa stok sebelum diproses atau dana dikembalikan.',
                    ],
                ],
                [
                    'type' => 'paper',
                    'title' => 'Penjadwalan tugas dengan batasan',
                    'desc' => [
                        'Seorang pekerja mengerjakan sejumlah tugas satu per satu. Setiap tugas punya durasi (jam, paling lama 8 jam), tenggat (hari ke-berapa), dan mungkin harus menunggu tugas lain selesai lebih dulu (ketergantungan). Pekerja hanya bekerja 8 jam per hari, tidak mengerjakan dua tugas sekaligus, dan setiap tugas harus selesai tuntas dalam satu hari (tidak dipecah).',
                        'Rancang algoritma yang menyusun jadwal pengerjaan dan menandai tugas yang selesai setelah tenggatnya. Jadwal tidak harus yang paling optimal, tetapi harus mematuhi semua aturan.',
                    ],
                    'obj' => 'Melatih merancang algoritma pemilihan dengan ketergantungan dan batas kapasitas.',
                    'guide' => [
                        'Data: daftar tugas (durasi, tenggat, prasyarat), jam tersisa hari ini = 8, hari = 1.',
                        '1. Selama masih ada tugas yang belum selesai, ulangi langkah 2 sampai 6.',
                        '2. Kumpulkan tugas siap: semua prasyaratnya sudah selesai.',
                        '3. Jika tidak ada tugas siap padahal masih ada tugas tersisa, ada ketergantungan melingkar: tampilkan peringatan dan berhenti.',
                        '4. Dari tugas siap, pilih yang tenggatnya paling awal (jika sama, pilih durasi terpendek).',
                        '5. Jika jam tersisa hari ini < durasi tugas, pindah ke hari berikutnya: hari = hari + 1 dan jam tersisa = 8.',
                        '6. Jadwalkan tugas pada hari tersebut, kurangi jam tersisa, tandai selesai. Jika hari penyelesaian > tenggat, tandai "terlambat".',
                        '7. Tampilkan jadwal dan daftar tugas terlambat.',
                    ],
                    'points' => [
                        'Tugas hanya dimulai jika semua prasyaratnya selesai.',
                        'Pemilihan berdasarkan tenggat paling awal.',
                        'Batas 8 jam per hari ditegakkan dan pergantian hari ditangani.',
                        'Tugas terlambat ditandai dan ketergantungan melingkar terdeteksi.',
                    ],
                ],
            ],
        ];
    }
}
