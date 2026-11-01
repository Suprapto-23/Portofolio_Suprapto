@extends('admin.layouts.app')
@section('title', 'Dashboard')

@section('content')
    @php
        $cards = [
            ['key' => 'projects', 'label' => 'Total Proyek', 'icon' => 'M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z', 'color' => 'bg-blue-50 text-blue-600'],
            ['key' => 'skills', 'label' => 'Keahlian (Skills)', 'icon' => 'M13 10V3L4 14h7v7l9-11h-7z', 'color' => 'bg-emerald-50 text-emerald-600'],
            ['key' => 'certifications', 'label' => 'Sertifikat', 'icon' => 'M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z', 'color' => 'bg-amber-50 text-amber-600'],
            ['key' => 'experiences', 'label' => 'Pengalaman', 'icon' => 'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4', 'color' => 'bg-purple-50 text-purple-600'],
            ['key' => 'unread', 'label' => 'Pesan Masuk (Baru)', 'icon' => 'M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z', 'color' => 'bg-rose-50 text-rose-600'],
        ];
    @endphp

    <!-- Script Lottie Standar Paling Stabil -->
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
    <!-- Chart.js CDN untuk Grafik -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Banner Selamat Datang dengan Animasi Lottie Baru -->
    <div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-blue-900 via-blue-800 to-indigo-900 text-white p-6 sm:p-8 shadow-xl mb-8 flex flex-col lg:flex-row items-center justify-between">
        <!-- Efek Ornamen Background -->
        <div class="absolute -right-10 -bottom-10 w-64 h-64 bg-blue-500 rounded-full blur-3xl opacity-20 pointer-events-none"></div>
        <div class="absolute -left-10 -top-10 w-64 h-64 bg-indigo-500 rounded-full blur-3xl opacity-20 pointer-events-none"></div>

        <div class="relative z-10 max-w-xl text-center lg:text-left mb-6 lg:mb-0">
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-blue-500/30 text-blue-200 border border-blue-400/30 mb-3 backdrop-blur-sm">
                <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span> Sistem Aktif & Normal
            </span>
            <h1 class="text-2xl sm:text-3xl font-bold tracking-tight">Selamat Datang Kembali, {{ auth()->user()->name ?? 'Suprapto' }}! 👋</h1>
            <p class="mt-2 text-sm text-blue-100/80 leading-relaxed">
                Kelola seluruh portofolio, proyek, dan interaksi klien Anda dengan mudah dari panel kendali terpusat Pra Tecnology.
            </p>
            <div class="mt-5 flex flex-wrap gap-3 justify-center lg:justify-start">
                <a href="{{ url('/') }}" target="_blank" class="px-4 py-2.5 bg-white text-blue-900 font-semibold rounded-xl text-sm shadow-sm hover:bg-blue-50 transition flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                    Lihat Website Live
                </a>
            </div>
        </div>

        <!-- Animasi Lottie Dashboard Baru -->
        <div class="relative z-10 w-48 sm:w-56 lg:w-64 flex-shrink-0">
            <lottie-player 
                src="https://assets3.lottiefiles.com/packages/lf20_w51pcehl.json" 
                background="transparent" 
                speed="1" 
                style="width: 100%; height: auto;" 
                loop 
                autoplay>
            </lottie-player>
        </div>
    </div>

    <!-- Statistik Grid Kartu -->
    <div class="grid gap-5 sm:grid-cols-2 xl:grid-cols-5">
        @foreach ($cards as $c)
            <div class="rounded-2xl border border-slate-200/80 bg-white p-5 shadow-sm transition-all duration-300 hover:-translate-y-1 hover:shadow-md flex items-center justify-between">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">{{ $c['label'] }}</p>
                    <p data-stat="{{ $c['key'] }}" class="mt-2 text-3xl font-extrabold tracking-tight text-slate-900 transition-colors">
                        {{ $stats[$c['key']] }}
                    </p>
                </div>
                <div class="flex h-12 w-12 items-center justify-center rounded-2xl {{ $c['color'] }}">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="{{ $c['icon'] }}"/>
                    </svg>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Bagian Grafik Statistik & Proyek Terbaru -->
    <div class="mt-8 grid gap-6 lg:grid-cols-3">
        
        <!-- Grafik Visualisasi (Menggunakan Chart.js) -->
        <div class="rounded-2xl border border-slate-200/80 bg-white p-6 shadow-sm lg:col-span-1 flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between mb-4">
                    <h2 class="font-bold text-slate-800 tracking-tight">Statistik Portofolio</h2>
                    <span class="text-xs font-medium text-slate-400 bg-slate-100 px-2.5 py-1 rounded-lg">Ringkasan</span>
                </div>
                <p class="text-xs text-slate-500 mb-4">Perbandingan jumlah item data portofolio aktif Anda saat ini.</p>
            </div>
            <div class="relative w-full h-64 flex items-center justify-center">
                <canvas id="portfolioChart"></canvas>
            </div>
        </div>

        <!-- Proyek Terbaru -->
        <section class="rounded-2xl border border-slate-200/80 bg-white p-6 shadow-sm lg:col-span-1">
            <div class="flex items-center justify-between mb-4">
                <h2 class="font-bold text-slate-800 tracking-tight">Proyek Terbaru</h2>
                <a href="{{ route('admin.projects.index') }}" class="text-xs font-semibold text-blue-600 hover:text-blue-700">Lihat Semua →</a>
            </div>
            <ul class="divide-y divide-slate-100">
                @forelse ($projects as $p)
                    <li class="py-3.5 text-sm flex items-center justify-between">
                        <div>
                            <span class="font-semibold text-slate-800 block">{{ $p->title }}</span>
                            <span class="text-xs text-slate-400">{{ $p->category ?? 'Web App' }}</span>
                        </div>
                        <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-medium bg-blue-50 text-blue-700">Aktif</span>
                    </li>
                @empty
                    <li class="py-8 text-center text-sm text-slate-400">Belum ada proyek yang ditambahkan.</li>
                @endforelse
            </ul>
        </section>

        <!-- Pesan Masuk Terbaru -->
        <section class="rounded-2xl border border-slate-200/80 bg-white p-6 shadow-sm lg:col-span-1">
            <div class="flex items-center justify-between mb-4">
                <h2 class="font-bold text-slate-800 tracking-tight">Pesan Masuk</h2>
                <a href="{{ route('admin.messages.index') }}" class="text-xs font-semibold text-blue-600 hover:text-blue-700">Lihat Semua →</a>
            </div>
            <ul class="divide-y divide-slate-100">
                @forelse ($messages as $m)
                    <li class="py-3.5 text-sm">
                        <div class="flex items-center justify-between">
                            <span class="font-semibold text-slate-800">{{ $m->name }}</span>
                            <span class="rounded-lg px-2.5 py-0.5 text-xs font-semibold {{ $m->status === 'unread' ? 'bg-rose-50 text-rose-600' : 'bg-slate-100 text-slate-500' }}">
                                {{ $m->status === 'unread' ? 'Baru' : 'Dibaca' }}
                            </span>
                        </div>
                        <p class="mt-1 truncate text-xs text-slate-500">{{ $m->subject ?: \Illuminate\Support\Str::limit($m->message, 50) }}</p>
                        <p class="mt-1 text-[11px] text-slate-400">{{ $m->created_at ? \Carbon\Carbon::parse($m->created_at)->diffForHumans() : '-' }}</p>
                    </li>
                @empty
                    <li class="py-8 text-center text-sm text-slate-400">Belum ada pesan masuk.</li>
                @endforelse
            </ul>
        </section>

    </div>
@endsection

@push('scripts')
<script>
    // Inisialisasi Grafik Chart.js
    document.addEventListener("DOMContentLoaded", function() {
        const ctx = document.getElementById('portfolioChart').getContext('2d');
        const portfolioChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Proyek', 'Keahlian', 'Sertifikat', 'Pengalaman'],
                datasets: [{
                    data: [
                        {{ $stats['projects'] }}, 
                        {{ $stats['skills'] }}, 
                        {{ $stats['certifications'] }}, 
                        {{ $stats['experiences'] }}
                    ],
                    backgroundColor: [
                        '#2563eb', // Blue-600
                        '#10b981', // Emerald-500
                        '#f59e0b', // Amber-500
                        '#8b5cf6'  // Purple-500
                    ],
                    borderWidth: 2,
                    borderColor: '#ffffff'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            boxWidth: 12,
                            font: {
                                size: 11,
                                family: 'sans-serif'
                            }
                        }
                    }
                },
                cutout: '65%'
            }
        });
    });

    // Auto Refresh Stats setiap 15 detik secara real-time via AJAX
    async function refreshStats() {
        try {
            const r = await fetch(@json(route('admin.stats')), { headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' } });
            if (!r.ok) return;
            const d = await r.json();
            Object.entries(d).forEach(([k, v]) => {
                const el = document.querySelector('[data-stat="' + k + '"]');
                if (el && el.textContent.trim() !== String(v)) {
                    el.textContent = v;
                    el.classList.add('text-blue-600');
                    setTimeout(() => el.classList.remove('text-blue-600'), 900);
                }
            });
        } catch (e) {}
    }
    setInterval(refreshStats, 15000);
</script>
@endpush