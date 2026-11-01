<?php

/*
|--------------------------------------------------------------------------
| Pengaturan tambahan portofolio  (config/portfolio_site.php)
|--------------------------------------------------------------------------
| Data utama (proyek, pengalaman, sertifikat, hak cipta) tetap di config/portfolio.php.
| File ini berisi hal-hal yang sering diganti: GAMBAR, CV, tautan, ringkasan skripsi, dan keahlian.
|
| CARA MENGGANTI GAMBAR
|   Setiap kunci gambar berisi daftar path (relatif terhadap folder public/).
|   Gambar pertama yang ADA di disk akan dipakai. Cukup timpa file dengan nama yang sama,
|   atau tambahkan path baru di urutan paling atas. Setelah mengubah config: php artisan config:clear
*/

return [

    'images' => [
        // Foto utama: dipakai di beranda dan halaman profil
        'profile'     => ['images/profile.jpg', 'images/profile.jpeg', 'images/profile.png', 'images/profil.png', 'profile.png'],
        // Foto tambahan (opsional) di beranda
        'about_photo' => ['images/about.jpg', 'images/about.jpeg'],
    ],

    // Foto pada kartu Pendidikan di halaman profil: [path, keterangan]. Boleh ditambah.
    'education_photos' => [
        ['images/profil.png', 'Dokumentasi kelulusan'],
        // ['images/sidang-skripsi.jpg', 'Sidang skripsi'],
    ],

    // Letakkan file CV di public/files/. Tombol "Unduh CV" hanya muncul jika file ada.
    'cv' => [
        'file'  => 'files/CV_Suprapto.pdf',
        'label' => 'Unduh CV',
    ],

    'links' => [
        'github'   => 'https://github.com/Suprapto-23',
        'linkedin' => 'https://linkedin.com/in/supraptokulo',
        'email'    => 'ssuprapto351@gmail.com',
    ],

    // Data singkat di halaman profil
    'facts' => [
        ['Domisili', 'Kab. Pekalongan, Jawa Tengah'],
        ['Pendidikan', 'S1 Teknologi Informasi, ITSNU Pekalongan'],
        ['IPK', '3,76'],
        ['Sertifikasi', 'BNSP Junior Web Programmer'],
    ],

    'thesis' => [
        'title'    => 'Implementasi Metode RAD dalam Rancang Bangun Sistem Informasi Manajemen Posyandu',
        'case'     => 'Studi Kasus: Desa Bantarkulon',
        'year'     => '2026',
        'summary'  => 'Merancang dan membangun sistem informasi manajemen Posyandu berbasis web untuk Posyandu Desa Bantarkulon sebagai solusi atas pencatatan manual. Pengembangan memakai metode Rapid Application Development (RAD) dengan Laravel, PHP, dan MySQL, lalu diuji dengan Black Box Testing dan User Acceptance Testing (UAT).',
        'features' => [
            ['Pencatatan terpadu', 'Data sasaran Balita, Remaja, dan Lansia tersimpan dalam satu basis data.'],
            ['Hak akses berbasis peran', 'Role-Based Access Control untuk Admin, Bidan, Kader, dan Warga.'],
            ['Riwayat kesehatan', 'Penelusuran riwayat kesehatan setiap sasaran.'],
            ['Laporan operasional', 'Laporan operasional Posyandu disusun otomatis oleh sistem.'],
        ],
        'outputs'  => [
            ['Black Box Testing', 'Valid', 'Seluruh skenario fungsional valid'],
            ['User Acceptance Testing', '84,28%', 'Kategori “Sangat Layak”'],
            ['Hak Cipta Program Komputer', 'No. 001576590', 'Diumumkan 25 Juli 2026'],
        ],
        'live'     => 'https://sim-posyanducare.vercel.app',
    ],

    /*
    | Keahlian (halaman /skills). Format item:
    |   ['name' => 'PHP', 'dev' => 'php']                       ikon dari Devicon
    |   ['name' => 'Microsoft Word', 'office' => ['W', '#185ABD']]  lencana Office
    |   ['name' => 'Analisis kebutuhan']                        tanpa ikon
    | 'used' = bukti penerapan, ditulis sesuai CV.
    */
    'skills' => [
        [
            'title' => 'Pemrograman web (backend)',
            'desc'  => 'Fondasi sistem: logika aplikasi, basis data, dan integrasi layanan.',
            'items' => [
                ['name' => 'PHP', 'dev' => 'php'],
                ['name' => 'Laravel', 'dev' => 'laravel'],
                ['name' => 'MySQL', 'dev' => 'mysql'],
                ['name' => 'REST API'],
            ],
            'used'  => 'Sistem pemesanan tiket Lolong Adventure, SIM PosyanduCare, dan Sistem Manajemen Pelanggan saat magang Backend Developer di Creatifla Multimedia (termasuk integrasi WhatsApp Blast API).',
        ],
        [
            'title' => 'Antarmuka web (frontend)',
            'desc'  => 'Tampilan yang responsif dan mudah dipakai oleh pengguna non-teknis.',
            'items' => [
                ['name' => 'HTML5', 'dev' => 'html5'],
                ['name' => 'CSS3', 'dev' => 'css3'],
                ['name' => 'JavaScript', 'dev' => 'javascript'],
                ['name' => 'Tailwind CSS', 'dev' => 'tailwindcss'],
                ['name' => 'Alpine.js', 'dev' => 'alpinejs'],
            ],
            'used'  => 'Antarmuka pada proyek web di halaman Proyek, dari sistem pemesanan tiket hingga website desa.',
        ],
        [
            'title' => 'Perangkat dan publikasi',
            'desc'  => 'Alat kerja harian untuk mengelola kode dan mempublikasikan sistem.',
            'items' => [
                ['name' => 'Git', 'dev' => 'git'],
                ['name' => 'GitHub', 'dev' => 'github'],
                ['name' => 'Vercel', 'dev' => 'vercel'],
                ['name' => 'XAMPP', 'dev' => 'xampp'],
                ['name' => 'VS Code', 'dev' => 'vscode'],
            ],
            'used'  => 'Kode dikelola dengan Git dan GitHub, lalu proyek dipublikasikan melalui Vercel.',
        ],
        [
            'title' => 'Metodologi dan pengujian',
            'desc'  => 'Cara membangun dan memastikan sistem berjalan sesuai kebutuhan.',
            'items' => [
                ['name' => 'Rapid Application Development (RAD)'],
                ['name' => 'Role-Based Access Control (RBAC)'],
                ['name' => 'Black Box Testing'],
                ['name' => 'User Acceptance Testing (UAT)'],
            ],
            'used'  => 'Skripsi SIM PosyanduCare: seluruh skenario Black Box Testing valid, UAT 84,28% (“Sangat Layak”), dan RBAC untuk peran Admin, Bidan, Kader, dan Warga.',
        ],
        [
            'title' => 'Analisis dan perancangan',
            'desc'  => 'Memahami masalah mitra sebelum menulis kode.',
            'items' => [
                ['name' => 'Analisis kebutuhan'],
                ['name' => 'Perancangan alur kerja dan basis data'],
                ['name' => 'Dokumentasi dan pelaporan'],
            ],
            'used'  => 'Program PKM ITSNU Pekalongan bersama Pokdarwis Lolong Adventure: dari identifikasi kebutuhan mitra hingga perancangan skema database dan alur pemesanan.',
        ],
        [
            'title' => 'Kolaborasi dan komunikasi',
            'desc'  => 'Bekerja dalam tim dan mendampingi pengguna sampai mandiri.',
            'items' => [
                ['name' => 'Kerja tim'],
                ['name' => 'Komunikasi dengan mitra'],
                ['name' => 'Pelatihan dan pendampingan pengguna'],
                ['name' => 'Kepanitiaan'],
            ],
            'used'  => 'Pelatihan pengguna sistem bagi 20 anggota Pokdarwis (11 Agustus 2025) dan panitia Workshop Pemrograman HTML dan CSS HIMATIF ITSNU (Mei 2025).',
            // Foto bukti: [path, keterangan]. File yang tidak ada otomatis dilewati.
            'photos' => [
                ['images/dokumentasi/pkm-pelatihan.jpg', 'Pelatihan pengguna sistem bagi 20 anggota Pokdarwis (11 Agustus 2025)'],
                ['images/dokumentasi/panitia-workshop.jpg', 'Panitia Workshop Pemrograman HTML dan CSS, HIMATIF ITSNU (Mei 2025)'],
                ['images/dokumentasi/kkn-humas-1.jpg', 'Humas dan dokumentasi kegiatan KKN'],
            ],
        ],
        [
            'title' => 'Pendukung',
            'desc'  => 'Keterampilan tambahan untuk dokumentasi, desain, dan riset.',
            'items' => [
                ['name' => 'Microsoft Word', 'office' => ['W', '#185ABD']],
                ['name' => 'Microsoft Excel', 'office' => ['X', '#107C41']],
                ['name' => 'Microsoft PowerPoint', 'office' => ['P', '#C43E1C']],
                ['name' => 'Dasar desain grafis dan UI/UX'],
                ['name' => 'Literasi dasar AI'],
            ],
            'used'  => 'Sertifikat Belajar Dasar AI (Dicoding Indonesia, 2025) dan Pelatihan Desain Grafis (BLKK PC GP Ansor, 2023).',
        ],
    ],
];