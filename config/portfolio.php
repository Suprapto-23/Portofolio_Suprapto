<?php

/*
| DATA PORTOFOLIO (disusun dari CV Suprapto)
| Edit teks di sini, lalu jalankan: php artisan config:clear
| Gambar sertifikat/dokumentasi adalah DUMMY: ganti file di public/images/...
| dengan nama yang sama (.png/.jpg), atau ubah path 'image' / 'cover' / 'gallery'.
| Field [isi] di bagian experiences wajib diganti sebelum dipublikasikan.
*/

$dev = fn (string $s) => "https://cdn.jsdelivr.net/gh/devicons/devicon@v2.16.0/icons/{$s}/{$s}-original.svg";

return [

    /*
    |--------------------------------------------------------------------------
    | Tautan umum
    |--------------------------------------------------------------------------
    */

    // Folder Google Drive berisi salinan dokumen (sertifikat, surat HAKI, dan lainnya)
    'drive_url' => 'https://drive.google.com/drive/folders/1JWm1sXp5S5G1Wm22bny9ffijwzx-GGpw?usp=sharing',

    /*
    |--------------------------------------------------------------------------
    | Beranda & profil
    |--------------------------------------------------------------------------
    */

    'tech_logos' => [
        'PHP'          => $dev('php'),
        'Laravel'      => $dev('laravel'),
        'MySQL'        => $dev('mysql'),
        'Tailwind CSS' => $dev('tailwindcss'),
        'JavaScript'   => $dev('javascript'),
        'Git'          => $dev('git'),
        'Vercel'       => $dev('vercel'),
    ],

    'stats' => [
        ['3,76',   'IPK S1 Teknologi Informasi'],
        ['2',      'Hak Cipta Program Komputer'],
        ['84,28%', 'Kelayakan SIM Posyandu pada UAT'],
        ['1',      'Publikasi Jurnal Ilmiah, SOLMA 2026'],
    ],

    // Dua paragraf profil. Beranda menampilkan versi ringkas, halaman profil menampilkan keduanya.
    'about' => [
        'Fresh graduate S1 Teknologi Informasi ITSNU Pekalongan (IPK 3,76) yang berfokus pada pengembangan sistem informasi berbasis web dengan Laravel, PHP, dan MySQL. Saya terbiasa menangani prosesnya secara utuh: analisis kebutuhan, perancangan sistem dan basis data, pengembangan, pengujian, hingga pendampingan pengguna.',
        'Karya saya tidak berhenti di layar. Sistem pemesanan tiket wisata yang saya kembangkan bersama tim dipakai untuk transaksi nyata oleh Pokdarwis Lolong Adventure, dan SIM Posyandu hasil skripsi saya meraih kelayakan 84,28% (“Sangat Layak”) pada User Acceptance Testing. Keduanya kini tercatat sebagai Hak Cipta Program Komputer.',
    ],

    // Tidak ditampilkan di halaman profil (isinya sudah ada di paragraf about).
    'highlights' => [
        'Sistem pemesanan tiket wisata yang saya bangun bersama tim digunakan untuk transaksi nyata di tiketlolongadventure.com',
        'Program PKM ITSNU Pekalongan (Hibah DPPM Kemdiktisaintek 2025) meraih Nilai A dan terbit di Jurnal SOLMA 15(1), 2026',
        'Pencipta bersama dua Hak Cipta Program Komputer dan bersertifikat BNSP Junior Web Programmer',
    ],

    /*
    |--------------------------------------------------------------------------
    | Pendidikan
    |--------------------------------------------------------------------------
    */

    'education' => [
        'degree' => 'S1 Teknologi Informasi',
        'school' => 'Institut Teknologi dan Sains Nahdlatul Ulama (ITSNU) Pekalongan',
        'period' => '2022 – 2026',
        'gpa'    => 'IPK 3,76 · Ijazah telah terbit',
        'points' => [
            'Fokus studi pada analisis dan perancangan sistem, basis data, serta pengembangan aplikasi web.',
            'Skripsi: “Implementasi Metode RAD dalam Rancang Bangun Sistem Informasi Manajemen Posyandu (Studi Kasus: Desa Bantarkulon)”, 2026.',
            'Skripsi tersebut menyatukan pencatatan sasaran Balita, Remaja, dan Lansia dalam satu basis data terpadu dengan hak akses berbasis peran (Admin, Bidan, Kader, dan Warga).',
        ],
    ],

    // Tidak ditampilkan di halaman profil. Disimpan bila beranda memakainya.
    'principles' => [
        ['Dimulai dari kebutuhan nyata', 'Saya memulai dari masalah pengguna: memahami kebutuhan mitra, lalu menerjemahkannya menjadi alur sistem dan skema database. Pendekatan ini saya pakai pada sistem tiket Lolong Adventure dan SIM PosyanduCare.'],
        ['Hak akses yang tertata', 'Role-Based Access Control saya terapkan agar setiap peran hanya mengakses data sesuai tugasnya, seperti Admin, Bidan, Kader, dan Warga pada SIM PosyanduCare.'],
        ['Diuji sebelum diserahkan', 'Black Box Testing memastikan skenario fungsional berjalan, sedangkan User Acceptance Testing mengukur kelayakan bagi pengguna sebenarnya.'],
        ['Pengguna ikut didampingi', 'Sistem baru perlu dipahami pemakainya. Saya terbiasa menyusun dan mendampingi pelatihan, termasuk bagi 20 anggota Pokdarwis Lolong Adventure.'],
    ],

    /*
    |--------------------------------------------------------------------------
    | Pengalaman (urut kronologis: yang paling awal di atas)
    | Field: role, org, period, points, tags, links ([label, url])
    | Kartu ini dipakai oleh partials/experience-card.blade.php
    |--------------------------------------------------------------------------
    */

    'experiences' => [
        [
            'role'   => 'Magang – Backend Developer',
            'org'    => 'Creatifla Multimedia, Pekalongan',
            'period' => '20 Januari – 28 Februari 2025',
            'points' => [
                'Merancang basis data dan membangun Sistem Manajemen Pelanggan, mencakup pencatatan data pelanggan, laporan proyek, dan dashboard statistik.',
                'Mengintegrasikan WhatsApp Blast API untuk mengotomatiskan pengiriman promosi.',
            ],
            'tags'   => ['PHP', 'MySQL', 'WhatsApp Blast API'],
            'links'  => [],
            'photos' => [
                ['images/experiences/creatifla-multimedia/dashboard-pelanggan.jpg', 'Dashboard Sistem Manajemen Pelanggan: data pelanggan, laporan, dan promo (data contoh)'],
                ['images/experiences/creatifla-multimedia/laporan-project.jpg', 'Daftar laporan project dengan filter bulan dan tahun serta cetak PDF (data contoh)'],
                ['images/experiences/creatifla-multimedia/bersama-rekan.jpg', 'Bersama rekan di lokasi magang'],
                ['images/experiences/creatifla-multimedia/pengembangan-sistem-1.jpg', 'Mengerjakan pengembangan sistem selama magang'],
                ['images/experiences/creatifla-multimedia/pengembangan-sistem-2.jpg', 'Mengerjakan pengembangan sistem selama magang'],
            ],
        ],
        [
            'role'   => 'Anggota Tim Pengembang & Pendamping Mitra',
            'org'    => 'Program PKM ITSNU Pekalongan · Mitra: Pokdarwis Lolong Adventure',
            'period' => 'Maret – Agustus 2025',
            'points' => [
                'Membangun sistem pemesanan tiket wisata berbasis web bersama tim dua orang, dari identifikasi kebutuhan mitra hingga siap digunakan.',
                'Merancang skema basis data dan alur pemesanan (booking) sebagai fondasi sistem.',
                'Mendampingi pelatihan penggunaan sistem bagi 20 anggota Pokdarwis pada 11 Agustus 2025; seluruh peserta menilai kegiatan sesuai kebutuhan.',
                'Terlibat dalam monitoring dan evaluasi hibah PKM di lokasi mitra (8 Oktober 2025) serta penulisan artikel Jurnal SOLMA 2026.',
            ],
            'tags'   => ['PHP', 'MySQL', 'Perancangan Database', 'Pendampingan Pengguna'],
            'links'  => [
                ['Lihat Sistem', 'https://tiketlolongadventure.com'],
                ['Baca Publikasi', 'https://doi.org/10.22236/solma.v15i1.20925'],
            ],
            'photos' => [
                ['images/projects/sistem-tiket-lolong-adventure/kegiatan-pelatihan.jpg', 'Kegiatan pelatihan program PKM bersama Pokdarwis Lolong Adventure'],
                ['images/projects/sistem-tiket-lolong-adventure/kegiatan-tim-pkm.jpg', 'Foto bersama tim PKM dan mitra di depan banner program'],
                ['images/projects/sistem-tiket-lolong-adventure/kegiatan-lokasi-mitra.jpg', 'Tim di lokasi wisata Lolong Adventure'],
            ],
        ],
        [
            // [isi] = data yang belum ada di CV: lokasi, periode, dan tugas humas sebenarnya
            'role'   => 'Anggota KKN · Bidang Humas',
            'org'    => 'Kuliah Kerja Nyata (KKN) ITSNU Pekalongan · [isi lokasi KKN]',
            'period' => '[isi periode KKN]',
            'points' => [
                'Mengelola publikasi dan dokumentasi kegiatan KKN melalui media sosial dan kanal informasi.',
                'Menjalin komunikasi dengan perangkat desa, mitra, dan warga selama pelaksanaan program kerja.',
                'Menyusun materi informasi serta laporan kehumasan untuk kegiatan KKN.',
            ],
            'tags'   => ['Publikasi', 'Dokumentasi', 'Komunikasi'],
            'links'  => [],
            'photos' => [
                ['images/activities/kkn/foto-bersama-1.jpg', 'Foto bersama peserta kegiatan KKN'],
                ['images/activities/kkn/foto-bersama-2.jpg', 'Foto bersama peserta kegiatan KKN'],
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Kegiatan & kepanitiaan
    | Format: [judul, penyelenggara, waktu, keterangan, foto (opsional, null)]
    |--------------------------------------------------------------------------
    */

        'activities' => [
        [
            'Peserta LKMM-TD (Latihan Keterampilan Manajemen Mahasiswa Tingkat Dasar)',
            'HIMATIF ITSNU Pekalongan',
            '11 Desember 2022',
            'Pelatihan dasar manajemen dan kepemimpinan organisasi mahasiswa.',
            [['images/activities/kegiatan/lkmm.png', 'Foto bersama peserta LKMM-TD HIMATIF ITSNU Pekalongan']],
        ],
        [
            'Panitia Workshop Pemrograman “Unlock Your Digital Potential with HTML and CSS”',
            'HIMATIF ITSNU Pekalongan bersama HAN Creative Media',
            'Mei 2025',
            'Terlibat dalam persiapan dan pelaksanaan acara.',
            [['images/activities/kegiatan/workshop.png', 'Pelaksanaan Workshop Pemrograman HTML dan CSS']],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Halaman dokumentasi
    | Format: [kategori, judul, keterangan, waktu, file]
    |--------------------------------------------------------------------------
    */

    'gallery' => [
        ['Magang', 'Magang di Creatifla Multimedia', 'Pengembangan Sistem Manajemen Pelanggan dan integrasi WhatsApp Blast API.', 'Januari – Februari 2025', 'images/dokumentasi/magang-creatifla.jpg'],
        ['PKM', 'Pelatihan penggunaan sistem', 'Pendampingan pelatihan bagi 20 anggota Pokdarwis Lolong Adventure.', '11 Agustus 2025', 'images/dokumentasi/pkm-pelatihan.jpg'],
        ['PKM', 'Monitoring dan evaluasi hibah PKM', 'Kegiatan monev di lokasi mitra.', '8 Oktober 2025', 'images/dokumentasi/pkm-monev.jpg'],
        ['PKM', 'Sistem pemesanan tiket', 'Tampilan sistem yang digunakan untuk transaksi nyata.', '2025', 'images/dokumentasi/pkm-sistem.jpg'],
        ['Kegiatan', 'Panitia Workshop Pemrograman', 'Workshop HTML dan CSS oleh HIMATIF ITSNU bersama HAN Creative Media.', 'Mei 2025', 'images/dokumentasi/panitia-workshop.jpg'],
    ],

    /*
    |--------------------------------------------------------------------------
    | Sertifikat & pelatihan
    | Field: title, issuer, date, note (null jika kosong), desc (keterangan, boleh berisi baris baru), image, url (null jika tidak ada)
    |--------------------------------------------------------------------------
    */

    'certificates' => [
        [
            'title'    => 'Sertifikat Kompetensi Junior Web Programmer',
            'issuer'   => 'BNSP · LSP TIKOM',
            'date'     => 'Terbit 18 September 2026',
            'note'     => 'Berlaku hingga 18 September 2029',
            'desc'   => 'Sertifikat kompetensi dari Badan Nasional Sertifikasi Profesi (BNSP) yang diterbitkan melalui LSP TIKOM, sebagai pengakuan kompetensi kerja Junior Web Programmer.',
            'image'  => 'images/certificates/sertifikat-bnsp.png',
            'url'    => null,
        ],
        [
            'title'    => 'Belajar Dasar AI',
            'issuer'   => 'Dicoding Indonesia',
            'date'     => '30 September 2025',
            'note'     => 'ID Sertifikat: KEXL289L0ZG2 · berlaku hingga 30 September 2028',
            'desc'   => "Kelas dasar untuk pemula yang ingin memulai karier di bidang AI, berdurasi total 10 jam dan diakhiri ujian akhir kelas. Cakupan materi:\n• Konsep dasar Artificial Intelligence (1 jam 30 menit)\n• Peran data dalam pengembangan AI (1 jam 25 menit)\n• Dasar Machine Learning dan contoh penerapannya (2 jam 30 menit)\n• Konsep Deep Learning dan implementasi contohnya (2 jam 25 menit)\n\nMenjadi landasan literasi AI yang saya cantumkan pada keahlian pendukung.",
            'image'  => 'images/certificates/dicoding-belajar-dasar-ai.png',
            'url'    => 'https://www.dicoding.com/certificates/KEXL289L0ZG2',
        ],
        [
            'title'    => 'Workshop UI/UX Design “Explore the Basic for Innovative Design”',
            'issuer'   => 'HMPS Informatika UIN K.H. Abdurrahman Wahid Pekalongan',
            'date'     => '29 Mei 2025',
            'note'     => null,
            'desc'   => 'Workshop dasar perancangan antarmuka dan pengalaman pengguna (UI/UX), relevan dengan keterampilan desain UI/UX pada daftar keahlian saya.',
            'image'  => 'images/certificates/workshop-uiux.png',
            'url'    => null,
        ],
        [
            'title'    => 'Kuliah Umum “Cybersecurity Risk Management in the Digital Era”',
            'issuer'   => 'ITSNU Pekalongan',
            'date'     => '30 Oktober 2025',
            'note'     => 'No. 011/Sertifikat/ITSNU/X/2025',
            'desc'   => 'Kuliah umum tentang pengelolaan risiko keamanan siber di era digital, relevan dengan praktik keamanan dalam pengembangan sistem informasi.',
            'image'  => 'images/certificates/kuliah-umum-cybersecurity.png',
            'url'    => null,
        ],
        [
            'title'    => 'Seminar Technopreneurship “Go Fast Unlock Your Business Power with AI”',
            'issuer'   => 'ITSNU Pekalongan',
            'date'     => '4 Desember 2025',
            'note'     => null,
            'desc'   => 'Seminar technopreneurship tentang pemanfaatan AI untuk mengembangkan bisnis, diselenggarakan oleh ITSNU Pekalongan.',
            'image'  => 'images/certificates/seminar-technopreneurship.png',
            'url'    => null,
        ],
        [
            'title'    => 'Seminar Entrepreneur “From Lokal to Global”',
            'issuer'   => 'BEM-F Saintek ITSNU',
            'date'     => '11 Juni 2025',
            'note'     => null,
            'desc'   => 'Seminar kewirausahaan tentang strategi membawa produk lokal menembus pasar melalui pemanfaatan teknologi digital, diselenggarakan oleh BEM-F Saintek ITSNU.',
            'image'  => 'images/certificates/seminar-entrepreneur.png',
            'url'    => null,
        ],
        [
            'title'    => 'Webinar Karir “From Campus to Career”',
            'issuer'   => 'BEM ITSNU Pekalongan',
            'date'     => '30 Mei 2025',
            'note'     => null,
            'desc'   => 'Webinar karier untuk mahasiswa dan lulusan yang diselenggarakan oleh BEM ITSNU Pekalongan.',
            'image'  => 'images/certificates/webinar-karir.png',
            'url'    => null,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Kekayaan intelektual & publikasi
    | Format: [jenis, judul, nomor/tanggal, status, url (null jika tidak ada)]
    |--------------------------------------------------------------------------
    */

    'ip' => [
        ['Hak Cipta Program Komputer', 'Sistem Informasi Manajemen Posyandu Berbasis Web Menggunakan Framework Laravel dan MySQL', 'No. Pencatatan 001576590 · Diumumkan 25 Juli 2026', 'Surat Pencatatan Ciptaan, Kementerian Hukum RI (pencipta bersama tim)', null],
        ['Hak Cipta Program Komputer', 'Software Sistem Pemesanan Tiket Paket Wisata Lolong Adventure Menggunakan PHP dan MySQL', 'No. Pencatatan 001071237 · Diumumkan 28 November 2025', 'Surat Pencatatan Ciptaan, Kementerian Hukum RI (pencipta bersama tim)', null],
        ['Publikasi Ilmiah', 'Pendampingan dan Penyuluhan Penggunaan Sistem Smart Village untuk Digitalisasi Pelayanan Wisata Lolong Adventure', 'Jurnal SOLMA 15(1): 2208–2220 · 30 Maret 2026 · ISSN 2614-1531', 'Penulis (anggota tim)', 'https://doi.org/10.22236/solma.v15i1.20925'],
    ],

    /*
    |--------------------------------------------------------------------------
    | Proyek
    | Isi 'tech' SapiSehat dan Website Desa dengan teknologi sebenarnya bila sudah diketahui.
    |--------------------------------------------------------------------------
    */

    'projects' => [
        [
            'slug'     => 'sistem-tiket-lolong-adventure',
            'title'    => 'Sistem Pemesanan Tiket Paket Wisata Lolong Adventure',
            'category' => 'Sistem Informasi Pariwisata',
            'status'   => 'Digunakan untuk transaksi nyata',
            'role'     => 'Anggota tim pengembang (tim 2 orang) & pendamping mitra',
            'period'   => 'Mar – Agu 2025',
            'summary'  => 'Sistem pemesanan tiket wisata berbasis web untuk Pokdarwis Lolong Adventure. Dikembangkan pada program PKM ITSNU Pekalongan dan dipakai untuk transaksi nyata.',
            'cover'    => 'images/projects/sistem-tiket-lolong-adventure/lolong.png',
            'live'     => 'https://tiketlolongadventure.com',
            'tech'     => ['PHP', 'MySQL'],
            'links'    => [
                ['Surat Pencatatan Hak Cipta (PDF)', '/documents/hak-cipta/hak-cipta-tiket-lolong.pdf'],
                ['Baca Publikasi (Jurnal SOLMA)', 'https://doi.org/10.22236/solma.v15i1.20925'],
            ],
            'overview' => 'Sistem pemesanan tiket wisata berbasis web yang dibangun pada program PKM ITSNU Pekalongan (Hibah DPPM Kemdiktisaintek 2025) bersama Pokdarwis Lolong Adventure. Sistem digunakan untuk transaksi nyata dan tercatat sebagai Hak Cipta Program Komputer (No. 001071237).',
            'work'     => [
                'Mengidentifikasi kebutuhan mitra bersama tim pengembang beranggotakan 2 orang.',
                'Merancang skema basis data dan alur pemesanan (booking) sebagai fondasi sistem.',
                'Membangun sistem pemesanan tiket berbasis web hingga digunakan untuk transaksi nyata.',
                'Mendampingi pelatihan penggunaan sistem pada 11 Agustus 2025 bagi 20 anggota Pokdarwis.',
            ],
            'results'  => [
                'Digunakan untuk transaksi nyata di tiketlolongadventure.com.',
                'Tercatat sebagai Hak Cipta Program Komputer (No. 001071237).',
                'Seluruh peserta pelatihan (100%) menilai kegiatan sesuai kebutuhan (56% sangat setuju, 44% setuju).',
                'Digitalisasi 100% data wisatawan dan peningkatan efisiensi pengelolaan hingga 60% (Jurnal SOLMA, 2026).',
            ],
            'features' => [
                'Pemesanan tiket paket wisata berbasis web',
                'Pembayaran melalui virtual account dengan batas waktu pembayaran',
                'E-ticket otomatis dengan kode booking',
                'Riwayat pemesanan dengan filter status dan tanggal',
                'Dashboard admin: pendapatan harian, mingguan, dan bulanan',
                'Manajemen destinasi, pemesanan, dan pelanggan',
            ],
            'modules' => [
                ['Pengunjung', 'Memesan tiket, membayar, dan memantau pesanannya.', ['Pilih destinasi dan paket', 'Pembayaran virtual account', 'Riwayat pemesanan', 'E-ticket']],
                ['Admin', 'Mengelola operasional wisata dari satu panel.', ['Dashboard pendapatan', 'Kelola destinasi', 'Kelola pemesanan', 'Manajemen pelanggan', 'Kirim pesan massal']],
            ],
            'gallery' => [
                ['images/projects/sistem-tiket-lolong-adventure/lolong.png', 'Dashboard admin: pendapatan harian, mingguan, bulanan, dan pemesanan terbaru'],
                ['images/projects/sistem-tiket-lolong-adventure/admin-destinasi.jpg', 'Kelola destinasi wisata beserta harga dan status'],
                ['images/projects/sistem-tiket-lolong-adventure/admin-pemesanan.jpg', 'Kelola pemesanan dengan filter destinasi, pelanggan, dan status pembayaran'],
                ['images/projects/sistem-tiket-lolong-adventure/admin-pelanggan.jpg', 'Manajemen pelanggan beserta status pemesanannya (kontak disamarkan)'],
                ['images/projects/sistem-tiket-lolong-adventure/riwayat-pemesanan.jpg', 'Riwayat pemesanan pengunjung dengan filter status dan tanggal'],
                ['images/projects/sistem-tiket-lolong-adventure/pembayaran-virtual-account.jpg', 'Pilihan pembayaran melalui virtual account'],
                ['images/projects/sistem-tiket-lolong-adventure/e-ticket.jpg', 'E-ticket dengan kode booking dan rincian pemesan'],
                ['images/projects/sistem-tiket-lolong-adventure/kegiatan-pelatihan.jpg', 'Kegiatan pelatihan program PKM bersama Pokdarwis Lolong Adventure'],
                ['images/projects/sistem-tiket-lolong-adventure/kegiatan-tim-pkm.jpg', 'Foto bersama tim PKM dan mitra di depan banner program (Hibah DPPM Kemdiktisaintek 2025)'],
                ['images/projects/sistem-tiket-lolong-adventure/kegiatan-lokasi-mitra.jpg', 'Tim di lokasi wisata Lolong Adventure'],
            ],
        ],
        [
            'slug'     => 'sim-posyanducare',
            'title'    => 'SIM PosyanduCare',
            'category' => 'Sistem Informasi Kesehatan · Skripsi',
            'status'   => 'Selesai · Hasil skripsi',
            'role'     => 'Perancang & pengembang',
            'period'   => '2026',
            'summary'  => 'Sistem informasi manajemen Posyandu berbasis web untuk Desa Bantarkulon yang menggantikan pencatatan manual, dengan kelayakan 84,28% (“Sangat Layak”) pada UAT.',
            'cover'    => 'images/projects/sim-posyanducare/dashboard-admin.jpg',
            'live'     => 'https://sim-posyanducare.vercel.app',
            'tech'     => ['PHP', 'Laravel', 'MySQL'],
            'links'    => [
                ['Surat Pencatatan Hak Cipta (PDF)', '/documents/hak-cipta/hak-cipta-posyandu.pdf'],
            ],
            'results'  => [
                'Seluruh skenario fungsional valid pada Black Box Testing.',
                'Tingkat kelayakan 84,28% (“Sangat Layak”) pada User Acceptance Testing.',
                'Tercatat sebagai Hak Cipta Program Komputer (No. 001576590), diumumkan 25 Juli 2026.',
            ],
            'overview' => 'Pencatatan manual di Posyandu menyulitkan administrasi kesehatan Balita, Remaja, dan Lansia serta penelusuran riwayatnya. SIM PosyanduCare saya rancang dengan metode Rapid Application Development (RAD) sebagai skripsi: “Implementasi Metode RAD dalam Rancang Bangun Sistem Informasi Manajemen Posyandu (Studi Kasus: Desa Bantarkulon)”, 2026.',
            'work' => [
                'Menganalisis kebutuhan dan merancang sistem dengan metode RAD.',
                'Merancang basis data terpadu yang mengintegrasikan pencatatan sasaran Balita, Remaja, dan Lansia.',
                'Menerapkan Role-Based Access Control (RBAC) untuk peran Admin, Bidan, Kader, dan Warga.',
                'Membangun dashboard per peran dan laporan operasional yang dapat dicetak.',
                'Menguji sistem dengan Black Box Testing dan User Acceptance Testing (UAT) bersama kader dan warga di Desa Bantarkulon.',
            ],
            'features' => [
                'Administrasi kesehatan Balita, Remaja, dan Lansia dalam satu basis data',
                'Pencatatan kehadiran sasaran per tanggal',
                'Buku kunjungan, pengukuran fisik, dan log imunisasi',
                'Penelusuran riwayat kesehatan',
                'Laporan operasional otomatis yang siap dicetak',
                'Hak akses berbasis peran: Admin, Bidan, Kader, Warga',
            ],
            'modules' => [
                ['Administrator', 'Mengelola akun dan hak akses pengguna.', ['Kelola warga', 'Kelola bidan', 'Kelola kader', 'Statistik pengguna dan demografi']],
                ['Kader', 'Mencatat pelayanan Posyandu pada hari kegiatan.', ['Registrasi hadir', 'Buku kunjungan', 'Pengukuran fisik', 'Log imunisasi', 'Data pasien', 'Agenda Posyandu']],
            ],
            'gallery' => [
                ['images/projects/sim-posyanducare/dashboard-admin.jpg', 'Dashboard administrator: statistik akun warga, kader, bidan, dan total sasaran'],
                ['images/projects/sim-posyanducare/dashboard-kader.jpg', 'Dashboard kader: ringkasan kehadiran dan jadwal Posyandu hari ini'],
                ['images/projects/sim-posyanducare/presensi-sasaran.jpg', 'Pencatatan kehadiran sasaran Balita, Remaja, dan Lansia per tanggal (NIK disamarkan)'],
                ['images/projects/sim-posyanducare/laporan-pemeriksaan-lansia.jpg', 'Laporan pemeriksaan lansia yang dihasilkan otomatis dan siap dicetak (nama disamarkan)'],
                ['images/projects/sim-posyanducare/kegiatan-pengujian-uat.jpg', 'Pengujian UAT bersama kader dan warga di Desa Bantarkulon: pengisian formulir penilaian'],
                ['images/projects/sim-posyanducare/kegiatan-kader-memakai-sistem.jpg', 'Kader mengoperasikan sistem saat kegiatan Posyandu'],
            ],
        ],
        [
            'slug'     => 'sapisehat-sistem-pakar',
            'title'    => 'SapiSehat: Sistem Pakar Diagnosis Penyakit Sapi',
            'category' => 'Sistem Pakar',
            'status'   => 'Selesai · Dapat diakses publik',
            'role'     => 'Perancang & pengembang',
            'period'   => null,
            'summary'  => 'Aplikasi web sistem pakar yang menampilkan kemungkinan penyakit sapi beserta rekomendasi penanganannya berdasarkan gejala yang dipilih pengguna.',
            'cover'    => 'images/projects/sapisehat-sistem-pakar/beranda.jpg',
            'live'     => 'https://sistem-diagnosis-sapi.vercel.app',
            'tech'     => [],
            'links'    => [],
            'overview' => 'SapiSehat adalah sistem pakar berbasis web yang menggunakan metode Certainty Factor untuk membantu mengenali kemungkinan penyakit pada sapi Simmental. Pengguna memilih gejala yang teramati, lalu sistem menampilkan peringkat kemungkinan penyakit beserta tingkat keyakinan dan rekomendasi penanganannya.',
            'work' => [
                'Merancang alur diagnosis: pengguna memilih gejala, sistem menghitung dan menampilkan kemungkinan penyakit.',
                'Menerapkan metode Certainty Factor untuk menghitung tingkat keyakinan setiap penyakit.',
                'Menyusun rekomendasi penanganan untuk setiap penyakit.',
                'Membangun panel admin untuk mengelola penyakit, gejala, aturan, dan laporan.',
                'Mempublikasikan aplikasi agar dapat diakses secara daring.',
            ],
            'features' => [
                'Diagnosis berdasarkan gejala yang dipilih pengguna',
                'Perhitungan Certainty Factor beserta tingkat keyakinan',
                'Peringkat kemungkinan penyakit dan rekomendasi penanganan',
                'Riwayat diagnosis dengan pencarian dan filter',
                'Laporan diagnosis yang dapat diunduh sebagai PDF',
                'Panel admin untuk mengelola penyakit, gejala, dan aturan',
            ],
            'modules' => [
                ['Pengguna', 'Melakukan diagnosis dan melihat hasilnya.', ['Pilih gejala', 'Hasil dan tingkat keyakinan', 'Analisis Certainty Factor', 'Riwayat diagnosis', 'Unduh PDF']],
                ['Admin', 'Mengelola basis pengetahuan dan memantau penggunaan.', ['Kelola penyakit', 'Kelola gejala', 'Kelola aturan', 'Data diagnosis', 'Laporan dan statistik', 'Manajemen user']],
            ],
            'gallery' => [
                ['images/projects/sapisehat-sistem-pakar/beranda.jpg', 'Beranda SapiSehat: diagnosis penyakit sapi dengan metode Certainty Factor'],
                ['images/projects/sapisehat-sistem-pakar/hasil-diagnosis.jpg', 'Hasil diagnosis: penyakit utama dan tingkat keyakinan'],
                ['images/projects/sapisehat-sistem-pakar/analisis-certainty-factor.jpg', 'Analisis detail Certainty Factor: peringkat kemungkinan penyakit'],
                ['images/projects/sapisehat-sistem-pakar/detail-diagnosis.jpg', 'Detail diagnosis: informasi penyakit, gejala terpilih, dan rekomendasi penanganan'],
                ['images/projects/sapisehat-sistem-pakar/riwayat-diagnosis.jpg', 'Riwayat diagnosis beserta status dan tingkat keyakinan'],
                ['images/projects/sapisehat-sistem-pakar/laporan-pdf.jpg', 'Laporan diagnosis dalam format PDF'],
                ['images/projects/sapisehat-sistem-pakar/lolong.png', 'Dashboard admin: jumlah penyakit, gejala, dan total diagnosis'],
                ['images/projects/sapisehat-sistem-pakar/admin-laporan.jpg', 'Laporan sistem: tren diagnosis dan distribusi penyakit'],
            ],
        ],
        [
            'slug'     => 'website-desa-windujaji',
            'title'    => 'Website Desa Windujaji',
            'category' => 'Website Profil Desa',
            'status'   => 'Selesai · Dapat diakses publik',
            'role'     => 'Perancang & pengembang',
            'period'   => null,
            'summary'  => 'Website desa yang memuat profil, data kependudukan, UMKM, berita, dan galeri kegiatan.',
            'cover'    => 'images/projects/website-desa-windujaji/beranda.jpg',
            'live'     => 'https://desa-windujaji.vercel.app',
            'tech'     => [],
            'links'    => [],
            'overview' => 'Website ini menjadi etalase digital Desa Windujaji. Profil desa, data kependudukan, produk UMKM warga, berita, dan galeri kegiatan terkumpul dalam satu situs yang mudah diakses.',
            'work' => [
                'Merancang struktur informasi dan halaman situs desa.',
                'Membangun panel admin untuk mengelola berita, UMKM, galeri, dan data kependudukan.',
                'Menyediakan impor dan ekspor data kependudukan dalam format CSV.',
                'Mempublikasikan website agar dapat diakses secara daring.',
            ],
            'features' => [
                'Profil desa dan statistik kependudukan di beranda',
                'Berita desa dengan kategori',
                'Direktori UMKM lengkap dengan produk, pemilik, lokasi, dan harga',
                'Galeri kegiatan desa',
                'Panel admin untuk mengelola konten tanpa menyentuh kode',
                'Impor dan ekspor data kependudukan melalui CSV',
            ],
            'modules' => [
                ['Pengunjung', 'Membaca informasi desa secara terbuka.', ['Profil desa', 'Berita', 'UMKM', 'Galeri', 'Statistik kependudukan']],
                ['Admin', 'Mengelola konten dan data desa dari satu panel.', ['Dashboard ringkasan', 'Profil desa', 'Data kependudukan', 'Berita', 'UMKM', 'Galeri']],
            ],
            'gallery' => [
                ['images/projects/website-desa-windujaji/beranda.jpg', 'Beranda website resmi Desa Windujaji'],
                ['images/projects/website-desa-windujaji/lolong.png', 'Dashboard admin: ringkasan berita, UMKM, dan galeri'],
                ['images/projects/website-desa-windujaji/admin-kependudukan.jpg', 'Data kependudukan dengan fitur impor dan ekspor CSV'],
                ['images/projects/website-desa-windujaji/admin-umkm.jpg', 'Pengelolaan daftar UMKM desa beserta produk dan harga'],
            ],
        ],
    ],
];