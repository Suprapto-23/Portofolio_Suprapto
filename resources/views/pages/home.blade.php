{{-- resources/views/home.blade.php --}}
@extends('layouts.app')

@section('content')
@php
    $P            = config('portfolio');
    $projects     = collect($P['projects'] ?? []);
    $certificates = collect($P['certificates'] ?? []);
    $stats        = $P['stats'] ?? [];
    $ip           = $P['ip'] ?? [];

    // File surat pencatatan ciptaan (taruh di public/documents/hak-cipta/). Dicocokkan lewat kata kunci judul.
    $ipFiles = [
        'posyandu' => 'documents/hak-cipta/hak-cipta-posyandu.pdf',
        'tiket'    => 'documents/hak-cipta/hak-cipta-tiket-lolong.pdf',
    ];
    $ipFileFor = function (string $title) use ($ipFiles) {
        foreach ($ipFiles as $kw => $path) {
            if (str_contains(strtolower($title), $kw) && file_exists(public_path($path))) { return asset($path); }
        }
        return null;
    };
    $about        = $P['about'] ?? [];
    $highlights   = $P['highlights'] ?? [];

    // Tautan ke halaman profil (mencoba nama route umum, jika tidak ada memakai /profil)
    $profileRoute = collect(['profile', 'profil', 'about'])->first(fn ($n) => \Illuminate\Support\Facades\Route::has($n));
    $profileUrl   = $profileRoute ? route($profileRoute) : url('/profil');
    $skillsUrl    = \Illuminate\Support\Facades\Route::has('skills') ? route('skills') : url('/skills');

    // ---- Pembaca data yang toleran: mendukung array asosiatif maupun array berindeks ----
    $pick = function ($row, array $keys, $default = '') {
        $row = (array) $row;
        foreach ($keys as $k) {
            if (isset($row[$k]) && $row[$k] !== '' && $row[$k] !== null) { return $row[$k]; }
        }
        return $default;
    };

    // Pengalaman: terima beberapa kemungkinan nama kunci pada config/portfolio.php
    $rawTimeline = $P['timeline'] ?? $P['experience'] ?? $P['experiences'] ?? $P['pengalaman'] ?? [];
    $timeline = collect($rawTimeline)->map(function ($r) use ($pick) {
        $bullets = $pick($r, ['bullets', 'points', 'tasks', 'items', 'list', 3], []);
        if (is_string($bullets)) { $bullets = [$bullets]; }
        if (!$bullets && ($d = $pick($r, ['desc', 'description', 'summary']))) { $bullets = [$d]; }
        return [
            'role'    => $pick($r, ['role', 'title', 'position', 'jabatan', 0]),
            'org'     => $pick($r, ['org', 'company', 'organization', 'instansi', 1]),
            'period'  => $pick($r, ['period', 'time', 'date', 'year', 'periode', 2]),
            'note'    => $pick($r, ['note', 'catatan']),
            'bullets' => (array) $bullets,
            'link'    => is_array($l = $pick($r, ['link'], null)) ? $l : null,
        ];
    })->filter(fn ($i) => $i['role'] !== '' || $i['org'] !== '')->values();

    // Organisasi & kegiatan
    $rawOrgs = $P['activities'] ?? $P['organizations'] ?? $P['organisasi'] ?? [];
    $orgs = collect($rawOrgs)->map(fn ($r) => [
        'time'  => $pick($r, ['time', 'period', 'date', 'year', 'periode', 2]),
        'title' => $pick($r, ['title', 'role', 'name', 'jabatan', 0]),
        'org'   => $pick($r, ['org', 'organization', 'organisasi', 'instansi', 1]),
        'desc'  => $pick($r, ['desc', 'description', 'note', 3]),
    ])->filter(fn ($o) => $o['title'] !== '' || $o['org'] !== '')->values();

    // Foto dan tautan diatur di config/portfolio_site.php
    $heroPhoto  = \App\Support\Img::url('profile');
    $aboutPhoto = \App\Support\Img::url('about_photo');
    $links      = config('portfolio_site.links');

    // Ikon teknologi (Devicon via CDN) dan ikon Office / garis (SVG inline)
    $dev = fn ($slug, $v = 'original') => "https://cdn.jsdelivr.net/gh/devicons/devicon@v2.16.0/icons/{$slug}/{$slug}-{$v}.svg";
    $office = fn ($bg, $letter) => '<svg class="h-5 w-5" viewBox="0 0 24 24" aria-hidden="true"><rect width="24" height="24" rx="5" fill="'.$bg.'"/><text x="12" y="17" text-anchor="middle" font-family="Arial,sans-serif" font-size="14" font-weight="700" fill="#fff">'.$letter.'</text></svg>';
    $line = fn ($path) => '<svg class="h-5 w-5 text-[#1677FF]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">'.$path.'</svg>';

    $skillGroups = [
        'Backend' => [
            ['name' => 'PHP',      'img' => $dev('php')],
            ['name' => 'Laravel',  'img' => $dev('laravel')],
            ['name' => 'MySQL',    'img' => $dev('mysql')],
            ['name' => 'REST API', 'svg' => $line('<path d="M8 9l-4 3 4 3M16 9l4 3-4 3M13.5 6l-3 12"/>')],
        ],
        'Frontend' => [
            ['name' => 'HTML5',        'img' => $dev('html5')],
            ['name' => 'CSS3',         'img' => $dev('css3')],
            ['name' => 'JavaScript',   'img' => $dev('javascript')],
            ['name' => 'Tailwind CSS', 'img' => $dev('tailwindcss')],
            ['name' => 'Alpine.js',    'img' => $dev('alpinejs')],
        ],
        'Tools & Deployment' => [
            ['name' => 'Git',     'img' => $dev('git')],
            ['name' => 'GitHub',  'img' => $dev('github')],
            ['name' => 'Vercel',  'img' => $dev('vercel')],
            ['name' => 'XAMPP',   'img' => $dev('xampp')],
            ['name' => 'VS Code', 'img' => $dev('vscode')],
        ],
        'Metodologi & Pengujian' => [
            ['name' => 'Rapid Application Development (RAD)'],
            ['name' => 'Role-Based Access Control (RBAC)'],
            ['name' => 'Black Box Testing'],
            ['name' => 'User Acceptance Testing (UAT)'],
        ],
        'Analisis & Kolaborasi' => [
            ['name' => 'Analisis kebutuhan'],
            ['name' => 'Perancangan alur kerja dan basis data'],
            ['name' => 'Dokumentasi dan pelaporan'],
            ['name' => 'Kerja tim dan komunikasi dengan mitra'],
            ['name' => 'Pelatihan dan pendampingan pengguna'],
        ],
        'Pendukung' => [
            ['name' => 'Microsoft Word',        'svg' => $office('#185ABD', 'W')],
            ['name' => 'Microsoft Excel',       'svg' => $office('#107C41', 'X')],
            ['name' => 'Microsoft PowerPoint',  'svg' => $office('#C43E1C', 'P')],
            ['name' => 'Desain grafis dan UI/UX', 'svg' => $line('<path d="M12 19l7-7 3 3-7 7-3-3z"/><path d="M18 13l-1.5-7.5L2 2l3.5 14.5L13 18l5-5z"/><path d="M2 2l7.6 7.6"/><circle cx="11" cy="11" r="2"/>')],
            ['name' => 'Literasi dasar AI'],
        ],
    ];

    $steps = [
        ['Analisis kebutuhan', 'Memahami kebutuhan mitra dan pengguna, lalu merumuskan ruang lingkup sistem.', 'from-[#0A6CFF] to-[#063B91]'],
        ['Perancangan sistem dan basis data', 'Merancang alur kerja, skema basis data terpadu, dan hak akses pengguna (RBAC).', 'from-[#25AEFF] to-[#0A6CFF]'],
        ['Pengembangan', 'Membangun fitur dengan Laravel, PHP, dan MySQL secara bertahap menggunakan pendekatan RAD.', 'from-[#3D66F5] to-[#0A6CFF]'],
        ['Pengujian dan pendampingan', 'Black Box Testing dan UAT, dilanjutkan pelatihan agar pengguna dapat memakai sistem secara mandiri.', 'from-[#5F4FEE] to-[#2E24A3]'],
    ];

    $thesis = [
        'title' => 'Implementasi Metode RAD dalam Rancang Bangun Sistem Informasi Manajemen Posyandu',
        'case'  => 'Studi Kasus: Desa Bantarkulon',
        'year'  => '2026',
        'live'  => 'https://sim-posyanducare.vercel.app',
    ];
    $thesisProject = $projects->first(fn ($p) => str_contains(strtolower($p['title'] ?? ''), 'posyandu'));

    // Indeks sertifikat BNSP agar kartu di Profil bisa membuka preview yang sama
    $bnspIndex = $certificates->values()->search(fn ($c) => str_contains(strtolower($c['title'] ?? ''), 'junior web programmer'));

    // Data untuk preview sertifikat (dibaca oleh JavaScript di bagian bawah)
    $certData = $certificates->map(fn ($c) => [
        'src'    => asset($c['image']),
        'title'  => $c['title'],
        'issuer' => $c['issuer'],
        'date'   => $c['date'],
        'note'   => $c['note'] ?? '',
        'desc'   => $c['desc'] ?? '',
        'url'    => $c['url'] ?? '',
    ])->values();
@endphp

<style>
    html { scroll-behavior: smooth; scrollbar-gutter: stable; }
    section[id] { scroll-margin-top: 90px; }
    .pra-grad-text { background: linear-gradient(90deg, #0A6CFF 0%, #25AEFF 100%); -webkit-background-clip: text; background-clip: text; color: transparent; }
    .pra-blob { position: absolute; border-radius: 50%; filter: blur(80px); pointer-events: none; }
    @keyframes praDot { 0%, 100% { box-shadow: 0 0 0 0 rgba(22,119,255,.45); } 50% { box-shadow: 0 0 0 7px rgba(22,119,255,0); } }
    .status-dot { animation: praDot 2s infinite; }
    @keyframes praPop { from { opacity: 0; transform: translateY(14px) scale(.98); } to { opacity: 1; transform: none; } }
    #certModal[open], #ipModal[open] { animation: praPop .28s ease-out; }
    #certModal::backdrop, #ipModal::backdrop { background: rgba(11, 27, 58, .62); backdrop-filter: blur(3px); }
    @media (prefers-reduced-motion: reduce) {
        html { scroll-behavior: auto; }
        .status-dot, #certModal[open], #ipModal[open] { animation: none; }
    }
</style>

{{-- ======================= HERO ======================= --}}
<section id="home" class="relative overflow-hidden bg-white pb-16 pt-12 lg:pb-24 lg:pt-16">
    <div class="pra-blob right-[-10%] top-[-10%] h-[440px] w-[440px] bg-[#1677FF]/10"></div>

    <div class="relative z-10 mx-auto max-w-[1180px] px-6">
        <div class="grid grid-cols-1 items-center gap-12 lg:grid-cols-12 lg:items-stretch lg:gap-14">

            {{-- Teks --}}
            <div class="text-center lg:col-span-7 lg:flex lg:flex-col lg:items-start lg:justify-center lg:text-left" data-aos="fade-right">
                <div class="mb-6 inline-flex items-center gap-2.5 rounded-full border border-[#DCE7F5] bg-[#F4F9FF] px-4 py-2">
                    <span class="status-dot h-2 w-2 rounded-full bg-[#1677FF]"></span>
                    <span class="text-[13px] font-semibold text-[#1677FF]">Terbuka untuk posisi Junior Web Programmer</span>
                </div>

                <h1 class="text-[34px] font-extrabold leading-[1.12] tracking-tight text-[#0B1B3A] md:text-[42px] lg:text-[46px]">
                    Halo, saya Suprapto
                    <span class="pra-grad-text mt-1 block">Junior Web Programmer</span>
                </h1>
                <p class="mt-4 text-[17px] font-semibold text-[#0B1B3A]">Pengembangan Web dan Sistem Informasi</p>

                <p class="mx-auto mt-4 max-w-[560px] text-[16px] leading-[1.8] text-[#64748B] lg:mx-0">
                    Lulusan S1 Teknologi Informasi ITSNU Pekalongan (IPK 3,76). Berpengalaman membangun sistem informasi berbasis web dengan Laravel, PHP, dan MySQL, dari analisis kebutuhan hingga pengujian dan pendampingan pengguna.
                </p>

                <div class="mt-8 flex flex-col items-center gap-4 sm:flex-row lg:justify-start">
                    <a href="#projects" class="inline-flex h-[52px] w-full items-center justify-center gap-2 rounded-full bg-gradient-to-r from-[#0A72FF] to-[#5F4FEE] px-8 text-[15px] font-semibold text-white shadow-[0_8px_20px_-6px_rgba(40,90,245,0.5)] transition-all duration-300 hover:-translate-y-1 hover:shadow-[0_12px_24px_-6px_rgba(40,90,245,0.7)] sm:w-auto">
                        Lihat Proyek
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m13 6 6 6-6 6"/></svg>
                    </a>
                    <a href="{{ route('contact') }}" class="inline-flex h-[52px] w-full items-center justify-center rounded-full border-[1.5px] border-[#D1E3FF] bg-white px-8 text-[15px] font-semibold text-[#1677FF] transition-all duration-300 hover:-translate-y-1 hover:border-[#1677FF] hover:bg-[#F4F9FF] sm:w-auto">
                        Hubungi Saya
                    </a>
                </div>

                <div class="mt-7 flex items-center justify-center gap-3 lg:justify-start">
                    <a href="{{ $links['github'] }}" target="_blank" rel="noopener noreferrer" aria-label="GitHub" class="flex h-10 w-10 items-center justify-center rounded-full border border-[#DCE7F5] bg-white transition hover:-translate-y-0.5 hover:border-[#1677FF]">
                        <img src="{{ $dev('github') }}" alt="" class="h-5 w-5">
                    </a>
                    <a href="{{ $links['linkedin'] }}" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn" class="flex h-10 w-10 items-center justify-center rounded-full border border-[#DCE7F5] bg-white transition hover:-translate-y-0.5 hover:border-[#1677FF]">
                        <img src="{{ $dev('linkedin', 'plain') }}" alt="" class="h-5 w-5">
                    </a>
                    <a href="mailto:{{ $links['email'] }}" aria-label="Email" class="flex h-10 w-10 items-center justify-center rounded-full border border-[#DCE7F5] bg-white text-[#1677FF] transition hover:-translate-y-0.5 hover:border-[#1677FF]">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="5" width="18" height="14" rx="2"/><path d="m3 7 9 6 9-6"/></svg>
                    </a>
                </div>
            </div>

            {{-- Foto saja: tinggi mengikuti kolom teks di sebelah kiri --}}
            <div class="lg:col-span-5" data-aos="fade-left" data-aos-delay="100">
                <div class="relative mx-auto aspect-[4/5] w-full max-w-[380px] overflow-hidden rounded-[28px] border border-[#DCE7F5] bg-gradient-to-br from-[#EAF3FF] to-[#DDE6FF] shadow-[0_24px_50px_-24px_rgba(22,119,255,0.35)] lg:mx-0 lg:aspect-auto lg:h-full lg:min-h-[420px] lg:max-w-none">
                    @if($heroPhoto)
                        <img src="{{ $heroPhoto }}" alt="Foto Suprapto" class="absolute inset-0 h-full w-full object-cover object-top">
                    @else
                        <div class="absolute inset-0 flex items-center justify-center bg-gradient-to-br from-[#0A6CFF] to-[#5F4FEE]">
                            <span class="text-[110px] font-extrabold text-white/90">S</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ======================= CAPAIAN RINGKAS ======================= --}}
@if(count($stats))
<section class="border-y border-[#DCE7F5]/70 bg-[#FAFCFF] py-10">
    <div class="mx-auto grid max-w-[1180px] grid-cols-2 gap-8 px-6 text-center md:grid-cols-4">
        @foreach($stats as [$value, $label])
            <div>
                <p class="text-[30px] font-extrabold text-[#0B1B3A]">{{ $value }}</p>
                <p class="mt-1 text-[13px] font-medium text-[#64748B]">{{ $label }}</p>
            </div>
        @endforeach
    </div>
</section>
@endif

{{-- ======================= PROFIL ======================= --}}
<section id="about" class="bg-white py-20 lg:py-24">
    <div class="mx-auto max-w-[1180px] px-6">
        <div class="mb-12 max-w-2xl">
            <span class="mb-2 block text-[13px] font-semibold text-[#1677FF]">Profil</span>
            <h2 class="text-[32px] font-bold text-[#0B1B3A] md:text-[38px]">Tentang Saya</h2>
        </div>

        <div class="grid grid-cols-1 gap-12 lg:grid-cols-12 lg:gap-16">
            <div class="lg:col-span-7">
                @foreach($about as $para)
                    <p class="{{ $loop->last ? 'mb-7' : 'mb-5' }} text-[15.5px] leading-[1.85] text-[#64748B]">{{ $para }}</p>
                @endforeach

                <ul class="space-y-3.5 text-[14.5px] leading-relaxed text-[#0B1B3A]">
                    @foreach($highlights as $point)
                        <li class="flex items-start gap-3">
                            <svg class="mt-0.5 h-5 w-5 shrink-0 text-[#1677FF]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m5 12 5 5L20 7"/></svg>
                            {{ $point }}
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="space-y-5 lg:col-span-5">
                @if($aboutPhoto)
                    <img src="{{ $aboutPhoto }}" alt="Suprapto" loading="lazy" class="aspect-[4/3] w-full rounded-[22px] border border-[#DCE7F5] object-cover object-top shadow-sm">
                @endif

                <div class="rounded-[22px] border border-[#DCE7F5] bg-[#FAFCFF] p-6">
                    <div class="flex items-start gap-4">
                        <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-[#EAF6FF] text-[#1677FF]">
                            <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/></svg>
                        </div>
                        <div>
                            <h3 class="text-[16px] font-bold text-[#0B1B3A]">S1 Teknologi Informasi</h3>
                            <p class="text-[14px] text-[#64748B]">Institut Teknologi dan Sains Nahdlatul Ulama (ITSNU) Pekalongan</p>
                            <p class="mt-1 text-[13.5px] font-medium text-[#0B1B3A]">2022 – 2026 · IPK 3,76 · Ijazah telah terbit</p>
                        </div>
                    </div>
                    <dl class="mt-5 space-y-4 border-t border-[#DCE7F5] pt-5 text-[13.5px] leading-relaxed">
                        <div>
                            <dt class="font-semibold text-[#0B1B3A]">Fokus studi</dt>
                            <dd class="text-[#64748B]">Analisis dan perancangan sistem, basis data, serta pengembangan aplikasi web.</dd>
                        </div>
                        <div>
                            <dt class="font-semibold text-[#0B1B3A]">Skripsi</dt>
                            <dd class="text-[#64748B]">“{{ $thesis['title'] }} ({{ $thesis['case'] }})”, {{ $thesis['year'] }}.</dd>
                        </div>
                        <div>
                            <dt class="font-semibold text-[#0B1B3A]">Luaran</dt>
                            <dd>
                                <ul class="mt-1 list-disc space-y-1 pl-5 text-[#64748B] marker:text-[#1677FF]">
                                    <li>Sistem informasi manajemen Posyandu berbasis web (Laravel, PHP, MySQL)</li>
                                    <li>Black Box Testing valid dan UAT 84,28% (“Sangat Layak”)</li>
                                    <li>Hak Cipta Program Komputer No. 001576590</li>
                                </ul>
                            </dd>
                        </div>
                    </dl>
                    <div class="mt-5 flex flex-wrap items-center gap-x-5 gap-y-2 text-[13.5px] font-semibold">
                        <a href="{{ $thesis['live'] }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-1.5 text-[#1677FF] hover:text-[#0A6CFF]">Buka sistem <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M7 17 17 7M8 7h9v9"/></svg></a>
                        @if($thesisProject)
                            <a href="{{ route('projects.show', $thesisProject['slug']) }}" class="text-[#1677FF] hover:text-[#0A6CFF]">Detail dan dokumentasi</a>
                        @endif
                    </div>
                </div>

                <div class="flex items-start gap-4 rounded-[22px] border border-[#DCE7F5] bg-white p-6">
                    <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-[#EEF0FF] text-[#5F4FEE]">
                        <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="9" r="6"/><path d="m8.5 14-1.5 8 5-3 5 3-1.5-8"/></svg>
                    </div>
                    <div>
                        <h3 class="text-[16px] font-bold text-[#0B1B3A]">Sertifikat Kompetensi BNSP</h3>
                        <p class="text-[14px] text-[#64748B]">Junior Web Programmer · LSP TIKOM</p>
                        <p class="mt-1 text-[13.5px] font-medium text-[#0B1B3A]">Terbit 18 September 2026, berlaku hingga 18 September 2029</p>
                        @if($bnspIndex !== false)
                            <button type="button" data-index="{{ $bnspIndex }}" class="cert-open mt-3 inline-flex items-center gap-2 text-[13.5px] font-bold text-[#1677FF] hover:text-[#0A6CFF]">
                                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7S2 12 2 12z"/><circle cx="12" cy="12" r="3"/></svg>
                                Lihat sertifikat
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ======================= PENGALAMAN ======================= --}}
<section id="experience" class="bg-white py-20 lg:py-24">
    <div class="mx-auto max-w-[1180px] px-6">
        <div class="mb-12 max-w-2xl">
            <span class="mb-2 block text-[13px] font-semibold text-[#1677FF]">Rekam jejak</span>
            <h2 class="text-[32px] font-bold text-[#0B1B3A] md:text-[38px]">Pengalaman</h2>
        </div>

        @if($timeline->isNotEmpty())
            <ol class="relative space-y-8 border-l-2 border-[#DCE7F5] pl-8">
                @foreach($timeline as $item)
                    <li class="relative">
                        <span class="absolute -left-[43px] top-7 h-5 w-5 rounded-full border-4 border-white bg-[#1677FF] shadow"></span>
                        <article class="rounded-[22px] border border-[#DCE7F5] bg-white p-7 shadow-sm">
                            <div class="flex flex-wrap items-start justify-between gap-3">
                                <div>
                                    <h3 class="text-[18px] font-bold text-[#0B1B3A]">{{ $item['role'] }}</h3>
                                    <p class="mt-0.5 text-[14.5px] font-semibold text-[#1677FF]">{{ $item['org'] }}</p>
                                </div>
                                @if($item['period'])
                                    <span class="rounded-full border border-[#DCE7F5] bg-[#F4F9FF] px-4 py-1.5 text-[13px] font-semibold text-[#0B1B3A]">{{ $item['period'] }}</span>
                                @endif
                            </div>
                            @if($item['note'])
                                <p class="mt-2 text-[13.5px] italic text-[#64748B]">{{ $item['note'] }}</p>
                            @endif
                            @if(count($item['bullets']))
                                <ul class="mt-5 space-y-2.5 text-[14.5px] leading-relaxed text-[#475569]">
                                    @foreach($item['bullets'] as $b)
                                        <li class="flex items-start gap-3">
                                            <span class="mt-2.5 h-1.5 w-1.5 shrink-0 rounded-full bg-[#1677FF]"></span>
                                            <span>{{ $b }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                            @if(!empty($item['link']['url']))
                                <a href="{{ $item['link']['url'] }}" target="_blank" rel="noopener noreferrer" class="mt-5 inline-flex items-center gap-1.5 text-[13.5px] font-semibold text-[#1677FF] hover:text-[#0A6CFF]">
                                    {{ $item['link']['label'] ?? 'Buka tautan' }}
                                    <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M7 17 17 7M8 7h9v9"/></svg>
                                </a>
                            @endif
                            <div class="mt-5 border-t border-[#EEF3FA] pt-4">
                                <a href="{{ $profileUrl }}#pengalaman-{{ $loop->iteration }}" class="inline-flex items-center gap-1.5 text-[13.5px] font-semibold text-[#1677FF] hover:text-[#0A6CFF]">Lihat detail dan dokumentasi <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m13 6 6 6-6 6"/></svg></a>
                            </div>
                        </article>
                    </li>
                @endforeach
            </ol>
        @elseif(app()->environment('local'))
            {{-- Peringatan hanya tampil di lokal --}}
            <div class="rounded-2xl border border-dashed border-amber-400 bg-amber-50 p-6 text-[14px] leading-relaxed text-amber-900">
                Data pengalaman belum terbaca. Pastikan <code class="font-semibold">config/portfolio.php</code> memiliki kunci
                <code class="font-semibold">'timeline'</code> yang berisi daftar pengalaman, lalu jalankan
                <code class="font-semibold">php artisan config:clear</code>.
            </div>
        @endif

        @if($orgs->isNotEmpty())
            <h3 class="mb-5 mt-14 text-[18px] font-bold text-[#0B1B3A]">Organisasi dan kegiatan</h3>
            <div class="grid gap-5 md:grid-cols-2">
                @foreach($orgs as $org)
                    <div class="rounded-[20px] border border-[#DCE7F5] bg-[#FAFCFF] p-6">
                        @if($org['time'])<p class="text-[13px] font-semibold text-[#1677FF]">{{ $org['time'] }}</p>@endif
                        <h4 class="mt-1 text-[15.5px] font-bold leading-snug text-[#0B1B3A]">{{ $org['title'] }}</h4>
                        @if($org['org'])<p class="mt-1 text-[13.5px] text-[#64748B]">{{ $org['org'] }}</p>@endif
                        @if($org['desc'])<p class="mt-2 text-[13.5px] leading-relaxed text-[#64748B]">{{ $org['desc'] }}</p>@endif
                        <a href="{{ $profileUrl }}#kegiatan-{{ $loop->iteration }}" class="mt-4 inline-flex items-center gap-1.5 text-[13.5px] font-semibold text-[#1677FF] hover:text-[#0A6CFF]">Lihat detail dan dokumentasi <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m13 6 6 6-6 6"/></svg></a>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</section>

{{-- ======================= PROYEK ======================= --}}
<section id="projects" class="border-y border-[#DCE7F5]/60 bg-[#FAFCFF] py-20 lg:py-24">
    <div class="mx-auto max-w-[1180px] px-6">
        <div class="mb-12 flex flex-col justify-between gap-5 md:flex-row md:items-end">
            <div class="max-w-2xl">
                <span class="mb-2 block text-[13px] font-semibold text-[#1677FF]">Portofolio</span>
                <h2 class="text-[32px] font-bold text-[#0B1B3A] md:text-[38px]">Proyek yang Telah Dikerjakan</h2>
            </div>
            <a href="{{ route('projects') }}" class="inline-flex items-center gap-2 text-[15px] font-semibold text-[#1677FF] transition-colors hover:text-[#0A6CFF]">
                Lihat semua proyek
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
            </a>
        </div>

        <div class="grid grid-cols-1 gap-8 md:grid-cols-3">
            @foreach($projects->take(3) as $project)
                <article class="group flex flex-col overflow-hidden rounded-[24px] border border-[#DCE7F5] bg-white shadow-sm transition duration-300 hover:border-[#1677FF]/40 hover:shadow-[0_20px_40px_-15px_rgba(22,119,255,0.15)]">
                    <div class="relative overflow-hidden border-b border-[#DCE7F5]/50 bg-[#F4F9FF] pt-[60%]">
                        <img src="{{ asset($project['cover']) }}" alt="{{ $project['title'] }}" loading="lazy" class="absolute inset-0 h-full w-full object-cover transition-transform duration-700 group-hover:scale-105">
                    </div>
                    <div class="flex flex-1 flex-col p-7">
                        <span class="mb-4 self-start rounded-md bg-[#EAF6FF] px-3 py-1 text-[12px] font-semibold text-[#1677FF]">{{ $project['category'] }}</span>
                        <h3 class="mb-3 line-clamp-2 text-[20px] font-bold leading-tight text-[#0B1B3A]">{{ $project['title'] }}</h3>
                        <p class="mb-6 line-clamp-4 text-[14.5px] leading-relaxed text-[#64748B]">{{ $project['summary'] }}</p>
                        <div class="mt-auto flex items-center justify-between gap-3 border-t border-gray-100 pt-4">
                            <a href="{{ route('projects.show', $project['slug']) }}" class="inline-flex items-center gap-2 text-[14px] font-bold text-[#0B1B3A] transition-colors group-hover:text-[#1677FF]">
                                Detail dan dokumentasi
                            </a>
                            <a href="{{ $project['live'] }}" target="_blank" rel="noopener noreferrer" class="text-[13px] font-bold text-[#1677FF] hover:text-[#0A6CFF]">Buka website</a>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>
    </div>
</section>

{{-- ======================= KEAHLIAN ======================= --}}
<section id="skills" class="bg-white py-20 lg:py-24">
    <div class="mx-auto max-w-[1180px] px-6">
        <div class="mb-12 max-w-2xl">
            <span class="mb-2 block text-[13px] font-semibold text-[#1677FF]">Kompetensi</span>
            <h2 class="mb-4 text-[32px] font-bold text-[#0B1B3A] md:text-[38px]">Keahlian dan Perangkat Kerja</h2>
            <p class="text-[16px] leading-relaxed text-[#64748B]">Teknologi, metode, dan keterampilan pendukung yang saya gunakan pada proyek nyata maupun pekerjaan akademik.</p>
            <a href="{{ $skillsUrl }}" class="mt-5 inline-flex items-center gap-1.5 text-[14.5px] font-semibold text-[#1677FF] hover:text-[#0A6CFF]">Lihat detail keahlian
                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m13 6 6 6-6 6"/></svg>
            </a>
        </div>

        <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
            @foreach($skillGroups as $group => $items)
                @php $hasIcon = collect($items)->contains(fn ($i) => isset($i['img']) || isset($i['svg'])); @endphp
                <div class="rounded-[22px] border border-[#DCE7F5] bg-white p-7 shadow-sm">
                    <h3 class="mb-5 text-[15px] font-bold text-[#0B1B3A]">{{ $group }}</h3>

                    @if($hasIcon)
                        <div class="flex flex-wrap gap-2.5">
                            @foreach($items as $item)
                                <span class="inline-flex items-center gap-2.5 rounded-full border border-[#DCE7F5] bg-[#F4F9FF] py-2 pl-3 pr-4 text-[13.5px] font-semibold text-[#0B1B3A]">
                                    @if(isset($item['img']))
                                        <img src="{{ $item['img'] }}" alt="" loading="lazy" class="h-5 w-5 object-contain" onerror="this.style.display='none'">
                                    @elseif(isset($item['svg']))
                                        {!! $item['svg'] !!}
                                    @endif
                                    {{ $item['name'] }}
                                </span>
                            @endforeach
                        </div>
                    @else
                        <ul class="space-y-3 text-[14px] leading-snug text-[#0B1B3A]">
                            @foreach($items as $item)
                                <li class="flex items-start gap-3">
                                    <svg class="mt-0.5 h-4 w-4 shrink-0 text-[#1677FF]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.8" stroke-linecap="round" stroke-linejoin="round"><path d="m5 12 5 5L20 7"/></svg>
                                    {{ $item['name'] }}
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ======================= HAK CIPTA & PUBLIKASI ======================= --}}
<section id="publications" class="border-y border-[#DCE7F5]/60 bg-[#FAFCFF] py-20 lg:py-24">
    <div class="mx-auto max-w-[1180px] px-6">
        <div class="mb-12 max-w-2xl">
            <span class="mb-2 block text-[13px] font-semibold text-[#1677FF]">Pengakuan karya</span>
            <h2 class="text-[32px] font-bold text-[#0B1B3A] md:text-[38px]">Hak Cipta dan Publikasi Ilmiah</h2>
        </div>

        <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
            @foreach($ip as [$type, $title, $meta, $note, $url])
                @php $ipFile = str_contains(strtolower($type), 'hak cipta') ? $ipFileFor($title) : null; @endphp
                <article class="flex flex-col rounded-[22px] border border-[#DCE7F5] bg-white p-7 shadow-sm transition duration-300 hover:border-[#1677FF]/40">
                    <span class="mb-4 self-start rounded-md bg-[#EAF6FF] px-3 py-1 text-[12px] font-semibold text-[#1677FF]">{{ $type }}</span>
                    <h3 class="mb-3 text-[16.5px] font-bold leading-snug text-[#0B1B3A]">{{ $title }}</h3>
                    <p class="mb-1 text-[13.5px] font-semibold text-[#0B1B3A]">{{ $meta }}</p>
                    <p class="text-[13px] leading-relaxed text-[#64748B]">{{ $note }}</p>
                    @if($ipFile)
                        <button type="button" class="ip-open mt-auto inline-flex items-center gap-2 self-start pt-5 text-[13.5px] font-bold text-[#1677FF] hover:text-[#0A6CFF]"
                                data-file="{{ $ipFile }}" data-title="{{ $title }}" data-meta="{{ $meta }}">
                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7S2 12 2 12z"/><circle cx="12" cy="12" r="3"/></svg>
                            Lihat surat pencatatan
                        </button>
                    @endif
                    @if($url)
                        <a href="{{ $url }}" target="_blank" rel="noopener noreferrer" class="mt-auto inline-flex items-center gap-1.5 self-start pt-5 text-[13px] font-bold text-[#1677FF] hover:text-[#0A6CFF]">
                            Buka artikel
                            <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M7 17 17 7M8 7h9v9"/></svg>
                        </a>
                    @endif
                </article>
            @endforeach
        </div>
    </div>
</section>

{{-- ======================= SERTIFIKAT ======================= --}}
<section id="certificates" class="bg-white py-20 lg:py-24">
    <div class="mx-auto max-w-[1180px] px-6">
        <div class="mb-12 max-w-2xl">
            <span class="mb-2 block text-[13px] font-semibold text-[#1677FF]">Validasi kompetensi</span>
            <h2 class="mb-4 text-[32px] font-bold text-[#0B1B3A] md:text-[38px]">Sertifikasi dan Pelatihan</h2>
            <p class="text-[16px] leading-relaxed text-[#64748B]">Klik sertifikat untuk melihat tampilan penuh beserta keterangannya.</p>
        </div>

        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @foreach($certificates as $cert)
                <article class="flex flex-col overflow-hidden rounded-[20px] border border-[#DCE7F5] bg-white shadow-sm transition duration-300 hover:border-[#1677FF]/40 hover:shadow-[0_18px_36px_-14px_rgba(22,119,255,0.28)]">
                    <button type="button" data-index="{{ $loop->index }}" aria-label="Lihat sertifikat {{ $cert['title'] }}"
                            class="cert-open relative block aspect-[4/3] w-full cursor-zoom-in overflow-hidden bg-[#F4F9FF] focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-[-2px] focus-visible:outline-[#1677FF]">
                        <img src="{{ asset($cert['image']) }}" alt="Sertifikat {{ $cert['title'] }}" loading="lazy" class="h-full w-full object-cover object-top">
                    </button>
                    <div class="flex flex-1 flex-col p-5">
                        <h3 class="mb-1.5 line-clamp-3 text-[15px] font-bold leading-snug text-[#0B1B3A]">{{ $cert['title'] }}</h3>
                        <p class="text-[13px] font-medium text-[#64748B]">{{ $cert['issuer'] }}</p>
                        <p class="mt-1 text-[13px] text-[#64748B]">{{ $cert['date'] }}</p>
                        <button type="button" data-index="{{ $loop->index }}" class="cert-open mt-auto inline-flex items-center gap-2 self-start pt-4 text-[13.5px] font-bold text-[#1677FF] hover:text-[#0A6CFF]">
                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7S2 12 2 12z"/><circle cx="12" cy="12" r="3"/></svg>
                            Lihat sertifikat
                        </button>
                    </div>
                </article>
            @endforeach
        </div>
    </div>
</section>

{{-- ======================= METODOLOGI ======================= --}}
<section class="border-y border-[#DCE7F5]/60 bg-[#FAFCFF] py-20 lg:py-24">
    <div class="mx-auto max-w-[1180px] px-6">
        <div class="mb-12 max-w-2xl">
            <span class="mb-2 block text-[13px] font-semibold text-[#1677FF]">Metodologi</span>
            <h2 class="mb-4 text-[32px] font-bold text-[#0B1B3A] md:text-[38px]">Pendekatan dalam Proyek</h2>
            <p class="text-[16px] leading-relaxed text-[#64748B]">Tahapan yang saya jalani pada proyek PKM dan skripsi, dari kebutuhan awal hingga sistem digunakan oleh penggunanya.</p>
        </div>

        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
            @foreach($steps as $i => [$title, $desc, $grad])
                <div class="rounded-[22px] border border-[#DCE7F5] bg-white p-6 shadow-sm">
                    <div class="mb-5 flex h-[46px] w-[46px] items-center justify-center rounded-full bg-gradient-to-br {{ $grad }} text-[15px] font-bold text-white shadow-lg">{{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}</div>
                    <h3 class="mb-2 text-[16.5px] font-bold text-[#0B1B3A]">{{ $title }}</h3>
                    <p class="text-[14px] leading-relaxed text-[#64748B]">{{ $desc }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ======================= KONTAK ======================= --}}
<section id="contact-cta" class="bg-white py-20 lg:py-24">
    <div class="mx-auto max-w-[1180px] px-6">
        <div class="relative overflow-hidden rounded-[32px] bg-gradient-to-br from-[#063B91] via-[#126BFF] to-[#7147FF] p-10 shadow-[0_20px_40px_-15px_rgba(18,107,255,0.4)] lg:p-16">
            <div class="absolute -right-20 -top-20 h-96 w-96 rounded-full bg-white/10 blur-[100px]"></div>
            <div class="relative z-10 flex flex-col items-start justify-between gap-10 md:flex-row md:items-center">
                <div class="max-w-xl">
                    <span class="mb-3 block text-[13px] font-semibold text-white/80">Kontak</span>
                    <h2 class="mb-4 text-[30px] font-extrabold leading-tight text-white md:text-[36px]">Terbuka untuk Magang dan Posisi Junior</h2>
                    <p class="text-[16px] leading-relaxed text-white/90">Saya sedang mencari posisi Junior Web Programmer atau Web Developer. Silakan hubungi saya melalui halaman kontak, email, atau LinkedIn untuk informasi lebih lanjut.</p>
                </div>

                <div class="flex shrink-0 flex-col items-start gap-4 md:items-center">
                    <a href="{{ route('contact') }}" class="inline-flex h-[54px] items-center gap-3 rounded-full bg-white px-9 text-[16px] font-bold text-[#0B1B3A] shadow-xl transition hover:-translate-y-1 hover:shadow-2xl">
                        Hubungi Saya
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m13 6 6 6-6 6"/></svg>
                    </a>
                    <a href="mailto:{{ $links['email'] }}" class="text-[14px] font-medium text-white/90 underline-offset-4 hover:underline">{{ $links['email'] }}</a>
                    <div class="flex gap-3">
                        <a href="{{ $links['linkedin'] }}" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn" class="flex h-10 w-10 items-center justify-center rounded-full bg-white transition hover:-translate-y-0.5">
                            <img src="{{ $dev('linkedin', 'plain') }}" alt="" class="h-5 w-5">
                        </a>
                        <a href="{{ $links['github'] }}" target="_blank" rel="noopener noreferrer" aria-label="GitHub" class="flex h-10 w-10 items-center justify-center rounded-full bg-white transition hover:-translate-y-0.5">
                            <img src="{{ $dev('github') }}" alt="" class="h-5 w-5">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ======================= PREVIEW HAK CIPTA (PDF atau gambar) ======================= --}}
<dialog id="ipModal" aria-labelledby="ipTitle" class="m-auto w-[94vw] max-w-[920px] overflow-hidden rounded-[24px] border-0 bg-white p-0 shadow-2xl">
    <div class="flex max-h-[92vh] flex-col">
        <div class="flex items-start justify-between gap-4 border-b border-[#DCE7F5] p-5 sm:px-7">
            <div>
                <h3 id="ipTitle" class="text-[17px] font-bold leading-snug text-[#0B1B3A]"></h3>
                <p id="ipMeta" class="mt-1 text-[13.5px] text-[#64748B]"></p>
            </div>
            <button type="button" id="ipClose" aria-label="Tutup" class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full text-[#64748B] transition hover:bg-[#F4F9FF] hover:text-[#0B1B3A]">
                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18M6 6l12 12"/></svg>
            </button>
        </div>
        <div class="min-h-0 flex-1 overflow-auto bg-[#EEF2F8]">
            <iframe id="ipFrame" title="Surat pencatatan ciptaan" class="hidden h-[72vh] w-full border-0"></iframe>
            <img id="ipImg" alt="Surat pencatatan ciptaan" class="mx-auto hidden max-h-[72vh] w-auto max-w-full object-contain">
        </div>
        <div class="border-t border-[#DCE7F5] px-5 py-3 text-[13px] text-[#64748B] sm:px-7">
            Dokumen tidak tampil? <a id="ipLink" href="#" target="_blank" rel="noopener noreferrer" class="font-semibold text-[#1677FF] hover:text-[#0A6CFF]">Buka di tab baru</a>
        </div>
    </div>
</dialog>

{{-- ======================= PREVIEW SERTIFIKAT (modal, tanpa tab baru) ======================= --}}
<dialog id="certModal" aria-labelledby="certTitle" class="m-auto w-[94vw] max-w-[1000px] overflow-hidden rounded-[24px] border-0 bg-white p-0 shadow-2xl">
    <div class="grid max-h-[90vh] grid-cols-1 overflow-y-auto lg:grid-cols-[1.5fr_1fr] lg:overflow-hidden">

        <div class="relative flex items-center justify-center bg-[#0B1B3A] p-4 sm:p-6 lg:max-h-[90vh]">
            <img id="certImg" alt="" class="max-h-[56vh] w-auto max-w-full rounded-lg object-contain shadow-xl lg:max-h-[78vh]">
            <button type="button" id="certPrev" aria-label="Sertifikat sebelumnya" class="absolute left-3 top-1/2 flex h-10 w-10 -translate-y-1/2 items-center justify-center rounded-full bg-white/90 text-[#0B1B3A] shadow transition hover:bg-white">
                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
            </button>
            <button type="button" id="certNext" aria-label="Sertifikat berikutnya" class="absolute right-3 top-1/2 flex h-10 w-10 -translate-y-1/2 items-center justify-center rounded-full bg-white/90 text-[#0B1B3A] shadow transition hover:bg-white">
                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
            </button>
        </div>

        <div class="flex flex-col p-6 lg:max-h-[90vh] lg:overflow-y-auto lg:p-8">
            <div class="mb-5 flex items-center justify-between">
                <span id="certCount" class="rounded-full bg-[#F4F9FF] px-3 py-1 text-[12.5px] font-semibold text-[#1677FF]"></span>
                <button type="button" id="certClose" aria-label="Tutup" class="flex h-9 w-9 items-center justify-center rounded-full text-[#64748B] transition hover:bg-[#F4F9FF] hover:text-[#0B1B3A]">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18M6 6l12 12"/></svg>
                </button>
            </div>

            <h3 id="certTitle" class="text-[19px] font-bold leading-snug text-[#0B1B3A]"></h3>
            <p id="certIssuer" class="mt-2 text-[14.5px] font-semibold text-[#1677FF]"></p>
            <p id="certDate" class="mt-1 text-[13.5px] text-[#64748B]"></p>
            <p id="certNote" class="mt-3 hidden rounded-xl bg-[#F4F9FF] px-4 py-3 text-[13px] leading-relaxed text-[#0B1B3A]"></p>
            <p id="certDesc" class="mt-5 hidden whitespace-pre-line text-[14px] leading-[1.8] text-[#64748B]"></p>

            <a id="certLink" href="#" target="_blank" rel="noopener noreferrer" class="mt-6 hidden items-center gap-1.5 text-[13.5px] font-bold text-[#1677FF] hover:text-[#0A6CFF]">
                Verifikasi sertifikat
                <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M7 17 17 7M8 7h9v9"/></svg>
            </a>
        </div>
    </div>
</dialog>

<script>
(() => {
    const data  = @json($certData);
    const modal = document.getElementById('certModal');
    if (!modal || !data.length) return;

    const $ = (id) => document.getElementById(id);
    let idx = 0;

    const setText = (id, value) => {
        const el = $(id);
        el.textContent = value || '';
        el.classList.toggle('hidden', !value);
    };

    const render = () => {
        const c = data[idx];
        const img = $('certImg');
        img.src = c.src;
        img.alt = 'Sertifikat ' + c.title;
        $('certTitle').textContent  = c.title;
        $('certIssuer').textContent = c.issuer;
        $('certDate').textContent   = c.date;
        $('certCount').textContent  = (idx + 1) + ' dari ' + data.length;
        setText('certNote', c.note);
        setText('certDesc', c.desc);
        const link = $('certLink');
        link.classList.toggle('hidden', !c.url);
        link.classList.toggle('inline-flex', !!c.url);
        if (c.url) link.href = c.url;
    };

    const open = (i) => {
        idx = i;
        render();
        modal.showModal();
        document.documentElement.classList.add('overflow-hidden');
    };
    const step = (d) => { idx = (idx + d + data.length) % data.length; render(); };

    document.querySelectorAll('.cert-open').forEach((btn) => {
        btn.addEventListener('click', () => open(Number(btn.dataset.index)));
    });
    $('certClose').addEventListener('click', () => modal.close());
    $('certPrev').addEventListener('click', () => step(-1));
    $('certNext').addEventListener('click', () => step(1));
    modal.addEventListener('click', (e) => { if (e.target === modal) modal.close(); });
    modal.addEventListener('close', () => document.documentElement.classList.remove('overflow-hidden'));
    modal.addEventListener('keydown', (e) => {
        if (e.key === 'ArrowLeft')  step(-1);
        if (e.key === 'ArrowRight') step(1);
    });
})();
</script>

<script>
(() => {
    const modal = document.getElementById('ipModal');
    if (!modal) return;
    const frame = document.getElementById('ipFrame');
    const img   = document.getElementById('ipImg');
    const isPdf = (f) => /\.pdf($|\?)/i.test(f);

    document.querySelectorAll('.ip-open').forEach((btn) => {
        btn.addEventListener('click', () => {
            const file = btn.dataset.file;
            document.getElementById('ipTitle').textContent = btn.dataset.title || '';
            document.getElementById('ipMeta').textContent  = btn.dataset.meta || '';
            document.getElementById('ipLink').href = file;
            frame.classList.toggle('hidden', !isPdf(file));
            img.classList.toggle('hidden', isPdf(file));
            if (isPdf(file)) { frame.src = file + '#toolbar=0&navpanes=0'; img.removeAttribute('src'); }
            else { img.src = file; frame.removeAttribute('src'); }
            modal.showModal();
            document.documentElement.classList.add('overflow-hidden');
        });
    });
    document.getElementById('ipClose').addEventListener('click', () => modal.close());
    modal.addEventListener('click', (e) => { if (e.target === modal) modal.close(); });
    modal.addEventListener('close', () => {
        frame.removeAttribute('src'); img.removeAttribute('src');
        document.documentElement.classList.remove('overflow-hidden');
    });
})();
</script>

@endsection