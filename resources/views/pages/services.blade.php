@extends('layouts.app')

@section('content')
@php
    $P      = config('portfolio');
    $groups = config('portfolio_site.skills', []);
    $dev    = fn ($slug) => "https://cdn.jsdelivr.net/gh/devicons/devicon@v2.16.0/icons/{$slug}/{$slug}-original.svg";
    $certs  = collect($P['certificates'] ?? [])->take(4);
@endphp

<!-- HERO -->
<section class="relative overflow-hidden bg-[#0B1B3A] pb-20 pt-24 lg:pb-24 lg:pt-32">
    <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjAiIGhlaWdodD0iMjAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGNpcmNsZSBjeD0iMSIgY3k9IjEiIHI9IjEiIGZpbGw9InJnYmEoMjU1LDI1NSwyNTUsMC4wNSkiLz48L3N2Zz4=')] opacity-30"></div>
    <div class="relative z-10 mx-auto max-w-[1180px] px-6">
        <div class="max-w-[720px]">
            <h1 class="mb-4 text-[36px] font-extrabold leading-tight text-white md:text-[48px]">Keahlian</h1>
            <p class="text-[16px] leading-relaxed text-gray-300">
                Teknologi, metode, dan keterampilan yang saya gunakan pada proyek nyata dan pekerjaan akademik. Setiap kelompok disertai contoh penerapannya.
            </p>
        </div>
    </div>
</section>

<!-- KELOMPOK KEAHLIAN -->
<section class="bg-[#FAFCFF] py-20">
    <div class="mx-auto grid max-w-[1180px] grid-cols-1 gap-6 px-6 md:grid-cols-2">
        @foreach($groups as $g)
            <article class="flex flex-col rounded-[22px] border border-[#DCE7F5] bg-white p-7 shadow-sm {{ $loop->last && $loop->count % 2 === 1 ? 'md:col-span-2' : '' }}">
                <h2 class="text-[20px] font-bold text-[#0B1B3A]">{{ $g['title'] }}</h2>
                @if(!empty($g['desc']))
                    <p class="mt-1.5 text-[14.5px] leading-relaxed text-[#64748B]">{{ $g['desc'] }}</p>
                @endif

                <div class="mt-5 flex flex-wrap gap-2.5">
                    @foreach($g['items'] as $it)
                        <span class="inline-flex items-center gap-2.5 rounded-full border border-[#DCE7F5] bg-[#F4F9FF] py-2 pl-3 pr-4 text-[13.5px] font-semibold text-[#0B1B3A]">
                            @if(!empty($it['dev']))
                                <img src="{{ $dev($it['dev']) }}" alt="" loading="lazy" class="h-5 w-5 object-contain" onerror="this.style.display='none'">
                            @elseif(!empty($it['office']))
                                <svg class="h-5 w-5" viewBox="0 0 24 24" aria-hidden="true"><rect width="24" height="24" rx="5" fill="{{ $it['office'][1] }}"/><text x="12" y="17" text-anchor="middle" font-family="Arial,sans-serif" font-size="14" font-weight="700" fill="#fff">{{ $it['office'][0] }}</text></svg>
                            @else
                                <svg class="h-4 w-4 text-[#1677FF]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m5 12 5 5L20 7"/></svg>
                            @endif
                            {{ $it['name'] }}
                        </span>
                    @endforeach
                </div>

                @php $proof = \App\Support\Img::existing($g['photos'] ?? []); @endphp

                @if(!empty($g['used']) || count($proof))
                    <div class="mt-auto pt-6">
                        <div class="rounded-2xl bg-[#F4F9FF] p-4">
                            @if(!empty($g['used']))
                                <p class="text-[12.5px] font-semibold text-[#1677FF]">Diterapkan pada</p>
                                <p class="mt-1 text-[13.5px] leading-relaxed text-[#0B1B3A]">{{ $g['used'] }}</p>
                            @endif

                            @if(count($proof))
                                <p class="{{ !empty($g['used']) ? 'mt-4 ' : '' }}text-[12.5px] font-semibold text-[#1677FF]">Bukti dokumentasi</p>
                                <div class="mt-2 grid grid-cols-2 gap-3 sm:grid-cols-3">
                                    @foreach($proof as $ph)
                                        <a href="{{ asset($ph[0]) }}" target="_blank" rel="noopener noreferrer" class="group block overflow-hidden rounded-xl border border-[#DCE7F5] bg-white">
                                            <img src="{{ asset($ph[0]) }}" alt="{{ $ph[1] ?? 'Dokumentasi' }}" loading="lazy" class="aspect-[4/3] w-full object-cover transition-transform duration-500 group-hover:scale-105">
                                            @if(!empty($ph[1]))
                                                <span class="block px-2.5 py-2 text-[11.5px] font-medium leading-snug text-[#0B1B3A]">{{ $ph[1] }}</span>
                                            @endif
                                        </a>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                @endif
            </article>
        @endforeach
    </div>
</section>

<!-- SERTIFIKASI PENDUKUNG -->
@if($certs->isNotEmpty())
<section class="border-t border-[#DCE7F5]/60 bg-white py-20">
    <div class="mx-auto max-w-[1180px] px-6">
        <div class="mb-8 flex flex-col justify-between gap-3 md:flex-row md:items-end">
            <div class="max-w-xl">
                <h2 class="text-[28px] font-bold text-[#0B1B3A] md:text-[32px]">Bukti kompetensi</h2>
                <p class="mt-2 text-[15px] leading-relaxed text-[#64748B]">Sertifikasi dan pelatihan yang mendukung keahlian di atas.</p>
            </div>
            <a href="{{ url('/') }}#certificates" class="text-[14px] font-semibold text-[#1677FF] hover:text-[#0A6CFF]">Lihat semua sertifikat</a>
        </div>

        <ul class="divide-y divide-[#EEF3FA] rounded-[22px] border border-[#DCE7F5] bg-white shadow-sm">
            @foreach($certs as $c)
                <li class="flex flex-col gap-1 px-6 py-5 sm:flex-row sm:items-center sm:justify-between sm:gap-6">
                    <div>
                        <p class="text-[15px] font-bold text-[#0B1B3A]">{{ $c['title'] }}</p>
                        <p class="text-[13.5px] text-[#64748B]">{{ $c['issuer'] }}</p>
                    </div>
                    <p class="text-[13.5px] font-medium text-[#0B1B3A] sm:text-right">{{ $c['date'] }}</p>
                </li>
            @endforeach
        </ul>
    </div>
</section>
@endif

<!-- AJAKAN -->
<section class="bg-[#FAFCFF] pb-24 pt-4">
    <div class="mx-auto max-w-[1180px] px-6">
        <div class="flex flex-col items-start justify-between gap-6 rounded-[28px] bg-gradient-to-br from-[#063B91] via-[#126BFF] to-[#7147FF] p-10 md:flex-row md:items-center lg:p-12">
            <div class="max-w-xl">
                <h2 class="text-[26px] font-extrabold leading-tight text-white md:text-[30px]">Lihat keahlian ini dipakai di proyek nyata</h2>
                <p class="mt-2 text-[15px] leading-relaxed text-white/85">Setiap proyek memuat peran, teknologi, dan dokumentasinya.</p>
            </div>
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('projects') }}" class="inline-flex h-[48px] items-center rounded-full bg-white px-7 text-[14.5px] font-bold text-[#0B1B3A] shadow-lg transition hover:-translate-y-0.5">Lihat Proyek</a>
                <a href="{{ route('contact') }}" class="inline-flex h-[48px] items-center rounded-full border border-white/40 px-7 text-[14.5px] font-semibold text-white transition hover:bg-white/10">Hubungi Saya</a>
            </div>
        </div>
    </div>
</section>
@endsection