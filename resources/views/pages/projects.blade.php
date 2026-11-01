@extends('layouts.app')

@section('content')
@php
    $P        = config('portfolio');
    $logo     = $P['tech_logos'] ?? [];
    $projects = collect($P['projects'] ?? [])->values();
    $arrow    = '<svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M7 17 17 7M8 7h9v9"/></svg>';
@endphp

<!-- HERO -->
<section class="relative overflow-hidden bg-[#0B1B3A] pb-20 pt-24 lg:pb-24 lg:pt-32">
    <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjAiIGhlaWdodD0iMjAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGNpcmNsZSBjeD0iMSIgY3k9IjEiIHI9IjEiIGZpbGw9InJnYmEoMjU1LDI1NSwyNTUsMC4wNSkiLz48L3N2Zz4=')] opacity-30"></div>
    <div class="relative z-10 mx-auto max-w-[1180px] px-6">
        <div class="max-w-[720px]">
            <h1 class="mb-4 text-[36px] font-extrabold leading-tight text-white md:text-[48px]">Proyek</h1>
            <p class="text-[16px] leading-relaxed text-gray-300">
                {{ $projects->count() }} sistem yang sudah berjalan dan dapat dibuka langsung: dari sistem tiket yang dipakai untuk transaksi nyata hingga sistem informasi Posyandu hasil skripsi. Setiap proyek memiliki halaman detail berisi peran, fitur, hasil, dan dokumentasi.
            </p>
        </div>
    </div>
</section>

<!-- DAFTAR PROYEK -->
<section class="bg-[#FAFCFF] py-20">
    <div class="mx-auto flex max-w-[1180px] flex-col gap-10 px-6">
        @foreach($projects as $project)
            @php
                $facts = array_filter([
                    'Peran'   => $project['role'] ?? null,
                    'Periode' => $project['period'] ?? null,
                    'Status'  => $project['status'] ?? null,
                ]);
            @endphp
            <article id="{{ $project['slug'] }}" class="scroll-mt-28 grid grid-cols-1 overflow-hidden rounded-[26px] border border-[#DCE7F5] bg-white shadow-sm transition duration-300 hover:border-[#1677FF]/40 hover:shadow-[0_20px_40px_-18px_rgba(22,119,255,0.2)] lg:grid-cols-12">

                <a href="{{ route('projects.show', $project['slug']) }}" class="relative block aspect-video overflow-hidden bg-gradient-to-br from-[#F4F9FF] to-[#EAF6FF] lg:col-span-5 lg:aspect-auto lg:min-h-[320px]" aria-label="Buka detail {{ $project['title'] }}">
                    <img src="{{ asset($project['cover']) }}" alt="{{ $project['title'] }}" loading="lazy" class="absolute inset-0 h-full w-full object-cover" onerror="this.style.display='none'">
                </a>

                <div class="flex flex-col p-7 lg:col-span-7 lg:p-9">
                    <span class="mb-4 self-start rounded-md bg-[#EAF6FF] px-3 py-1 text-[12px] font-semibold text-[#1677FF]">{{ $project['category'] }}</span>
                    <h2 class="text-[24px] font-bold leading-snug text-[#0B1B3A] md:text-[28px]">{{ $project['title'] }}</h2>
                    <p class="mt-3 text-[15px] leading-[1.8] text-[#64748B]">{{ $project['summary'] }}</p>

                    @if($facts)
                        <dl class="mt-5 grid grid-cols-1 gap-x-8 gap-y-3 border-t border-[#EEF3FA] pt-5 sm:grid-cols-3">
                            @foreach($facts as $label => $value)
                                <div>
                                    <dt class="text-[12px] font-semibold text-[#64748B]">{{ $label }}</dt>
                                    <dd class="mt-0.5 text-[13.5px] font-bold leading-snug text-[#0B1B3A]">{{ $value }}</dd>
                                </div>
                            @endforeach
                        </dl>
                    @endif

                    <div class="mt-5 flex flex-wrap gap-2">
                        @foreach($project['tech'] ?? [] as $tool)
                            <span class="inline-flex items-center gap-2 rounded-xl border border-[#DCE7F5] bg-[#F4F9FF] px-3 py-1.5 text-[12.5px] font-bold text-[#0B1B3A]">
                                @if(isset($logo[$tool]))
                                    <img src="{{ $logo[$tool] }}" alt="" class="h-4 w-4 object-contain">
                                @endif
                                {{ $tool }}
                            </span>
                        @endforeach
                    </div>

                    <div class="mt-auto flex flex-wrap items-center gap-3 pt-7">
                        <a href="{{ route('projects.show', $project['slug']) }}" class="inline-flex h-[44px] items-center rounded-full bg-gradient-to-r from-[#0A72FF] to-[#5F4FEE] px-6 text-[14px] font-semibold text-white transition hover:-translate-y-0.5">Detail dan dokumentasi</a>
                        <a href="{{ $project['live'] }}" target="_blank" rel="noopener noreferrer" class="inline-flex h-[44px] items-center gap-1.5 rounded-full border border-[#DCE7F5] bg-white px-5 text-[14px] font-semibold text-[#1677FF] transition hover:border-[#1677FF]">Buka website {!! $arrow !!}</a>
                    </div>
                </div>
            </article>
        @endforeach
    </div>
</section>
@endsection