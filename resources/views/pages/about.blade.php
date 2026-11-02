@extends('layouts.app')

@section('content')
@php
    $P      = config('portfolio');
    $S      = config('portfolio_site');
    $thesis = $S['thesis'];
    $links  = $S['links'];
    $photo  = \App\Support\Img::url('about_photo');
    $cvUrl  = (!empty($S['cv']['file']) && is_file(public_path($S['cv']['file']))) ? asset($S['cv']['file']) : null;
    $edu    = $P['education'] ?? [];
    $eduChips = array_values(array_filter(array_map('trim', explode('·', $edu['gpa'] ?? ''))));
    $thesisProject = collect($P['projects'] ?? [])->first(fn ($p) => str_contains(strtolower($p['title'] ?? ''), 'posyandu'));

    $sections = [
        ['pendidikan', 'Pendidikan'],
        ['pengalaman', 'Pengalaman'],
        ['kegiatan', 'Organisasi dan kegiatan'],
        ['hak-cipta', 'Hak cipta dan publikasi'],
        ['sertifikasi', 'Sertifikasi'],
    ];

    // Ringkasan angka selama kuliah (sesuai CV)
    $eduStats = [
        ['3,76', 'IPK'],
        ['2', 'Hak Cipta Program Komputer'],
        ['1', 'Artikel Jurnal SOLMA 2026'],
        ['BNSP', 'Sertifikasi Junior Web Programmer'],
    ];

    // Isi kartu "selama kuliah": [judul, keterangan, ikon, daftar poin]
    $eduColumns = [
        [
            'Diraih', 'Capaian dan pengakuan karya',
            'M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z',
            [
                'Lulus S1 dengan IPK 3,76 dan ijazah telah terbit.',
                'Nilai A pada Program PKM Pengabdian Masyarakat (Hibah DPPM Kemdiktisaintek 2025).',
                'Dua Hak Cipta Program Komputer sebagai pencipta bersama.',
                'Penulis (anggota tim) artikel Jurnal SOLMA 15(1), 2026.',
                'Sertifikat Kompetensi BNSP Junior Web Programmer.',
                'Skripsi: Black Box Testing valid dan UAT 84,28% (Sangat Layak).',
            ],
        ],
        [
            'Diikuti', 'Pengalaman dan kegiatan',
            'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z',
            [
                'Magang Backend Developer di Creatifla Multimedia (Januari – Februari 2025).',
                'Program PKM bersama Pokdarwis Lolong Adventure (Maret – Agustus 2025).',
                'LKMM-TD HIMATIF ITSNU Pekalongan (Desember 2022).',
                'Panitia Workshop Pemrograman HTML dan CSS (Mei 2025).',
                'Workshop UI/UX, kuliah umum cybersecurity, seminar technopreneurship dan entrepreneur, serta webinar karir.',
            ],
        ],
        [
            'Dikembangkan', 'Karya dan kemampuan',
            'M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4',
            [
                'Sistem pemesanan tiket wisata Lolong Adventure yang dipakai untuk transaksi nyata.',
                'SIM PosyanduCare (skripsi), SapiSehat, dan Website Desa Windujaji.',
                'PHP, Laravel, dan MySQL, termasuk integrasi WhatsApp Blast API saat magang.',
                'Penerapan metode RAD dan Role-Based Access Control (RBAC).',
                'Pendampingan pengguna: pelatihan sistem bagi 20 anggota Pokdarwis.',
                'Kerja tim lintas peran dan komunikasi dengan mitra.',
            ],
        ],
    ];

    $arrow = '<svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M7 17 17 7M8 7h9v9"/></svg>';
@endphp

<!-- PROFIL -->
<section class="relative overflow-hidden bg-white pb-14 pt-24 lg:pb-20 lg:pt-32">
    <div class="pra-blob absolute right-[-10%] top-[-10%] h-[420px] w-[420px] rounded-full bg-[#1677FF]/10 blur-[80px]"></div>
    <div class="relative z-10 mx-auto grid max-w-[1180px] grid-cols-1 gap-12 px-6 lg:grid-cols-12 lg:items-stretch lg:gap-14">

        <div class="lg:col-span-7 lg:flex lg:flex-col lg:justify-center">
            <h1 class="text-[36px] font-extrabold leading-tight tracking-tight text-[#0B1B3A] md:text-[44px]">Suprapto, S.Kom.</h1>
            <p class="mb-7 mt-2 text-[16px] font-semibold text-[#1677FF]">Junior Web Programmer (BNSP) · Pengembangan Web dan Sistem Informasi</p>

            @foreach($P['about'] ?? [] as $para)
                <p class="mb-5 max-w-[640px] text-[16px] leading-[1.8] text-[#64748B]">{{ $para }}</p>
            @endforeach

            <div class="mt-4 flex flex-wrap gap-3">
                <a href="{{ route('projects') }}" class="inline-flex h-[48px] items-center rounded-full bg-gradient-to-r from-[#0A72FF] to-[#5F4FEE] px-7 text-[14.5px] font-semibold text-white shadow-[0_8px_20px_-6px_rgba(40,90,245,0.5)] transition-all hover:-translate-y-1">Lihat Proyek Saya</a>
                <a href="{{ route('contact') }}" class="inline-flex h-[48px] items-center rounded-full border-[1.5px] border-[#D1E3FF] bg-white px-7 text-[14.5px] font-semibold text-[#1677FF] transition-all hover:-translate-y-1 hover:bg-[#F4F9FF]">Hubungi Saya</a>
                @if($cvUrl)
                    <a href="{{ $cvUrl }}" target="_blank" rel="noopener noreferrer" class="inline-flex h-[48px] items-center rounded-full px-5 text-[14.5px] font-semibold text-[#0B1B3A] transition hover:text-[#1677FF]">{{ $S['cv']['label'] ?? 'Unduh CV' }}</a>
                @endif
            </div>
        </div>

        <div class="lg:col-span-5">
            <div class="relative mx-auto aspect-[4/5] w-full max-w-[380px] overflow-hidden rounded-[28px] border border-[#DCE7F5] bg-gradient-to-br from-[#EAF3FF] to-[#DDE6FF] shadow-[0_24px_50px_-24px_rgba(22,119,255,0.35)] lg:mx-0 lg:aspect-auto lg:h-full lg:min-h-[420px] lg:max-w-none">
                @if($photo)
                    <img src="{{ $photo }}" alt="Foto Suprapto" class="absolute inset-0 h-full w-full object-cover object-top">
                @else
                    <div class="absolute inset-0 flex items-center justify-center bg-gradient-to-br from-[#0A6CFF] to-[#5F4FEE]"><span class="text-[110px] font-extrabold text-white/90">S</span></div>
                @endif
            </div>
        </div>
    </div>
</section>

<!-- DATA SINGKAT + NAVIGASI BAGIAN -->
@php
    $factIcons = [
        'M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.242-4.243a8 8 0 1111.314 0zM15 11a3 3 0 11-6 0 3 3 0 016 0z',
        'M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z',
        'M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z',
        'M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z',
    ];
@endphp
<section class="border-y border-[#DCE7F5]/70 bg-[#FAFCFF] py-8">
    <div class="mx-auto max-w-[1180px] px-6">
        <dl class="grid grid-cols-1 gap-3 sm:grid-cols-2 lg:grid-cols-4">
            @foreach($S['facts'] ?? [] as [$k, $v])
                <div class="flex items-center gap-3.5 rounded-2xl border border-[#DCE7F5] bg-white p-4">
                    <span class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-[#EAF6FF] text-[#1677FF]">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="{{ $factIcons[$loop->index] ?? $factIcons[0] }}"/></svg>
                    </span>
                    <div class="min-w-0">
                        <dt class="text-[12px] font-semibold uppercase tracking-wider text-[#64748B]">{{ $k }}</dt>
                        <dd class="mt-0.5 text-[14.5px] font-bold leading-snug text-[#0B1B3A]">{{ $v }}</dd>
                    </div>
                </div>
            @endforeach
        </dl>

        <nav aria-label="Bagian halaman" class="mt-6 flex flex-wrap justify-center gap-2">
            @foreach($sections as [$id, $label])
                <a href="#{{ $id }}" class="rounded-full border border-[#DCE7F5] bg-white px-4 py-1.5 text-[13px] font-semibold text-[#0B1B3A] transition hover:border-[#1677FF] hover:bg-[#F4F9FF] hover:text-[#1677FF]">{{ $label }}</a>
            @endforeach
        </nav>
    </div>
</section>

<!-- PENDIDIKAN, PERJALANAN KULIAH & SKRIPSI -->
<section id="pendidikan" class="scroll-mt-24 bg-white py-20">
    <div class="mx-auto max-w-[980px] px-6">
        <div class="mb-10">
            <span class="mb-2 block text-[13px] font-semibold text-[#1677FF]">Latar belakang</span>
            <h2 class="text-[30px] font-bold text-[#0B1B3A] md:text-[34px]">Pendidikan</h2>
        </div>

        {{-- Kartu utama: identitas studi + narasi + angka ringkas (tanpa foto) --}}
        <article class="overflow-hidden rounded-[24px] border border-[#DCE7F5] bg-white shadow-sm">
            <div class="p-7 lg:p-9">
                <div class="flex flex-wrap items-center gap-2">
                    <span class="rounded-md bg-[#EAF6FF] px-3 py-1 text-[12.5px] font-semibold text-[#1677FF]">{{ $edu['period'] ?? '' }}</span>
                    @foreach($eduChips as $chip)
                        <span class="rounded-md border border-[#DCE7F5] bg-[#FAFCFF] px-3 py-1 text-[12.5px] font-semibold text-[#0B1B3A]">{{ $chip }}</span>
                    @endforeach
                </div>

                <h3 class="mt-4 text-[24px] font-bold leading-snug text-[#0B1B3A] md:text-[26px]">{{ $edu['degree'] ?? '' }}</h3>
                <p class="mt-1 text-[15px] text-[#64748B]">{{ $edu['school'] ?? '' }}</p>

                <div class="mt-6 max-w-[780px] space-y-4 text-[15.5px] leading-[1.85] text-[#64748B]">
                    <p>Selama kuliah, saya memadukan perkuliahan dengan pengalaman langsung: magang sebagai Backend Developer, membangun sistem pemesanan tiket untuk mitra melalui program PKM, hingga menyelesaikan skripsi berupa sistem informasi Posyandu.</p>
                    <p>Di luar kelas, saya mengikuti organisasi, kepanitiaan, seminar, dan pelatihan agar kemampuan teknis berjalan bersama kerja tim, komunikasi, dan wawasan bisnis digital.</p>
                    @if(!empty($edu['points'][0]))
                        <p>{{ $edu['points'][0] }}</p>
                    @endif
                </div>
            </div>

            <div class="grid grid-cols-2 gap-3 border-t border-[#DCE7F5] bg-[#FAFCFF] p-5 lg:grid-cols-4 lg:px-9">
                @foreach($eduStats as [$val, $lab])
                    <div class="rounded-2xl border border-[#DCE7F5] bg-white p-4">
                        <p class="text-[24px] font-extrabold leading-none text-[#0B1B3A]">{{ $val }}</p>
                        <p class="mt-2 text-[12.5px] leading-snug text-[#64748B]">{{ $lab }}</p>
                    </div>
                @endforeach
            </div>
        </article>

        {{-- Diraih, diikuti, dikembangkan --}}
        <div class="mb-3 mt-10">
            <h3 class="text-[20px] font-bold text-[#0B1B3A]">Selama menjadi mahasiswa</h3>
            <p class="mt-1 text-[14.5px] text-[#64748B]">Yang sudah saya raih, ikuti, dan kembangkan.</p>
        </div>
        <div class="grid gap-5 lg:grid-cols-3">
            @foreach($eduColumns as [$ct, $cs, $icon, $items])
                <div class="flex flex-col rounded-[22px] border border-[#DCE7F5] bg-white p-6 shadow-sm">
                    <div class="mb-5 flex items-center gap-3">
                        <span class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-[#EAF6FF] text-[#1677FF]">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="{{ $icon }}"/></svg>
                        </span>
                        <div>
                            <h4 class="text-[16px] font-bold leading-tight text-[#0B1B3A]">{{ $ct }}</h4>
                            <p class="text-[12.5px] text-[#64748B]">{{ $cs }}</p>
                        </div>
                    </div>
                    <ul class="flex flex-col gap-3">
                        @foreach($items as $item)
                            <li class="flex items-start gap-2.5 text-[14px] leading-relaxed text-[#475569]">
                                <svg class="mt-1 h-4 w-4 shrink-0 text-[#1677FF]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m5 12 5 5L20 7"/></svg>
                                <span>{{ $item }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endforeach
        </div>

        {{-- Skripsi --}}
        <div class="mt-10 overflow-hidden rounded-[24px] border border-[#DCE7F5] bg-[#FAFCFF]">
            <div class="p-7 lg:p-9">
                <span class="mb-3 inline-block rounded-md bg-[#EAF6FF] px-3 py-1 text-[12px] font-semibold text-[#1677FF]">Skripsi</span>
                <h3 class="text-[21px] font-bold leading-snug text-[#0B1B3A] md:text-[24px]">{{ $thesis['title'] }}</h3>
                <p class="mt-1.5 text-[14.5px] font-semibold text-[#1677FF]">{{ $thesis['case'] }} · {{ $thesis['year'] }}</p>
                <p class="mt-4 text-[15px] leading-[1.85] text-[#64748B]">{{ $thesis['summary'] }}</p>

                <h4 class="mb-3 mt-7 text-[14px] font-bold text-[#0B1B3A]">Cakupan sistem</h4>
                <div class="grid gap-3 sm:grid-cols-2">
                    @foreach($thesis['features'] as [$ft, $fd])
                        <div class="flex items-start gap-3 rounded-2xl border border-[#DCE7F5] bg-white p-4">
                            <svg class="mt-0.5 h-5 w-5 shrink-0 text-[#1677FF]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m5 12 5 5L20 7"/></svg>
                            <div>
                                <p class="text-[14px] font-semibold text-[#0B1B3A]">{{ $ft }}</p>
                                <p class="mt-0.5 text-[13px] leading-relaxed text-[#64748B]">{{ $fd }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="border-t border-[#DCE7F5] bg-white p-7 lg:px-9">
                <h4 class="mb-4 text-[14px] font-bold text-[#0B1B3A]">Luaran</h4>
                <div class="grid gap-3 sm:grid-cols-3">
                    @foreach($thesis['outputs'] as [$ol, $ov, $on])
                        <div class="rounded-2xl bg-[#F4F9FF] p-4">
                            <p class="text-[12.5px] font-medium text-[#64748B]">{{ $ol }}</p>
                            <p class="mt-1 text-[20px] font-extrabold leading-tight text-[#0B1B3A]">{{ $ov }}</p>
                            <p class="mt-1 text-[12.5px] text-[#64748B]">{{ $on }}</p>
                        </div>
                    @endforeach
                </div>
                <div class="mt-5 flex flex-wrap items-center gap-x-6 gap-y-2 text-[14px] font-semibold">
                    <a href="{{ $thesis['live'] }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-1.5 text-[#1677FF] hover:text-[#0A6CFF]">Buka sistem {!! $arrow !!}</a>
                    @if($thesisProject)
                        <a href="{{ route('projects.show', $thesisProject['slug']) }}" class="text-[#1677FF] hover:text-[#0A6CFF]">Detail dan dokumentasi proyek</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

<!-- PENGALAMAN -->
<section id="pengalaman" class="scroll-mt-24 border-y border-[#DCE7F5]/60 bg-[#FAFCFF] py-20">
    <div class="mx-auto max-w-[980px] px-6">
        <div class="mb-10">
            <span class="mb-2 block text-[13px] font-semibold text-[#1677FF]">Rekam jejak</span>
            <h2 class="text-[30px] font-bold text-[#0B1B3A] md:text-[34px]">Pengalaman</h2>
        </div>

        <div class="flex flex-col gap-6">
            @foreach($P['experiences'] ?? [] as $exp)
                @php
                    $expEntry = [
                        'period' => $exp['period'] ?? '',
                        'title'  => $exp['role'] ?? '',
                        'org'    => $exp['org'] ?? '',
                        'points' => $exp['points'] ?? [],
                        'tags'   => $exp['tags'] ?? [],
                        'links'  => $exp['links'] ?? [],
                        'photos' => \App\Support\Img::existing($exp['photos'] ?? []),
                        'group'  => 'experience-' . Str::slug($exp['role'] ?? 'pengalaman'),
                    ];
                @endphp
                <div id="pengalaman-{{ $loop->iteration }}" class="scroll-mt-28">
                    @include('partials.entry-card', ['entry' => $expEntry])
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- ORGANISASI & KEGIATAN -->
<section id="kegiatan" class="scroll-mt-24 bg-white py-20">
    <div class="mx-auto max-w-[980px] px-6">
        <div class="mb-10">
            <span class="mb-2 block text-[13px] font-semibold text-[#1677FF]">Di luar perkuliahan</span>
            <h2 class="text-[30px] font-bold text-[#0B1B3A] md:text-[34px]">Organisasi dan Kegiatan</h2>
        </div>

        <div class="flex flex-col gap-6">
            @foreach($P['activities'] ?? [] as $act)
                @php
                    $actEntry = [
                        'title'  => $act[0] ?? ($act['title'] ?? ''),
                        'org'    => trim(($act[1] ?? ($act['org'] ?? '')) . ' · ' . ($act[2] ?? ($act['time'] ?? '')), ' ·'),
                        'desc'   => $act[3] ?? ($act['desc'] ?? ''),
                        'photos' => \App\Support\Img::existing($act[4] ?? ($act['photos'] ?? [])),
                        'group'  => 'activity-' . Str::slug($act[0] ?? ($act['title'] ?? 'kegiatan')),
                    ];
                @endphp
                <div id="kegiatan-{{ $loop->iteration }}" class="scroll-mt-28">
                    @include('partials.entry-card', ['entry' => $actEntry])
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- HAK CIPTA & PUBLIKASI -->
@if(count($P['ip'] ?? []))
<section id="hak-cipta" class="scroll-mt-24 border-y border-[#DCE7F5]/60 bg-[#FAFCFF] py-20">
    <div class="mx-auto max-w-[980px] px-6">
        <div class="mb-10">
            <span class="mb-2 block text-[13px] font-semibold text-[#1677FF]">Pengakuan karya</span>
            <h2 class="text-[30px] font-bold text-[#0B1B3A] md:text-[34px]">Hak Cipta dan Publikasi Ilmiah</h2>
        </div>

        <div class="flex flex-col gap-4">
            @foreach($P['ip'] as [$type, $title, $meta, $note, $url])
                <article class="rounded-[20px] border border-[#DCE7F5] bg-white p-6 shadow-sm">
                    <span class="mb-3 inline-block rounded-md bg-[#EAF6FF] px-3 py-1 text-[12px] font-semibold text-[#1677FF]">{{ $type }}</span>
                    <h3 class="text-[16.5px] font-bold leading-snug text-[#0B1B3A]">{{ $title }}</h3>
                    <p class="mt-2 text-[13.5px] font-semibold text-[#0B1B3A]">{{ $meta }}</p>
                    <p class="mt-0.5 text-[13px] text-[#64748B]">{{ $note }}</p>
                    <div class="mt-3 flex flex-wrap gap-x-6 gap-y-1 text-[13.5px] font-bold">
                        @if($url)
                            <a href="{{ $url }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-1.5 text-[#1677FF] hover:text-[#0A6CFF]">Buka artikel {!! $arrow !!}</a>
                        @else
                            <a href="{{ url('/') }}#publications" class="text-[#1677FF] hover:text-[#0A6CFF]">Lihat surat pencatatan</a>
                        @endif
                    </div>
                </article>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- SERTIFIKASI -->
@if(count($P['certificates'] ?? []))
<section id="sertifikasi" class="scroll-mt-24 bg-white py-20">
    <div class="mx-auto max-w-[980px] px-6">
        <div class="mb-10 flex flex-col justify-between gap-3 md:flex-row md:items-end">
            <div>
                <span class="mb-2 block text-[13px] font-semibold text-[#1677FF]">Validasi kompetensi</span>
                <h2 class="text-[30px] font-bold text-[#0B1B3A] md:text-[34px]">Sertifikasi dan Pelatihan</h2>
            </div>
            <a href="{{ url('/') }}#certificates" class="text-[14px] font-semibold text-[#1677FF] hover:text-[#0A6CFF]">Lihat salinan sertifikat</a>
        </div>

        <ul class="divide-y divide-[#EEF3FA] rounded-[22px] border border-[#DCE7F5] bg-white shadow-sm">
            @foreach($P['certificates'] as $c)
                <li class="flex flex-col gap-1 px-6 py-4 sm:flex-row sm:items-center sm:justify-between sm:gap-6">
                    <div>
                        <p class="text-[14.5px] font-bold text-[#0B1B3A]">{{ $c['title'] }}</p>
                        <p class="text-[13px] text-[#64748B]">{{ $c['issuer'] }}</p>
                    </div>
                    <p class="text-[13px] font-medium text-[#0B1B3A] sm:text-right">{{ $c['date'] }}</p>
                </li>
            @endforeach
        </ul>
    </div>
</section>
@endif

<!-- AJAKAN -->
<section class="bg-[#FAFCFF] pb-24 pt-4">
    <div class="mx-auto max-w-[980px] px-6">
        <div class="flex flex-col items-start justify-between gap-6 rounded-[28px] bg-gradient-to-br from-[#063B91] via-[#126BFF] to-[#7147FF] p-10 md:flex-row md:items-center">
            <div class="max-w-md">
                <h2 class="text-[26px] font-extrabold leading-tight text-white">Terbuka untuk magang dan posisi junior</h2>
                <p class="mt-2 text-[15px] leading-relaxed text-white/85">Hubungi saya untuk diskusi lebih lanjut.</p>
            </div>
            <a href="{{ route('contact') }}" class="inline-flex h-[48px] items-center rounded-full bg-white px-7 text-[14.5px] font-bold text-[#0B1B3A] shadow-lg transition hover:-translate-y-0.5">Hubungi Saya</a>
        </div>
    </div>
</section>

{{-- SKRIP SLIDER GLOBAL --}}
<script>
(() => {
    if (window.__entrySliderReady) return;
    window.__entrySliderReady = true;

    const trackOf = (root) => root.querySelector('[data-track]');

    const updateCounter = (root) => {
        const t = trackOf(root);
        const counter = root.querySelector('[data-counter]');
        if (!t || !counter) return;
        const total = t.children.length;
        const i = Math.min(total - 1, Math.round(t.scrollLeft / t.clientWidth));
        counter.textContent = (i + 1) + ' / ' + total;
    };

    document.addEventListener('click', (e) => {
        const btn = e.target.closest('[data-prev], [data-next]');
        if (!btn) return;
        const sliderRoot = btn.closest('[data-slider]');
        if (!sliderRoot) return;

        const t = trackOf(sliderRoot);
        if (!t) return;

        const dir = btn.hasAttribute('data-next') ? 1 : -1;
        const max = t.scrollWidth - t.clientWidth;

        if (dir > 0 && t.scrollLeft >= max - 4) {
            t.scrollTo({ left: 0, behavior: 'smooth' });
        } else if (dir < 0 && t.scrollLeft <= 4) {
            t.scrollTo({ left: max, behavior: 'smooth' });
        } else {
            t.scrollBy({ left: dir * t.clientWidth, behavior: 'smooth' });
        }
    });

    document.addEventListener('scroll', (e) => {
        if (e.target.matches && e.target.matches('[data-track]')) {
            updateCounter(e.target.closest('[data-slider]'));
        }
    }, true);
})();
</script>

{{-- MODAL LIGHTBOX UNTUK PREVIEW FOTO --}}
@include('partials.lightbox')

@endsection