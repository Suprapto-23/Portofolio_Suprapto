@extends('layouts.app')

@section('content')
@php
    $P       = config('portfolio');
    $thesis  = config('portfolio_site.thesis');
    $logo    = $P['tech_logos'] ?? [];
    $all     = collect($P['projects'] ?? [])->values();
    $idx     = $all->search(fn ($p) => $p['slug'] === $project['slug']);
    $prev    = $idx > 0 ? $all[$idx - 1] : null;
    $next    = $idx < $all->count() - 1 ? $all[$idx + 1] : null;
    $gallery = \App\Support\Img::existing($project['gallery'] ?? []);
    // Jika belum ada foto dokumentasi, pakai gambar sampul proyek agar bagian dokumentasi tidak kosong.
    if (!count($gallery)) {
        $gallery = \App\Support\Img::existing([[$project['cover'] ?? '', 'Tampilan ' . $project['title']]]);
    }
    $galleryExpected = collect($project['gallery'] ?? [])->map(fn ($r) => is_array($r) ? $r[0] : $r)->all();
    $isThesis = str_contains(strtolower($project['title'] ?? ''), 'posyandu');
    $facts   = array_filter([
        'Peran'   => $project['role'] ?? null,
        'Periode' => $project['period'] ?? null,
        'Status'  => $project['status'] ?? null,
    ]);
    $check = '<svg class="mt-0.5 h-5 w-5 shrink-0 text-[#1677FF]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m5 12 5 5L20 7"/></svg>';
    $ext   = '<svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M7 17 17 7M8 7h9v9"/></svg>';
@endphp

<style>
    #galModal::backdrop { background: rgba(11, 27, 58, .72); backdrop-filter: blur(3px); }
</style>

<!-- HERO -->
<section class="relative overflow-hidden bg-[#0B1B3A] pb-16 pt-24 lg:pb-20 lg:pt-32">
    <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjAiIGhlaWdodD0iMjAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGNpcmNsZSBjeD0iMSIgY3k9IjEiIHI9IjEiIGZpbGw9InJnYmEoMjU1LDI1NSwyNTUsMC4wNSkiLz48L3N2Zz4=')] opacity-30"></div>
    <div class="relative z-10 mx-auto max-w-[1180px] px-6">
        <nav aria-label="Navigasi" class="mb-8 flex items-center gap-2 text-[13.5px] font-semibold">
            <a href="{{ route('projects') }}" class="text-[#25AEFF] hover:text-white">Proyek</a>
            <span class="text-white/40" aria-hidden="true">/</span>
            <span class="line-clamp-1 text-white/70">{{ $project['category'] }}</span>
        </nav>
        <h1 class="mb-5 max-w-[820px] text-[32px] font-extrabold leading-tight text-white md:text-[44px]">{{ $project['title'] }}</h1>
        <p class="mb-8 max-w-[720px] text-[16px] leading-relaxed text-gray-300">{{ $project['summary'] }}</p>
        <div class="flex flex-wrap gap-3">
            <a href="{{ $project['live'] }}" target="_blank" rel="noopener noreferrer" class="inline-flex h-[48px] items-center gap-2 rounded-full bg-white px-7 text-[14.5px] font-bold text-[#0B1B3A] shadow-xl transition-all hover:-translate-y-1">Kunjungi Website {!! $ext !!}</a>
            @foreach($project['links'] ?? [] as [$label, $url])
                <a href="{{ $url }}" target="_blank" rel="noopener noreferrer" class="inline-flex h-[48px] items-center rounded-full border border-white/30 px-7 text-[14.5px] font-semibold text-white transition-all hover:bg-white/10">{{ $label }}</a>
            @endforeach
        </div>
    </div>
</section>

<!-- RINGKASAN -->
<section class="border-b border-[#DCE7F5]/70 bg-white">
    <div class="mx-auto max-w-[1180px] px-6 py-8">
        @if($facts)
            <dl class="grid grid-cols-1 gap-5 sm:grid-cols-3 sm:gap-8">
                @foreach($facts as $label => $value)
                    <div>
                        <dt class="mb-1 text-[12.5px] font-semibold text-[#64748B]">{{ $label }}</dt>
                        <dd class="text-[15px] font-bold leading-snug text-[#0B1B3A]">{{ $value }}</dd>
                    </div>
                @endforeach
            </dl>
        @endif

        <div class="{{ $facts ? 'mt-7 border-t border-[#EEF3FA] pt-7' : '' }} grid grid-cols-1 gap-7 lg:grid-cols-2 lg:gap-12">
            <div>
                <h2 class="mb-3 text-[12.5px] font-semibold text-[#64748B]">Teknologi</h2>
                <div class="flex flex-wrap gap-2">
                    @forelse($project['tech'] ?? [] as $tool)
                        <span class="inline-flex items-center gap-2 rounded-xl border border-[#DCE7F5] bg-[#F4F9FF] px-3.5 py-1.5 text-[13px] font-bold text-[#0B1B3A]">
                            @if(isset($logo[$tool]))
                                <img src="{{ $logo[$tool] }}" alt="" class="h-4 w-4 object-contain">
                            @endif
                            {{ $tool }}
                        </span>
                    @empty
                        <span class="text-[14px] text-[#64748B]">-</span>
                    @endforelse
                </div>
            </div>

            <div>
                <h2 class="mb-3 text-[12.5px] font-semibold text-[#64748B]">Tautan</h2>
                <div class="flex flex-wrap items-center gap-x-6 gap-y-2 text-[14px] font-semibold">
                    <a href="{{ $project['live'] }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-1.5 break-all text-[#1677FF] hover:text-[#0A6CFF]">{{ preg_replace('#^https?://#', '', $project['live']) }} {!! $ext !!}</a>
                    @foreach($project['links'] ?? [] as [$linkLabel, $linkUrl])
                        <a href="{{ $linkUrl }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-1.5 text-[#1677FF] hover:text-[#0A6CFF]">{{ $linkLabel }} {!! $ext !!}</a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ISI -->
<section class="bg-[#FAFCFF] py-16 lg:py-20">
    <div class="mx-auto max-w-[900px] px-6">

        <div class="flex flex-col gap-14">
            @if(!empty($project['overview']))
                <div>
                    <h2 class="mb-4 text-[24px] font-bold text-[#0B1B3A]">Gambaran proyek</h2>
                    <p class="text-[15.5px] leading-[1.85] text-[#64748B]">{{ $project['overview'] }}</p>
                </div>
            @endif

            @if(!empty($project['work']))
                <div>
                    <h2 class="mb-5 text-[24px] font-bold text-[#0B1B3A]">Yang saya kerjakan</h2>
                    <ul class="space-y-3.5 text-[15px] leading-relaxed text-[#475569]">
                        @foreach($project['work'] as $item)
                            <li class="flex items-start gap-3">
                                <span class="mt-2.5 h-1.5 w-1.5 shrink-0 rounded-full bg-[#1677FF]"></span>
                                <span>{{ $item }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if(!empty($project['features']))
                <div>
                    <h2 class="mb-5 text-[24px] font-bold text-[#0B1B3A]">Fitur utama</h2>
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                        @foreach($project['features'] as $item)
                            <div class="flex items-start gap-3 rounded-2xl border border-[#DCE7F5] bg-white p-5 shadow-sm">
                                {!! $check !!}
                                <span class="text-[14.5px] font-medium leading-snug text-[#0B1B3A]">{{ $item }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
            @if(!empty($project['modules']))
                <div>
                    <h2 class="mb-5 text-[24px] font-bold text-[#0B1B3A]">Modul dan peran pengguna</h2>
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                        @foreach($project['modules'] as [$mTitle, $mDesc, $mItems])
                            <div class="rounded-2xl border border-[#DCE7F5] bg-white p-6 shadow-sm">
                                <h3 class="text-[16px] font-bold text-[#0B1B3A]">{{ $mTitle }}</h3>
                                <p class="mt-1 text-[13.5px] leading-relaxed text-[#64748B]">{{ $mDesc }}</p>
                                <ul class="mt-4 flex flex-wrap gap-2">
                                    @foreach($mItems as $mItem)
                                        <li class="rounded-full border border-[#DCE7F5] bg-[#F4F9FF] px-3 py-1 text-[12.5px] font-semibold text-[#0B1B3A]">{{ $mItem }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            @if(!empty($project['results']))
                <div>
                    <h2 class="mb-5 text-[24px] font-bold text-[#0B1B3A]">Hasil dan dampak</h2>
                    <ul class="space-y-3.5 rounded-[22px] border border-[#DCE7F5] bg-white p-7 text-[15px] leading-relaxed text-[#0B1B3A] shadow-sm">
                        @foreach($project['results'] as $item)
                            <li class="flex items-start gap-3">{!! $check !!}<span>{{ $item }}</span></li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if($isThesis)
                <div>
                    <h2 class="mb-5 text-[24px] font-bold text-[#0B1B3A]">Skripsi</h2>
                    <div class="rounded-[22px] border border-[#DCE7F5] bg-white p-7 shadow-sm">
                        <p class="text-[16px] font-bold leading-snug text-[#0B1B3A]">{{ $thesis['title'] }}</p>
                        <p class="mt-1 text-[14px] font-semibold text-[#1677FF]">{{ $thesis['case'] }} · {{ $thesis['year'] }}</p>
                        <div class="mt-5 grid gap-3 sm:grid-cols-3">
                            @foreach($thesis['outputs'] as [$ol, $ov, $on])
                                <div class="rounded-2xl bg-[#F4F9FF] p-4">
                                    <p class="text-[12.5px] font-medium text-[#64748B]">{{ $ol }}</p>
                                    <p class="mt-1 text-[19px] font-extrabold leading-tight text-[#0B1B3A]">{{ $ov }}</p>
                                    <p class="mt-1 text-[12.5px] text-[#64748B]">{{ $on }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</section>

<!-- DOKUMENTASI -->
<section class="border-t border-[#DCE7F5]/60 bg-white py-20">
    <div class="mx-auto max-w-[1180px] px-6">
        <div class="mb-10">
            <h2 class="mb-2 text-[28px] font-bold text-[#0B1B3A] md:text-[32px]">Dokumentasi</h2>
            <p class="text-[15px] text-[#64748B]">Tangkapan layar dan dokumentasi kegiatan dari proyek ini. Klik gambar untuk memperbesar.</p>
        </div>
        @if(count($gallery))
                @php
            $isPhoto = fn ($r) => str_starts_with(basename($r[0]), 'kegiatan-');
            $g       = collect($gallery);
            $blocks  = array_filter([
                ['Tampilan sistem', 'Tangkapan layar halaman pengguna dan panel admin.', $g->reject($isPhoto)->values()],
                ['Foto kegiatan', 'Dokumentasi pelatihan, pengujian, dan kegiatan di lapangan.', $g->filter($isPhoto)->values()],
            ], fn ($b) => $b[2]->isNotEmpty());
        @endphp
        @foreach($blocks as [$bTitle, $bDesc, $bRows])
            <div class="{{ $loop->first ? '' : 'mt-14' }}">
                <h3 class="text-[20px] font-bold text-[#0B1B3A]">{{ $bTitle }} <span class="text-[15px] font-semibold text-[#64748B]">({{ $bRows->count() }})</span></h3>
                <p class="mb-6 mt-1 text-[14.5px] text-[#64748B]">{{ $bDesc }}</p>
                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach($bRows as $row)
                        <figure class="overflow-hidden rounded-[20px] border border-[#DCE7F5] bg-[#FAFCFF] shadow-sm">
                            <button type="button" data-gal data-src="{{ asset($row[0]) }}" data-cap="{{ $row[1] ?? '' }}" class="group block aspect-[16/10] w-full cursor-zoom-in overflow-hidden bg-[#F4F9FF] focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-[-2px] focus-visible:outline-[#1677FF]">
                                <img src="{{ asset($row[0]) }}" alt="{{ $row[1] ?? 'Dokumentasi proyek' }}" loading="lazy" class="h-full w-full object-cover {{ $isPhoto($row) ? 'object-center' : 'object-top' }} transition-transform duration-500 group-hover:scale-105">
                            </button>
                            @if(!empty($row[1]))
                                <figcaption class="p-5 text-[14px] font-medium leading-snug text-[#0B1B3A]">{{ $row[1] }}</figcaption>
                            @endif
                        </figure>
                    @endforeach
                </div>
            </div>
        @endforeach
        @else
        <div class="rounded-[22px] border border-dashed border-[#DCE7F5] bg-[#FAFCFF] px-6 py-12 text-center">
            <h3 class="mb-2 text-[17px] font-bold text-[#0B1B3A]">Foto dokumentasi sedang disiapkan</h3>
            <p class="mx-auto max-w-lg text-[14.5px] leading-relaxed text-[#64748B]">Tangkapan layar dan foto kegiatan proyek ini akan ditampilkan di sini. Sementara itu, sistem dapat dibuka langsung melalui tombol “Kunjungi Website”.</p>
            @if(config('app.debug') && count($galleryExpected))
                <div class="mx-auto mt-6 max-w-xl rounded-xl bg-white p-4 text-left text-[12.5px] text-[#64748B] ring-1 ring-[#DCE7F5]">
                    <p class="mb-1 font-semibold text-[#0B1B3A]">Mode debug: letakkan file berikut di folder public/</p>
                    <ul class="list-disc space-y-0.5 pl-5">
                        @foreach($galleryExpected as $exp)
                            <li><code>{{ $exp }}</code></li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
        @endif
    </div>
</section>

@if(count($gallery))
<dialog id="galModal" aria-label="Pratinjau dokumentasi" class="m-auto w-[94vw] max-w-[980px] overflow-hidden rounded-[24px] border-0 bg-white p-0 shadow-2xl">
    <div class="relative bg-[#0B1B3A] p-4 sm:p-6">
        <img id="galImg" alt="" class="mx-auto max-h-[72vh] w-auto max-w-full rounded-lg object-contain">
        <button type="button" id="galPrev" aria-label="Sebelumnya" class="absolute left-3 top-1/2 flex h-10 w-10 -translate-y-1/2 items-center justify-center rounded-full bg-white/90 text-[#0B1B3A] shadow hover:bg-white"><svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg></button>
        <button type="button" id="galNext" aria-label="Berikutnya" class="absolute right-3 top-1/2 flex h-10 w-10 -translate-y-1/2 items-center justify-center rounded-full bg-white/90 text-[#0B1B3A] shadow hover:bg-white"><svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg></button>
    </div>
    <div class="flex items-center justify-between gap-4 px-5 py-4">
        <div>
            <p id="galCap" class="text-[14.5px] font-semibold text-[#0B1B3A]"></p>
            <p id="galCount" class="text-[12.5px] text-[#64748B]"></p>
        </div>
        <button type="button" id="galClose" class="rounded-full border border-[#DCE7F5] px-5 py-2 text-[13.5px] font-semibold text-[#0B1B3A] hover:bg-[#F4F9FF]">Tutup</button>
    </div>
</dialog>

<script>
(() => {
    const items = [...document.querySelectorAll('[data-gal]')];
    const m = document.getElementById('galModal');
    if (!m || !items.length) return;
    const img = document.getElementById('galImg'), cap = document.getElementById('galCap'), count = document.getElementById('galCount');
    let i = 0;
    const show = () => {
        const t = items[i];
        img.src = t.dataset.src; img.alt = t.dataset.cap || '';
        cap.textContent = t.dataset.cap || '';
        count.textContent = (i + 1) + ' dari ' + items.length;
    };
    const step = (d) => { i = (i + d + items.length) % items.length; show(); };
    items.forEach((t, n) => t.addEventListener('click', () => { i = n; show(); m.showModal(); }));
    document.getElementById('galPrev').addEventListener('click', () => step(-1));
    document.getElementById('galNext').addEventListener('click', () => step(1));
    document.getElementById('galClose').addEventListener('click', () => m.close());
    m.addEventListener('click', (e) => { if (e.target === m) m.close(); });
    m.addEventListener('keydown', (e) => { if (e.key === 'ArrowLeft') step(-1); if (e.key === 'ArrowRight') step(1); });
    m.addEventListener('close', () => img.removeAttribute('src'));
})();
</script>
@endif

<!-- NAVIGASI ANTAR PROYEK -->
<section class="border-t border-[#DCE7F5]/60 bg-[#FAFCFF] py-12">
    <div class="mx-auto flex max-w-[1180px] flex-col justify-between gap-6 px-6 sm:flex-row">
        @if($prev)
            <a href="{{ route('projects.show', $prev['slug']) }}" class="group max-w-[420px]">
                <p class="mb-1 text-[12.5px] font-semibold text-[#64748B]">Proyek sebelumnya</p>
                <p class="text-[16px] font-bold text-[#0B1B3A] transition-colors group-hover:text-[#1677FF]">{{ $prev['title'] }}</p>
            </a>
        @else
            <span></span>
        @endif
        @if($next)
            <a href="{{ route('projects.show', $next['slug']) }}" class="group max-w-[420px] sm:text-right">
                <p class="mb-1 text-[12.5px] font-semibold text-[#64748B]">Proyek berikutnya</p>
                <p class="text-[16px] font-bold text-[#0B1B3A] transition-colors group-hover:text-[#1677FF]">{{ $next['title'] }}</p>
            </a>
        @endif
    </div>
</section>
@endsection