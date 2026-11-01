@extends('admin.layouts.app')
@section('title', 'Proyek Berhasil Diposting')

@section('content')
<div class="max-w-4xl mx-auto py-6 px-4">

    <!-- Container Utama Success Page -->
    <div class="relative overflow-hidden rounded-3xl bg-white border border-slate-200/80 shadow-2xl p-8 sm:p-12 text-center">
        
        <!-- Efek Ornamen Latar Belakang Gradasi Mewah -->
        <div class="absolute -right-32 -top-32 w-80 h-80 bg-emerald-500 rounded-full blur-3xl opacity-15 pointer-events-none"></div>
        <div class="absolute -left-32 -bottom-32 w-80 h-80 bg-blue-600 rounded-full blur-3xl opacity-15 pointer-events-none"></div>

        <!-- Animasi Lottie Perayaan Sukses (Stabil & Menggemaskan) -->
        <div class="w-36 h-36 sm:w-44 sm:h-44 mx-auto mb-2 relative">
            <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
            <lottie-player 
                src="https://assets9.lottiefiles.com/packages/lf20_lk80fpsm.json" 
                background="transparent" 
                speed="1" 
                style="width: 100%; height: 100%;" 
                loop 
                autoplay>
            </lottie-player>
        </div>

        <!-- Badge Status Perayaan -->
        <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full text-xs font-extrabold bg-emerald-50 text-emerald-700 border border-emerald-200/80 mb-4 shadow-sm">
            <span class="w-2.5 h-2.5 rounded-full bg-emerald-500 animate-pulse"></span>
            Pencapaian Baru: Proyek Sukses Dipublikasikan! ✨
        </div>
        
        <!-- Judul & Narasi Kepuasan -->
        <h1 class="text-2xl sm:text-4xl font-extrabold text-slate-900 tracking-tight">Kerja Bagus, Proyek Resmi Mengudara!</h1>
        <p class="text-sm sm:text-base text-slate-500 mt-3 max-w-xl mx-auto leading-relaxed">
            Selamat! Karya luar biasa Anda berjudul <span class="font-bold text-slate-800">"{{ $project->title }}"</span> telah berhasil disimpan, diverifikasi sistem, dan langsung disinkronkan secara <span class="text-blue-600 font-semibold">realtime</span> ke halaman utama portofolio Anda.
        </p>

        <!-- Kotak Informasi Detail Proyek (Card Terstruktur) -->
        <div class="my-8 max-w-2xl mx-auto bg-slate-50/90 rounded-2xl border border-slate-200/80 p-5 sm:p-6 text-left shadow-sm backdrop-blur-sm">
            <div class="flex flex-col sm:flex-row items-center gap-5">
                @if($project->image)
                    <div class="w-24 h-24 sm:w-28 sm:h-28 rounded-2xl overflow-hidden border-2 border-white shadow-md flex-shrink-0">
                        <img src="{{ asset('storage/' . $project->image) }}" alt="Thumbnail" class="w-full h-full object-cover">
                    </div>
                @else
                    <div class="w-24 h-24 sm:w-28 sm:h-28 rounded-2xl bg-gradient-to-tr from-blue-600 to-indigo-600 text-white font-extrabold flex items-center justify-center text-xl flex-shrink-0 shadow-md">
                        PT
                    </div>
                @endif
                
                <div class="min-w-0 flex-1 text-center sm:text-left space-y-1.5">
                    <div class="flex flex-wrap items-center justify-center sm:justify-start gap-2">
                        <span class="px-3 py-1 rounded-lg text-xs font-bold bg-blue-100 text-blue-800 uppercase tracking-wider">
                            {{ $project->category ?? 'Web Development' }}
                        </span>
                        @if($project->is_featured)
                            <span class="px-2.5 py-1 rounded-lg text-xs font-bold bg-amber-100 text-amber-800">⭐ Unggulan</span>
                        @endif
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 truncate">{{ $project->title }}</h3>
                    <p class="text-xs text-slate-500 line-clamp-2 leading-relaxed">{{ $project->description ?: 'Tidak ada deskripsi tambahan.' }}</p>
                </div>
            </div>

            <!-- Grid Indikator Status Realtime -->
            <div class="grid grid-cols-2 sm:grid-cols-3 gap-3 mt-5 pt-4 border-t border-slate-200/60 text-xs">
                <div class="bg-white p-3 rounded-xl border border-slate-100 shadow-2xs">
                    <p class="text-slate-400 font-medium">Status Publikasi</p>
                    <p class="font-bold text-emerald-600 mt-0.5 flex items-center gap-1">🟢 Aktif (Live)</p>
                </div>
                <div class="bg-white p-3 rounded-xl border border-slate-100 shadow-2xs">
                    <p class="text-slate-400 font-medium">Urutan Tampil</p>
                    <p class="font-bold text-slate-700 mt-0.5">Prioritas #{{ $project->sort_order }}</p>
                </div>
                <div class="bg-white p-3 rounded-xl border border-slate-100 shadow-2xs col-span-2 sm:col-span-1">
                    <p class="text-slate-400 font-medium">Database Sinkron</p>
                    <p class="font-bold text-blue-600 mt-0.5">⚡ 100% Berhasil</p>
                </div>
            </div>
        </div>

        <!-- Tombol Aksi Navigasi Profesional -->
        <div class="flex flex-col sm:flex-row items-center justify-center gap-3 pt-2">
            <a href="{{ route('admin.projects.index') }}" class="w-full sm:w-auto inline-flex items-center justify-center gap-2.5 px-6 py-3.5 bg-slate-100 hover:bg-slate-200 active:scale-[0.98] text-slate-700 font-bold rounded-2xl text-sm transition shadow-sm">
                <svg class="w-4 h-4 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 10h16M4 14h16M4 18h16"/></svg>
                Kelola Daftar Proyek
            </a>
            
            <a href="{{ url('/') }}" target="_blank" class="w-full sm:w-auto inline-flex items-center justify-center gap-2.5 px-7 py-3.5 bg-blue-600 hover:bg-blue-700 active:scale-[0.98] text-white font-bold rounded-2xl text-sm transition shadow-xl shadow-blue-600/25">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                Lihat Hasil di Website Utama
            </a>
        </div>

    </div>

</div>
@endsection