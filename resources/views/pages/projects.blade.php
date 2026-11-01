@extends('layouts.app')

@section('content')
@php
    $P    = config('portfolio');
    $logo = $P['tech_logos'];
@endphp

<!-- PROJECTS HERO -->
<section class="relative overflow-hidden bg-[#0B1B3A] pt-24 pb-20 lg:pt-32 lg:pb-28">
    <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjAiIGhlaWdodD0iMjAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGNpcmNsZSBjeD0iMSIgY3k9IjEiIHI9IjEiIGZpbGw9InJnYmEoMjU1LDI1NSwyNTUsMC4wNSkiLz48L3N2Zz4=')] opacity-30"></div>
    <div class="relative z-10 mx-auto max-w-[1180px] px-6 text-center">
        <h1 class="mb-4 text-[36px] font-extrabold leading-tight text-white md:text-[48px]">Proyek Pilihan</h1>
        <p class="mx-auto max-w-[640px] text-[16px] leading-relaxed text-gray-300">
            Empat sistem yang sudah berjalan dan dapat dibuka langsung: dari sistem tiket yang dipakai untuk transaksi nyata hingga sistem informasi Posyandu hasil skripsi.
        </p>
    </div>
</section>

<!-- DAFTAR PROJECT -->
<section class="bg-[#FAFCFF] py-24">
    <div class="mx-auto flex max-w-[1180px] flex-col gap-24 px-6">
        @foreach($P['projects'] as $index => $project)
            @php $flip = $index % 2 !== 0; @endphp
            <div class="grid grid-cols-1 items-center gap-12 lg:grid-cols-2" data-aos="fade-up">

                <div class="{{ $flip ? 'order-2 lg:order-2' : 'order-2 lg:order-1' }}">
                    <div class="mb-4 inline-flex items-center gap-2 rounded-full bg-[#EAF6FF] px-3 py-1 text-[12px] font-bold text-[#1677FF]">
                        <span class="h-2 w-2 rounded-full bg-[#1677FF]"></span> {{ $project['category'] }}
                    </div>
                    <h2 class="mb-4 text-[28px] font-bold text-[#0B1B3A] md:text-[32px]">{{ $project['title'] }}</h2>
                    <p class="mb-6 text-[15px] leading-[1.8] text-[#64748B]">{{ $project['summary'] }}</p>

                    <div class="mb-8 flex flex-wrap gap-3">
                        <a href="{{ $project['live'] }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-2 rounded-xl bg-[#1677FF] px-4 py-2 text-[13px] font-semibold text-white shadow-sm transition hover:bg-blue-600">Kunjungi Website</a>
                        <a href="{{ route('projects.show', $project['slug']) }}" class="inline-flex items-center gap-2 rounded-xl border border-[#DCE7F5] bg-white px-4 py-2 text-[13px] font-semibold text-[#0B1B3A] shadow-sm transition hover:bg-slate-50">Detail &amp; Dokumentasi</a>
                    </div>

                    <div class="flex flex-wrap gap-2">
                        @foreach($project['tech'] as $tool)
                            <span class="inline-flex items-center gap-2 rounded-xl border border-[#DCE7F5] bg-white px-3.5 py-1.5 text-[13px] font-bold text-[#0B1B3A] shadow-sm">
                                @if(isset($logo[$tool]))
                                    <img src="{{ $logo[$tool] }}" alt="" class="h-4 w-4 object-contain">
                                @endif
                                {{ $tool }}
                            </span>
                        @endforeach
                    </div>
                </div>

                <div class="{{ $flip ? 'order-1 lg:order-1' : 'order-1 lg:order-2' }}">
                    <a href="{{ route('projects.show', $project['slug']) }}" class="block rounded-[24px] border border-[#DCE7F5] bg-white p-6 shadow-lg shadow-[#1677FF]/5 transition-transform duration-300 hover:-translate-y-1">
                        <div class="aspect-video overflow-hidden rounded-xl bg-[#F4F9FF]">
                            <img src="{{ asset($project['cover']) }}" alt="{{ $project['title'] }}" loading="lazy" class="h-full w-full object-cover" onerror="this.style.display='none'">
                        </div>
                    </a>
                </div>

            </div>
        @endforeach
    </div>
</section>
@endsection
