@extends('layouts.app')

@section('content')
@php
    $P   = config('portfolio');
    $edu = $P['education'];
@endphp

<!-- PROFIL -->
<section class="relative overflow-hidden border-b border-gray-100 bg-white pt-24 pb-16 lg:pt-32 lg:pb-24">
    <div class="relative z-10 mx-auto grid max-w-[1180px] grid-cols-1 items-center gap-12 px-6 lg:grid-cols-12">
        <div class="lg:col-span-7" data-aos="fade-right">
            <span class="mb-3 block text-[12px] font-bold uppercase tracking-[0.2em] text-[#1677FF]">Profil</span>
            <h1 class="mb-2 text-[38px] font-extrabold leading-tight text-[#0B1B3A] md:text-[46px]">Suprapto, S.Kom.</h1>
            <p class="mb-8 text-[16px] font-semibold text-[#64748B]">Junior Web Programmer (BNSP) · Kab. Pekalongan, Jawa Tengah</p>

            @foreach($P['about'] as $para)
                <p class="mb-5 max-w-[640px] text-[16px] leading-[1.8] text-[#64748B]">{{ $para }}</p>
            @endforeach

            <div class="mt-8 flex flex-wrap gap-3">
                <a href="{{ route('projects') }}" class="inline-flex h-[48px] items-center rounded-full bg-gradient-to-r from-[#0A72FF] to-[#5F4FEE] px-7 text-[14.5px] font-semibold text-white shadow-[0_8px_20px_-6px_rgba(40,90,245,0.5)] transition-all hover:-translate-y-1">Lihat Proyek Saya</a>
                <a href="{{ route('contact') }}" class="inline-flex h-[48px] items-center rounded-full border-[1.5px] border-[#D1E3FF] bg-white px-7 text-[14.5px] font-semibold text-[#1677FF] transition-all hover:-translate-y-1 hover:bg-[#F4F9FF]">Hubungi Saya</a>
            </div>
        </div>
        <div class="flex justify-center lg:col-span-5" data-aos="fade-left">
            <div class="relative w-full max-w-[400px]">
                <div class="absolute inset-0 rotate-3 transform rounded-3xl bg-gradient-to-tr from-[#1677FF] to-[#7048FF] opacity-10"></div>
                <img src="{{ asset('images/about.png') }}" alt="Suprapto" class="relative z-10 w-full object-contain mix-blend-multiply drop-shadow-xl" onerror="this.style.display='none'">
            </div>
        </div>
    </div>
</section>

<!-- PENDIDIKAN -->
<section class="bg-[#FAFCFF] py-20">
    <div class="mx-auto max-w-[1180px] px-6">
        <div class="mb-10" data-aos="fade-up">
            <span class="mb-2 block text-[12px] font-bold uppercase tracking-widest text-[#1677FF]">Latar Belakang</span>
            <h2 class="text-[30px] font-bold text-[#0B1B3A] md:text-[34px]">Pendidikan</h2>
        </div>

        <div class="mx-auto max-w-[860px] rounded-[22px] border border-[#DCE7F5] bg-white p-8 shadow-sm md:p-10" data-aos="fade-up">
            <div class="flex flex-col gap-2 md:flex-row md:items-start md:justify-between">
                <div>
                    <h3 class="text-[20px] font-bold text-[#0B1B3A]">{{ $edu['degree'] }}</h3>
                    <p class="mt-1 text-[15px] font-medium text-[#0B1B3A]">{{ $edu['school'] }}</p>
                </div>
                <span class="text-[14px] font-semibold text-[#64748B]">{{ $edu['period'] }}</span>
            </div>
            <p class="mt-3 text-[14px] font-semibold text-[#1677FF]">{{ $edu['gpa'] }}</p>

            <ul class="mt-6 space-y-3 border-t border-[#DCE7F5] pt-6 text-[14.5px] leading-relaxed text-[#64748B]">
                @foreach($edu['points'] as $point)
                    <li class="flex items-start gap-3">
                        <span class="mt-2.5 h-1.5 w-1.5 shrink-0 rounded-full bg-[#1677FF]"></span>
                        <span>{{ $point }}</span>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</section>

<!-- PENGALAMAN -->
<section class="bg-white py-20">
    <div class="mx-auto max-w-[1180px] px-6">
        <div class="mb-10" data-aos="fade-up">
            <span class="mb-2 block text-[12px] font-bold uppercase tracking-widest text-[#1677FF]">Rekam Jejak</span>
            <h2 class="text-[30px] font-bold text-[#0B1B3A] md:text-[34px]">Pengalaman</h2>
        </div>

        <div class="mx-auto max-w-[980px]">
            @include('partials.experience-list')
        </div>
    </div>
</section>

<!-- ORGANISASI & KEGIATAN -->
<section class="bg-[#FAFCFF] py-20">
    <div class="mx-auto max-w-[1180px] px-6">
        <div class="mb-10" data-aos="fade-up">
            <span class="mb-2 block text-[12px] font-bold uppercase tracking-widest text-[#1677FF]">Di Luar Perkuliahan</span>
            <h2 class="text-[30px] font-bold text-[#0B1B3A] md:text-[34px]">Organisasi &amp; Kegiatan</h2>
        </div>

        <div class="mx-auto max-w-[860px] divide-y divide-[#DCE7F5] rounded-[22px] border border-[#DCE7F5] bg-white px-8" data-aos="fade-up">
            @foreach($P['activities'] as [$title, $org, $time, $desc])
                <div class="py-6">
                    <h3 class="text-[16px] font-bold leading-snug text-[#0B1B3A]">{{ $title }}</h3>
                    <p class="mt-1 text-[13.5px] font-semibold text-[#1677FF]">{{ $org }} · {{ $time }}</p>
                    @if($desc)
                        <p class="mt-2 text-[14px] leading-relaxed text-[#64748B]">{{ $desc }}</p>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
</section>
@endsection