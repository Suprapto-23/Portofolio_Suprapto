{{-- resources/views/home.blade.php --}}
@extends('layouts.app')

@section('content')
@php
    $P            = config('portfolio');
    $projects     = collect($P['projects'] ?? []);
    $certificates = collect($P['certificates'] ?? []);
    $stats        = $P['stats'] ?? [];
    $timeline     = $P['timeline'] ?? [];
    $orgs         = $P['organizations'] ?? [];
    $ip           = $P['ip'] ?? [];
    $about        = $P['about'] ?? [];
    $highlights   = $P['highlights'] ?? [];

    // Foto pribadi: public/images/profile.jpg (hero) dan public/images/about.jpg (opsional)
    $firstFile = function (array $paths) {
        foreach ($paths as $p) {
            if (file_exists(public_path($p))) { return asset($p); }
        }
        return null;
    };
    $heroPhoto  = $firstFile(['images/profile.jpg', 'images/profile.jpeg', 'images/profile.png', 'profile.png']);
    $aboutPhoto = $firstFile(['images/about.jpg', 'images/about.jpeg']);

    $links = [
        'github'   => 'https://github.com/Suprapto-23',
        'linkedin' => 'https://linkedin.com/in/supraptokulo',
        'email'    => 'ssuprapto351@gmail.com',
    ];

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
        'title'    => 'Implementasi Metode RAD dalam Rancang Bangun Sistem Informasi Manajemen Posyandu',
        'case'     => 'Studi Kasus: Desa Bantarkulon',
        'year'     => '2026',
        'summary'  => 'Penelitian ini merancang dan membangun sistem informasi manajemen Posyandu berbasis web untuk Posyandu Desa Bantarkulon sebagai solusi atas pencatatan manual. Pengembangan menggunakan metode Rapid Application Development (RAD) dengan Laravel, PHP, dan MySQL, kemudian diuji dengan Black Box Testing dan User Acceptance Testing (UAT).',
        'tags'     => ['Laravel', 'PHP', 'MySQL', 'RAD', 'RBAC'],
        'features' => [
            ['Pencatatan terpadu', 'Data sasaran Balita, Remaja, dan Lansia tersimpan dalam satu basis data.'],
            ['Hak akses berbasis peran', 'Role-Based Access Control untuk Admin, Bidan, Kader, dan Warga.'],
            ['Riwayat kesehatan', 'Penelusuran riwayat kesehatan setiap sasaran.'],
            ['Laporan operasional', 'Laporan operasional Posyandu disusun otomatis oleh sistem.'],
        ],
        'results'  => [
            ['Black Box Testing', 'Valid', 'Seluruh skenario fungsional valid'],
            ['User Acceptance Testing', '84,28%', 'Kategori “Sangat Layak”'],
            ['Hak Cipta Program Komputer', 'No. 001576590', 'Diumumkan 25 Juli 2026'],
        ],
        'live'     => 'https://sim-posyanducare.vercel.app',
    ];
    $thesisProject = $projects->first(fn ($p) => str_contains(strtolower($p['title'] ?? ''), 'posyandu'));

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
    html { scroll-behavior: smooth; }
    section[id] { scroll-margin-top: 90px; }
    .pra-grad-text { background: linear-gradient(90deg, #0A6CFF 0%, #25AEFF 100%); -webkit-background-clip: text; background-clip: text; color: transparent; }
    .pra-blob { position: absolute; border-radius: 50%; filter: blur(80px); pointer-events: none; }
    @keyframes praFloat { 0%, 100% { transform: translateY(0); } 50% { transform: translateY(-8px); } }
    .animate-float { animation: praFloat 6s ease-in-out infinite; }
    @keyframes praDot { 0%, 100% { box-shadow: 0 0 0 0 rgba(22,119,255,.45); } 50% { box-shadow: 0 0 0 7px rgba(22,119,255,0); } }
    .status-dot { animation: praDot 2s infinite; }
    @keyframes praPop { from { opacity: 0; transform: translateY(14px) scale(.98); } to { opacity: 1; transform: none; } }
    #certModal[open] { animation: praPop .28s ease-out; }
    #certModal::backdrop { background: rgba(11, 27, 58, .72); backdrop-filter: blur(4px); }
    @media (prefers-reduced-motion: reduce) {
        html { scroll-behavior: auto; }
        .animate-float, .status-dot, #certModal[open] { animation: none; }
    }
</style>

{{-- ======================= HERO ======================= --}}
<section id="home" class="relative overflow-hidden bg-white pb-20 pt-16 lg:pb-28 lg:pt-24">
    <div class="pra-blob right-[-10%] top-[-10%] h-[480px] w-[480px] bg-[#1677FF]/10"></div>
    <div class="pra-blob bottom-[-10%] left-[-10%] h-[380px] w-[380px] bg-[#7048FF]/10"></div>

    <div class="relative z-10 mx-auto max-w-[1180px] px-6">
        <div class="grid grid-cols-1 items-center gap-14 lg:grid-cols-12 lg:gap-10">

            {{-- Teks --}}
            <div class="text-center lg:col-span-7 lg:text-left" data-aos="fade-right">
                <div class="mb-6 inline-flex items-center gap-2.5 rounded-full border border-[#DCE7F5] bg-[#F4F9FF] px-4 py-2">
                    <span class="status-dot h-2 w-2 rounded-full bg-[#1677FF]"></span>
                    <span class="text-[13px] font-semibold text-[#1677FF]">Terbuka untuk posisi Junior Web Programmer</span>
                </div>

                <h1 class="mb-5 text-[38px] font-extrabold leading-[1.15] tracking-tight text-[#0B1B3A] md:text-[48px] lg:text-[54px]">
                    Suprapto, <span class="pra-grad-text">Junior Web Programmer</span>
                </h1>
                <p class="mb-5 text-[17px] font-semibold text-[#0B1B3A]">Pengembangan Web dan Sistem Informasi</p>

                <p class="mx-auto mb-6 max-w-[580px] text-[16px] leading-[1.8] text-[#64748B] lg:mx-0">
                    Lulusan S1 Teknologi Informasi ITSNU Pekalongan (IPK 3,76) dengan pengalaman mengembangkan sistem informasi berbasis web menggunakan Laravel, PHP, dan MySQL, mulai dari analisis kebutuhan dan perancangan basis data hingga pengujian dan pendampingan pengguna.
                </p>

                <div class="mx-auto mb-9 max-w-[580px] rounded-r-2xl border-l-4 border-[#1677FF] bg-[#F4F9FF] px-5 py-4 text-left lg:mx-0">
                    <p class="text-[13px] font-semibold text-[#1677FF]">Skripsi</p>
                    <p class="mt-1 text-[14.5px] leading-relaxed text-[#0B1B3A]">“{{ $thesis['title'] }} ({{ $thesis['case'] }})”, {{ $thesis['year'] }}</p>
                </div>

                <div class="flex flex-col items-center gap-4 sm:flex-row lg:justify-start">
                    <a href="#projects" class="inline-flex h-[52px] w-full items-center justify-center gap-2 rounded-full bg-gradient-to-r from-[#0A72FF] to-[#5F4FEE] px-8 text-[15px] font-semibold text-white shadow-[0_8px_20px_-6px_rgba(40,90,245,0.5)] transition-all duration-300 hover:-translate-y-1 hover:shadow-[0_12px_24px_-6px_rgba(40,90,245,0.7)] sm:w-auto">
                        Lihat Proyek
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m13 6 6 6-6 6"/></svg>
                    </a>
                    <a href="{{ route('contact') }}" class="inline-flex h-[52px] w-full items-center justify-center rounded-full border-[1.5px] border-[#D1E3FF] bg-white px-8 text-[15px] font-semibold text-[#1677FF] transition-all duration-300 hover:-translate-y-1 hover:border-[#1677FF] hover:bg-[#F4F9FF] sm:w-auto">
                        Hubungi Saya
                    </a>
                </div>

                <div class="mt-8 flex items-center justify-center gap-3 lg:justify-start">
                    <span class="text-[13px] font-medium text-[#64748B]">Terhubung:</span>
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

            {{-- Kartu foto dan data singkat --}}
            <div class="relative lg:col-span-5" data-aos="fade-left" data-aos-delay="100">
                <div class="relative mx-auto w-full max-w-[400px]">
                    <div class="absolute -inset-3 rounded-[36px] bg-gradient-to-tr from-[#1677FF]/25 to-[#7048FF]/25 blur-2xl"></div>

                    <div class="relative overflow-hidden rounded-[28px] border border-white/70 bg-white shadow-[0_20px_50px_-20px_rgba(22,119,255,0.35)]">
                        <div class="relative aspect-[10/11] bg-gradient-to-br from-[#EAF3FF] to-[#DDE6FF]">
                            @if($heroPhoto)
                                <img src="{{ $heroPhoto }}" alt="Foto Suprapto" class="h-full w-full object-cover object-top">
                            @else
                                <div class="flex h-full w-full items-center justify-center bg-gradient-to-br from-[#0A6CFF] to-[#5F4FEE]">
                                    <span class="text-[110px] font-extrabold text-white/90">S</span>
                                </div>
                            @endif
                            <div class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-[#0B1B3A]/85 to-transparent px-6 pb-5 pt-16">
                                <p class="text-[19px] font-bold text-white">Suprapto, S.Kom.</p>
                                <p class="text-[13.5px] font-medium text-white/85">Junior Web Programmer (BNSP)</p>
                            </div>
                        </div>

                        <dl class="space-y-3 p-6 text-[14px]">
                            <div class="flex justify-between gap-4"><dt class="text-[#64748B]">Pendidikan</dt><dd class="text-right font-semibold text-[#0B1B3A]">S1 Teknologi Informasi</dd></div>
                            <div class="flex justify-between gap-4"><dt class="text-[#64748B]">Kampus</dt><dd class="text-right font-semibold text-[#0B1B3A]">ITSNU Pekalongan</dd></div>
                            <div class="flex justify-between gap-4"><dt class="text-[#64748B]">IPK</dt><dd class="font-semibold text-[#0B1B3A]">3,76</dd></div>
                            <div class="flex justify-between gap-4"><dt class="text-[#64748B]">Sertifikasi</dt><dd class="text-right font-semibold text-[#0B1B3A]">BNSP Junior Web Programmer</dd></div>
                            <div class="flex justify-between gap-4"><dt class="text-[#64748B]">Domisili</dt><dd class="text-right font-semibold text-[#0B1B3A]">Kab. Pekalongan, Jawa Tengah</dd></div>
                        </dl>
                    </div>

                    <div class="animate-float absolute -left-6 top-10 hidden items-center gap-3 rounded-2xl border border-[#DCE7F5] bg-white px-4 py-3 shadow-lg md:flex">
                        <span class="flex h-9 w-9 items-center justify-center rounded-xl bg-[#EAF6FF] text-[#1677FF]">
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m5 12 5 5L20 7"/></svg>
                        </span>
                        <span class="leading-tight"><span class="block text-[15px] font-bold text-[#0B1B3A]">UAT 84,28%</span><span class="text-[12px] text-[#64748B]">Sangat Layak</span></span>
                    </div>
                    <div class="animate-float absolute -right-6 bottom-[38%] hidden items-center gap-3 rounded-2xl border border-[#DCE7F5] bg-white px-4 py-3 shadow-lg md:flex" style="animation-delay: 1.5s">
                        <span class="flex h-9 w-9 items-center justify-center rounded-xl bg-[#EEF0FF] text-[#5F4FEE]">
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="9" r="6"/><path d="m8.5 14-1.5 8 5-3 5 3-1.5-8"/></svg>
                        </span>
                        <span class="leading-tight"><span class="block text-[15px] font-bold text-[#0B1B3A]">2 Hak Cipta</span><span class="text-[12px] text-[#64748B]">Program Komputer</span></span>
                    </div>
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
                    </dl>
                    <a href="#thesis" class="mt-5 inline-flex items-center gap-1.5 text-[13.5px] font-semibold text-[#1677FF] hover:text-[#0A6CFF]">
                        Lihat ringkasan skripsi
                        <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M19 14l-7 7m0 0l-7-7m7 7V3"/></svg>
                    </a>
                </div>

                <div class="flex items-start gap-4 rounded-[22px] border border-[#DCE7F5] bg-white p-6">
                    <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-[#EEF0FF] text-[#5F4FEE]">
                        <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="9" r="6"/><path d="m8.5 14-1.5 8 5-3 5 3-1.5-8"/></svg>
                    </div>
                    <div>
                        <h3 class="text-[16px] font-bold text-[#0B1B3A]">Sertifikat Kompetensi BNSP</h3>
                        <p class="text-[14px] text-[#64748B]">Junior Web Programmer · LSP TIKOM</p>
                        <p class="mt-1 text-[13.5px] font-medium text-[#0B1B3A]">Terbit 18 September 2026, berlaku hingga 18 September 2029</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ======================= SKRIPSI ======================= --}}
<section id="thesis" class="border-y border-[#DCE7F5]/60 bg-[#FAFCFF] py-20 lg:py-24">
    <div class="mx-auto max-w-[1180px] px-6">
        <div class="mb-12 max-w-2xl">
            <span class="mb-2 block text-[13px] font-semibold text-[#1677FF]">Karya akhir S1</span>
            <h2 class="text-[32px] font-bold text-[#0B1B3A] md:text-[38px]">Skripsi</h2>
        </div>

        <div class="grid overflow-hidden rounded-[28px] border border-[#DCE7F5] bg-white shadow-[0_20px_40px_-24px_rgba(11,27,58,0.18)] lg:grid-cols-5">
            <div class="p-8 lg:col-span-3 lg:p-12">
                <div class="mb-5 flex flex-wrap gap-2">
                    @foreach($thesis['tags'] as $tag)
                        <span class="rounded-md bg-[#EAF6FF] px-3 py-1 text-[12px] font-semibold text-[#1677FF]">{{ $tag }}</span>
                    @endforeach
                </div>

                <h3 class="text-[24px] font-bold leading-snug text-[#0B1B3A] md:text-[28px]">{{ $thesis['title'] }}</h3>
                <p class="mt-2 text-[15px] font-semibold text-[#1677FF]">{{ $thesis['case'] }} · {{ $thesis['year'] }}</p>
                <p class="mt-5 text-[15px] leading-[1.85] text-[#64748B]">{{ $thesis['summary'] }}</p>

                <h4 class="mb-4 mt-8 text-[14px] font-bold text-[#0B1B3A]">Cakupan sistem</h4>
                <div class="grid gap-4 sm:grid-cols-2">
                    @foreach($thesis['features'] as [$ft, $fd])
                        <div class="flex items-start gap-3 rounded-2xl border border-[#DCE7F5] bg-[#FAFCFF] p-4">
                            <svg class="mt-0.5 h-5 w-5 shrink-0 text-[#1677FF]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m5 12 5 5L20 7"/></svg>
                            <div>
                                <p class="text-[14px] font-semibold text-[#0B1B3A]">{{ $ft }}</p>
                                <p class="mt-0.5 text-[13px] leading-relaxed text-[#64748B]">{{ $fd }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-8 flex flex-wrap items-center gap-5">
                    <a href="{{ $thesis['live'] }}" target="_blank" rel="noopener noreferrer" class="inline-flex h-[46px] items-center justify-center rounded-full bg-gradient-to-r from-[#0A72FF] to-[#5F4FEE] px-6 text-[14px] font-semibold text-white transition hover:-translate-y-0.5">
                        Buka Sistem
                    </a>
                    @if($thesisProject)
                        <a href="{{ route('projects.show', $thesisProject['slug']) }}" class="text-[14px] font-semibold text-[#1677FF] hover:text-[#0A6CFF]">Detail dan dokumentasi</a>
                    @endif
                </div>
            </div>

            <div class="bg-gradient-to-br from-[#063B91] via-[#126BFF] to-[#7147FF] p-8 text-white lg:col-span-2 lg:p-12">
                <h4 class="mb-6 text-[15px] font-semibold text-white/90">Hasil pengujian dan pengakuan</h4>
                <div class="space-y-4">
                    @foreach($thesis['results'] as [$rl, $rv, $rn])
                        <div class="rounded-2xl border border-white/20 bg-white/10 p-5 backdrop-blur">
                            <p class="text-[13px] font-medium text-white/80">{{ $rl }}</p>
                            <p class="mt-1 text-[28px] font-extrabold leading-tight">{{ $rv }}</p>
                            <p class="mt-1 text-[13px] text-white/80">{{ $rn }}</p>
                        </div>
                    @endforeach
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
                            <span class="rounded-full border border-[#DCE7F5] bg-[#F4F9FF] px-4 py-1.5 text-[13px] font-semibold text-[#0B1B3A]">{{ $item['period'] }}</span>
                        </div>
                        @if(!empty($item['note']))
                            <p class="mt-2 text-[13.5px] italic text-[#64748B]">{{ $item['note'] }}</p>
                        @endif
                        <ul class="mt-5 space-y-2.5 text-[14.5px] leading-relaxed text-[#475569]">
                            @foreach($item['bullets'] as $b)
                                <li class="flex items-start gap-3">
                                    <span class="mt-2.5 h-1.5 w-1.5 shrink-0 rounded-full bg-[#1677FF]"></span>
                                    <span>{{ $b }}</span>
                                </li>
                            @endforeach
                        </ul>
                        @if(!empty($item['link']))
                            <a href="{{ $item['link']['url'] }}" target="_blank" rel="noopener noreferrer" class="mt-5 inline-flex items-center gap-1.5 text-[13.5px] font-semibold text-[#1677FF] hover:text-[#0A6CFF]">
                                {{ $item['link']['label'] }}
                                <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M7 17 17 7M8 7h9v9"/></svg>
                            </a>
                        @endif
                    </article>
                </li>
            @endforeach
        </ol>

        @if(count($orgs))
            <h3 class="mb-5 mt-14 text-[18px] font-bold text-[#0B1B3A]">Organisasi dan kegiatan</h3>
            <div class="grid gap-5 md:grid-cols-2">
                @foreach($orgs as [$oTitle, $oOrg, $oDate, $oNote])
                    <div class="rounded-[20px] border border-[#DCE7F5] bg-[#FAFCFF] p-6">
                        <p class="text-[13px] font-semibold text-[#1677FF]">{{ $oDate }}</p>
                        <h4 class="mt-1 text-[15.5px] font-bold leading-snug text-[#0B1B3A]">{{ $oTitle }}</h4>
                        <p class="mt-1 text-[13.5px] text-[#64748B]">{{ $oOrg }}</p>
                        @if($oNote)
                            <p class="mt-2 text-[13.5px] leading-relaxed text-[#64748B]">{{ $oNote }}</p>
                        @endif
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
                <article class="flex flex-col rounded-[22px] border border-[#DCE7F5] bg-white p-7 shadow-sm transition duration-300 hover:border-[#1677FF]/40">
                    <span class="mb-4 self-start rounded-md bg-[#EAF6FF] px-3 py-1 text-[12px] font-semibold text-[#1677FF]">{{ $type }}</span>
                    <h3 class="mb-3 text-[16.5px] font-bold leading-snug text-[#0B1B3A]">{{ $title }}</h3>
                    <p class="mb-1 text-[13.5px] font-semibold text-[#0B1B3A]">{{ $meta }}</p>
                    <p class="text-[13px] leading-relaxed text-[#64748B]">{{ $note }}</p>
                    @if($url)
                        <a href="{{ $url }}" target="_blank" rel="noopener noreferrer" class="mt-5 inline-flex items-center gap-1.5 text-[13px] font-bold text-[#1677FF] hover:text-[#0A6CFF]">
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
                <article class="group overflow-hidden rounded-[20px] border border-[#DCE7F5] bg-white shadow-sm transition duration-300 hover:-translate-y-1.5 hover:border-[#1677FF]/40 hover:shadow-[0_18px_36px_-14px_rgba(22,119,255,0.28)]">
                    <button type="button" data-index="{{ $loop->index }}" aria-label="Lihat sertifikat {{ $cert['title'] }}"
                            class="cert-open relative block aspect-[4/3] w-full cursor-zoom-in overflow-hidden bg-[#F4F9FF] focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-[-2px] focus-visible:outline-[#1677FF]">
                        <img src="{{ asset($cert['image']) }}" alt="Sertifikat {{ $cert['title'] }}" loading="lazy"
                             class="h-full w-full object-cover object-top transition duration-700 ease-out group-hover:scale-[1.06]">
                        <span class="absolute inset-0 flex items-end justify-center bg-gradient-to-t from-[#0B1B3A]/70 via-[#0B1B3A]/10 to-transparent pb-4 opacity-0 transition duration-300 group-hover:opacity-100 group-focus-within:opacity-100">
                            <span class="inline-flex translate-y-2 items-center gap-2 rounded-full bg-white/95 px-4 py-2 text-[13px] font-semibold text-[#0B1B3A] shadow transition duration-300 group-hover:translate-y-0 group-focus-within:translate-y-0">
                                <svg class="h-4 w-4 text-[#1677FF]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="7"/><path d="m21 21-4.3-4.3M11 8v6M8 11h6"/></svg>
                                Lihat sertifikat
                            </span>
                        </span>
                    </button>
                    <div class="p-5">
                        <h3 class="mb-1.5 line-clamp-3 text-[15px] font-bold leading-snug text-[#0B1B3A]">{{ $cert['title'] }}</h3>
                        <p class="text-[13px] font-medium text-[#64748B]">{{ $cert['issuer'] }}</p>
                        <p class="mt-1 text-[13px] text-[#64748B]">{{ $cert['date'] }}</p>
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

@endsection