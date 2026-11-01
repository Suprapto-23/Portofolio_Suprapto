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
            null,
        ],
        [
            'Panitia Workshop Pemrograman “Unlock Your Digital Potential with HTML and CSS”',
            'HIMATIF ITSNU Pekalongan bersama HAN Creative Media',
            'Mei 2025',
            'Terlibat dalam persiapan dan pelaksanaan acara.',
            'images/dokumentasi/panitia-workshop.jpg',
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
    | Field: title, issuer, date, note (null jika kosong), image, url (null jika tidak ada)
    |--------------------------------------------------------------------------
    */

    'certificates' => [
        ['title' => 'Sertifikat Kompetensi Junior Web Programmer', 'issuer' => 'BNSP · LSP TIKOM', 'date' => 'Terbit 18 September 2026', 'note' => 'Berlaku hingga 18 September 2029', 'image' => 'images/certificates/bnsp-junior-web-programmer.png', 'url' => null],
        ['title' => 'Belajar Dasar AI', 'issuer' => 'Dicoding Indonesia', 'date' => '30 September 2025', 'note' => 'ID Sertifikat: KEXL289L0ZG2 · berlaku hingga 30 September 2028', 'image' => 'images/certificates/dicoding-belajar-dasar-ai.png', 'url' => 'https://www.dicoding.com/certificates/KEXL289L0ZG2'],
        ['title' => 'Pelatihan Desain Grafis', 'issuer' => 'BLKK PC GP Ansor', 'date' => 'Agustus – September 2023', 'note' => null, 'image' => 'images/certificates/pelatihan-desain-grafis.png', 'url' => null],
        ['title' => 'Workshop UI/UX Design “Explore the Basic for Innovative Design”', 'issuer' => 'HMPS Informatika UIN K.H. Abdurrahman Wahid Pekalongan', 'date' => '29 Mei 2025', 'note' => null, 'image' => 'images/certificates/workshop-uiux.png', 'url' => null],
        ['title' => 'Kuliah Umum “Cybersecurity Risk Management in the Digital Era”', 'issuer' => 'ITSNU Pekalongan', 'date' => '30 Oktober 2025', 'note' => 'No. 011/Sertifikat/ITSNU/X/2025', 'image' => 'images/certificates/kuliah-umum-cybersecurity.png', 'url' => null],
        ['title' => 'Seminar Technopreneurship “Go Fast Unlock Your Business Power with AI”', 'issuer' => 'ITSNU Pekalongan', 'date' => '4 Desember 2025', 'note' => null, 'image' => 'images/certificates/seminar-technopreneurship.png', 'url' => null],
        ['title' => 'Seminar Entrepreneur “From Lokal to Global”', 'issuer' => 'BEM-F Saintek ITSNU', 'date' => '11 Juni 2025', 'note' => null, 'image' => 'images/certificates/seminar-entrepreneur.png', 'url' => null],
        ['title' => 'Webinar Karir “From Campus to Career”', 'issuer' => 'BEM ITSNU Pekalongan', 'date' => '30 Mei 2025', 'note' => null, 'image' => 'images/certificates/webinar-karir.png', 'url' => null],
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
            'overview' => 'Sistem ini lahir dari program PKM Pengabdian Masyarakat ITSNU Pekalongan (Hibah DPPM Kemdiktisaintek 2025) bersama mitra Pokdarwis Lolong Adventure. Tujuannya mendigitalkan layanan wisata, mulai dari pemesanan paket hingga pencatatan data wisatawan, agar pengelolaan lebih rapi dan efisien.',
            'work'     => [
                'Mengidentifikasi kebutuhan mitra dan menerjemahkannya menjadi fitur sistem.',
                'Merancang skema database dan alur pemesanan (booking) yang menjadi fondasi sistem.',
                'Membangun sistem web bersama tim pengembang beranggotakan 2 orang hingga siap dipakai untuk transaksi nyata.',
                'Mendampingi pelatihan penggunaan sistem bagi 20 anggota Pokdarwis pada 11 Agustus 2025.',
                'Terlibat dalam monitoring dan evaluasi hibah PKM 2025 di lokasi mitra pada 8 Oktober 2025.',
            ],
            'features' => [
                'Pemesanan tiket paket wisata berbasis web',
                'Alur pemesanan (booking) yang terstruktur',
                'Pencatatan data wisatawan secara digital',
            ],
            'results'  => [
                'Dipakai untuk transaksi nyata oleh mitra.',
                'Digitalisasi 100% data wisatawan dan peningkatan efisiensi pengelolaan hingga 60% (Jurnal SOLMA 15(1), 2026).',
                '100% peserta pelatihan menilai kegiatan sesuai kebutuhan (56% sangat setuju, 44% setuju).',
                'Tercatat sebagai Hak Cipta Program Komputer No. 001071237 (diumumkan 28 November 2025).',
                'Program PKM memperoleh Nilai A.',
            ],
            'tech'     => ['PHP', 'MySQL'],
            'live'     => 'https://tiketlolongadventure.com',
            'links'    => [['Baca Publikasi Jurnal', 'https://doi.org/10.22236/solma.v15i1.20925']],
            'cover'    => 'images/project-ticket.png',
            'gallery'  => [
                ['images/projects/sistem-tiket-lolong-adventure/dokumentasi-1.png', 'Halaman utama dan pilihan paket wisata'],
                ['images/projects/sistem-tiket-lolong-adventure/dokumentasi-2.png', 'Alur pemesanan tiket'],
                ['images/projects/sistem-tiket-lolong-adventure/dokumentasi-3.png', 'Pelatihan penggunaan sistem bersama Pokdarwis (11 Agustus 2025)'],
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
            'overview' => 'Pencatatan manual di Posyandu menyulitkan administrasi kesehatan Balita, Remaja, dan Lansia serta penelusuran riwayatnya. SIM PosyanduCare saya rancang dengan metode Rapid Application Development (RAD) sebagai skripsi: “Implementasi Metode RAD dalam Rancang Bangun Sistem Informasi Manajemen Posyandu (Studi Kasus: Desa Bantarkulon)”, 2026.',
            'work'     => [
                'Menganalisis kebutuhan dan merancang sistem dengan metode RAD.',
                'Merancang basis data terpadu yang mengintegrasikan pencatatan sasaran Balita, Remaja, dan Lansia.',
                'Menerapkan Role-Based Access Control (RBAC) untuk peran Admin, Bidan, Kader, dan Warga.',
                'Menguji sistem dengan Black Box Testing dan User Acceptance Testing (UAT).',
            ],
            'features' => [
                'Administrasi kesehatan Balita, Remaja, dan Lansia dalam satu basis data',
                'Penelusuran riwayat kesehatan',
                'Laporan operasional otomatis',
                'Hak akses berbasis peran: Admin, Bidan, Kader, Warga',
            ],
            'results'  => [
                'Seluruh skenario fungsional valid pada Black Box Testing.',
                'Tingkat kelayakan 84,28% (“Sangat Layak”) pada User Acceptance Testing.',
                'Tercatat sebagai Hak Cipta Program Komputer No. 001576590 (diumumkan 25 Juli 2026).',
            ],
            'tech'     => ['Laravel', 'PHP', 'MySQL'],
            'live'     => 'https://sim-posyanducare.vercel.app',
            'links'    => [],
            'cover'    => 'images/project-posyandu.png',
            'gallery'  => [
                ['images/projects/sim-posyanducare/dokumentasi-1.png', 'Dashboard sistem'],
                ['images/projects/sim-posyanducare/dokumentasi-2.png', 'Pencatatan data Balita, Remaja, dan Lansia'],
                ['images/projects/sim-posyanducare/dokumentasi-3.png', 'Laporan operasional Posyandu'],
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
            'overview' => 'SapiSehat membantu pengguna mengenali kemungkinan penyakit pada sapi hanya dengan memilih gejala yang teramati. Sistem mencocokkan gejala tersebut dengan data penyakit, lalu menampilkan kemungkinan penyakit beserta rekomendasi penanganannya.',
            'work'     => [
                'Merancang alur diagnosis: pengguna memilih gejala, sistem menampilkan kemungkinan penyakit.',
                'Menyusun rekomendasi penanganan untuk setiap penyakit yang dapat teridentifikasi.',
                'Membangun dan mempublikasikan aplikasi agar dapat diakses secara daring.',
            ],
            'features' => [
                'Pemilihan gejala oleh pengguna',
                'Hasil berupa kemungkinan penyakit',
                'Rekomendasi penanganan untuk setiap penyakit',
            ],
            'results'  => ['Dapat diakses publik secara daring melalui sistem-diagnosis-sapi.vercel.app.'],
            // TODO: isi 'tech' dengan teknologi yang dipakai (mis. ['Laravel', 'MySQL']).
            'tech'     => ['Sistem Pakar', 'Aplikasi Web'],
            'live'     => 'https://sistem-diagnosis-sapi.vercel.app',
            'links'    => [],
            'cover'    => 'images/project-sapi.png',
            'gallery'  => [
                ['images/projects/sapisehat-sistem-pakar/dokumentasi-1.png', 'Halaman pemilihan gejala'],
                ['images/projects/sapisehat-sistem-pakar/dokumentasi-2.png', 'Hasil diagnosis'],
                ['images/projects/sapisehat-sistem-pakar/dokumentasi-3.png', 'Rekomendasi penanganan'],
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
            'overview' => 'Website ini menjadi etalase digital Desa Windujaji. Profil desa, data kependudukan, produk UMKM warga, berita, dan galeri kegiatan terkumpul dalam satu situs yang mudah diakses.',
            'work'     => [
                'Merancang struktur informasi dan halaman situs desa.',
                'Membangun dan mempublikasikan website agar dapat diakses secara daring.',
            ],
            'features' => ['Profil desa', 'Data kependudukan', 'Direktori UMKM', 'Berita desa', 'Galeri kegiatan'],
            'results'  => ['Dapat diakses publik secara daring melalui desa-windujaji.vercel.app.'],
            // TODO: isi 'tech' dengan teknologi yang dipakai.
            'tech'     => ['Aplikasi Web'],
            'live'     => 'https://desa-windujaji.vercel.app',
            'links'    => [],
            'cover'    => 'images/projects/website-desa-windujaji/cover.png',
            'gallery'  => [
                ['images/projects/website-desa-windujaji/dokumentasi-1.png', 'Beranda dan profil desa'],
                ['images/projects/website-desa-windujaji/dokumentasi-2.png', 'Data kependudukan dan UMKM'],
                ['images/projects/website-desa-windujaji/dokumentasi-3.png', 'Berita dan galeri'],
            ],
        ],
    ],
];