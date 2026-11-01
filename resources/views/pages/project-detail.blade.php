@extends('layouts.app')

@section('content')
@php
    $P     = config('portfolio');
    $logo  = $P['tech_logos'];
    $all   = collect($P['projects'])->values();
    $idx   = $all->search(fn ($p) => $p['slug'] === $project['slug']);
    $prev  = $idx > 0 ? $all[$idx - 1] : null;
    $next  = $idx < $all->count() - 1 ? $all[$idx + 1] : null;
    $facts = array_filter([
        'Peran'   => $project['role'],
        'Periode' => $project['period'],
        'Status'  => $project['status'],
    ]);
@endphp

<!-- HERO -->
<section class="relative overflow-hidden bg-[#0B1B3A] pt-24 pb-16 lg:pt-32 lg:pb-20">
    <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjAiIGhlaWdodD0iMjAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGNpcmNsZSBjeD0iMSIgY3k9IjEiIHI9IjEiIGZpbGw9InJnYmEoMjU1LDI1NSwyNTUsMC4wNSkiLz48L3N2Zz4=')] opacity-30"></div>
    <div class="relative z-10 mx-auto max-w-[1180px] px-6">
        <a href="{{ route('projects') }}" class="mb-8 inline-flex items-center gap-2 text-[13.5px] font-semibold text-[#25AEFF] hover:text-white">
            <svg class="h-4 w-4 rotate-180" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
            Semua Proyek
        </a>
        <span class="mb-4 block text-[13px] font-semibold text-[#25AEFF]">{{ $project['category'] }}</span>
        <h1 class="mb-5 max-w-[820px] text-[32px] font-extrabold leading-tight text-white md:text-[44px]">{{ $project['title'] }}</h1>
        <p class="mb-8 max-w-[720px] text-[16px] leading-relaxed text-gray-300">{{ $project['summary'] }}</p>
        <div class="flex flex-wrap gap-3">
            <a href="{{ $project['live'] }}" target="_blank" rel="noopener noreferrer" class="inline-flex h-[48px] items-center gap-2 rounded-full bg-white px-7 text-[14.5px] font-bold text-[#0B1B3A] shadow-xl transition-all hover:-translate-y-1">
                Kunjungi Website
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M7 17 17 7M8 7h9v9"/></svg>
            </a>
            @foreach($project['links'] as [$label, $url])
                <a href="{{ $url }}" target="_blank" rel="noopener noreferrer" class="inline-flex h-[48px] items-center rounded-full border border-white/30 px-7 text-[14.5px] font-semibold text-white transition-all hover:bg-white/10">{{ $label }}</a>
            @endforeach
        </div>
    </div>
</section>

<!-- RINGKASAN -->
<section class="border-b border-[#DCE7F5]/70 bg-white">
    <div class="mx-auto flex max-w-[1180px] flex-col gap-6 px-6 py-8 sm:flex-row sm:flex-wrap sm:gap-x-16">
        @foreach($facts as $label => $value)
            <div>
                <p class="mb-1 text-[12.5px] font-semibold text-[#64748B]">{{ $label }}</p>
                <p class="text-[15px] font-bold leading-snug text-[#0B1B3A]">{{ $value }}</p>
            </div>
        @endforeach
    </div>
</section>

<!-- ISI -->
<section class="bg-[#FAFCFF] py-20">
    <div class="mx-auto grid max-w-[1180px] grid-cols-1 gap-12 px-6 lg:grid-cols-12">

        <div class="flex flex-col gap-14 lg:col-span-8">
            <div data-aos="fade-up">
                <h2 class="mb-4 text-[24px] font-bold text-[#0B1B3A]">Gambaran Proyek</h2>
                <p class="text-[15.5px] leading-[1.85] text-[#64748B]">{{ $project['overview'] }}</p>
            </div>

            <div data-aos="fade-up">
                <h2 class="mb-5 text-[24px] font-bold text-[#0B1B3A]">Yang Saya Kerjakan</h2>
                <ul class="space-y-3.5 text-[15px] leading-relaxed text-[#475569]">
                    @foreach($project['work'] as $item)
                        <li class="flex items-start gap-3">
                            <span class="mt-2.5 h-1.5 w-1.5 shrink-0 rounded-full bg-[#1677FF]"></span>
                            <span>{{ $item }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div data-aos="fade-up">
                <h2 class="mb-5 text-[24px] font-bold text-[#0B1B3A]">Fitur Utama</h2>
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                    @foreach($project['features'] as $item)
                        <div class="flex items-start gap-3 rounded-2xl border border-[#DCE7F5] bg-white p-5 shadow-sm">
                            <svg class="mt-0.5 h-5 w-5 shrink-0 text-[#1677FF]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m5 12 5 5L20 7"/></svg>
                            <span class="text-[14.5px] font-medium leading-snug text-[#0B1B3A]">{{ $item }}</span>
                        </div>
                    @endforeach
                </div>
            </div>

            @if(!empty($project['results']))
                <div data-aos="fade-up">
                    <h2 class="mb-5 text-[24px] font-bold text-[#0B1B3A]">Hasil &amp; Dampak</h2>
                    <ul class="space-y-3.5 rounded-[22px] border border-[#DCE7F5] bg-white p-7 text-[15px] leading-relaxed text-[#0B1B3A] shadow-sm">
                        @foreach($project['results'] as $item)
                            <li class="flex items-start gap-3">
                                <svg class="mt-0.5 h-5 w-5 shrink-0 text-[#1677FF]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m5 12 5 5L20 7"/></svg>
                                <span>{{ $item }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>

        <aside class="lg:col-span-4">
            <div class="flex flex-col gap-6 lg:sticky lg:top-[110px]">
                <div class="rounded-[22px] border border-[#DCE7F5] bg-white p-7 shadow-sm">
                    <h3 class="mb-4 text-[15px] font-bold text-[#0B1B3A]">Teknologi</h3>
                    <div class="flex flex-wrap gap-2">
                        @foreach($project['tech'] as $tool)
                            <span class="inline-flex items-center gap-2 rounded-xl border border-[#DCE7F5] bg-[#F4F9FF] px-3.5 py-1.5 text-[13px] font-bold text-[#0B1B3A]">
                                @if(isset($logo[$tool]))
                                    <img src="{{ $logo[$tool] }}" alt="" class="h-4 w-4 object-contain">
                                @endif
                                {{ $tool }}
                            </span>
                        @endforeach
                    </div>
                </div>
                <div class="rounded-[22px] border border-[#DCE7F5] bg-white p-7 shadow-sm">
                    <h3 class="mb-4 text-[15px] font-bold text-[#0B1B3A]">Tautan</h3>
                    <div class="flex flex-col gap-3 text-[14px] font-semibold">
                        <a href="{{ $project['live'] }}" target="_blank" rel="noopener noreferrer" class="break-all text-[#1677FF] hover:text-[#0A6CFF]">{{ preg_replace('#^https?://#', '', $project['live']) }}</a>
                        @foreach($project['links'] as [$label, $url])
                            <a href="{{ $url }}" target="_blank" rel="noopener noreferrer" class="text-[#1677FF] hover:text-[#0A6CFF]">{{ $label }}</a>
                        @endforeach
                    </div>
                </div>
            </div>
        </aside>
    </div>
</section>

<!-- DOKUMENTASI -->
<section class="border-t border-[#DCE7F5]/60 bg-white py-20">
    <div class="mx-auto max-w-[1180px] px-6">
        <div class="mb-12" data-aos="fade-up">
            <h2 class="mb-2 text-[28px] font-bold text-[#0B1B3A] md:text-[32px]">Dokumentasi</h2>
            <p class="text-[15px] text-[#64748B]">Tangkapan layar dan dokumentasi kegiatan dari proyek ini. Klik gambar untuk memperbesar.</p>
        </div>
        <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
            @foreach($project['gallery'] as [$img, $caption])
                <figure class="group overflow-hidden rounded-[20px] border border-[#DCE7F5] bg-[#FAFCFF] shadow-sm" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 80 }}">
                    <a href="{{ asset($img) }}" target="_blank" rel="noopener" class="block aspect-[16/10] overflow-hidden bg-[#F4F9FF]">
                        <img src="{{ asset($img) }}" alt="{{ $caption }}" loading="lazy" class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-105">
                    </a>
                    <figcaption class="p-5 text-[14px] font-medium leading-snug text-[#0B1B3A]">{{ $caption }}</figcaption>
                </figure>
            @endforeach
        </div>
    </div>
</section>

<!-- NAVIGASI ANTAR PROJECT -->
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
