@extends('admin.layouts.app')
@section('title', 'Manajemen Skill & Tools')

@section('content')
<div class="space-y-8 pb-10">

    <!-- 1. HEADER BANNER (Sama Persis dengan Halaman Proyek + Animasi Piala) -->
    <div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-slate-900 via-blue-950 to-indigo-950 text-white p-6 sm:p-8 shadow-xl flex flex-col lg:flex-row items-center justify-between">
        <div class="absolute -right-10 -bottom-10 w-64 h-64 bg-blue-600 rounded-full blur-3xl opacity-20 pointer-events-none"></div>
        <div class="absolute -left-10 -top-10 w-64 h-64 bg-indigo-500 rounded-full blur-3xl opacity-20 pointer-events-none"></div>

        <div class="relative z-10 max-w-xl text-center lg:text-left mb-6 lg:mb-0">
            <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-semibold bg-blue-500/20 text-blue-300 border border-blue-400/30 mb-3 backdrop-blur-md">
                <svg class="w-3.5 h-3.5 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                Modul Kapabilitas Aktif
            </span>
            <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight">Manajemen Skill & Tools</h1>
            <p class="mt-2 text-sm text-slate-300 leading-relaxed">
                Kelola seluruh keahlian Anda, mulai dari <span class="text-blue-400 font-semibold">Soft Skills</span>, <span class="text-blue-400 font-semibold">Hard Skills</span>, hingga penguasaan <span class="text-blue-400 font-semibold">Tools</span> dalam satu pusat kontrol.
            </p>
        </div>

        <!-- Animasi Piala -->
        <div class="relative z-10 w-36 sm:w-44 lg:w-48 flex-shrink-0">
            <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
            <lottie-player 
                src="https://assets3.lottiefiles.com/packages/lf20_touohxv0.json" 
                background="transparent" 
                speed="1" 
                style="width: 100%; height: auto;" 
                loop 
                autoplay>
            </lottie-player>
        </div>
    </div>

    <!-- 2. BAR KONTROL & TOMBOL (Tombol Biru Nyala) -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 bg-white p-4 sm:p-5 rounded-2xl border border-slate-200/80 shadow-sm">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center font-bold">
                {{ count($skills) }}
            </div>
            <div>
                <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">Total Keahlian</p>
                <p class="text-sm font-bold text-slate-800">Tersimpan di Database</p>
            </div>
        </div>

        <a href="{{ route('admin.skills.create') }}" class="inline-flex items-center justify-center gap-2 rounded-xl bg-blue-600 hover:bg-blue-700 active:scale-[0.98] px-5 py-3 text-sm font-semibold text-white shadow-lg shadow-blue-600/20 transition-all duration-200">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
            Tambah Skill Baru
        </a>
    </div>

    <!-- 3. TABEL DATA (Bersih & Rapi) -->
    <div class="bg-white border border-slate-200/80 rounded-3xl shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-slate-100 bg-slate-50/80 text-[11px] font-bold uppercase tracking-wider text-slate-400">
                        <th class="py-4 px-6">Informasi Keahlian</th>
                        <th class="py-4 px-4 text-center">Kategori</th>
                        <th class="py-4 px-4 text-center">Status Publikasi</th>
                        <th class="py-4 px-6 text-right">Aksi Kelola</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-sm">
                    @forelse($skills as $s)
                        <tr class="hover:bg-slate-50/60 transition-colors group">
                            
                            <!-- Nama dan Ikon Skill -->
                            <td class="py-4 px-6">
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 rounded-xl border border-slate-200 bg-white shadow-sm flex items-center justify-center overflow-hidden flex-shrink-0 group-hover:scale-105 transition-transform p-2">
                                        @if($s->icon_url)
                                            <img src="{{ $s->icon_url }}" alt="{{ $s->name }}" class="w-full h-full object-contain">
                                        @else
                                            <span class="font-extrabold text-blue-600 text-sm uppercase">{{ substr($s->name, 0, 2) }}</span>
                                        @endif
                                    </div>
                                    <div>
                                        <p class="font-bold text-slate-900 group-hover:text-blue-600 transition-colors text-base">{{ $s->name }}</p>
                                        <p class="text-xs text-slate-400 mt-0.5">ID: #{{ $s->id }}</p>
                                    </div>
                                </div>
                            </td>

                            <!-- Kategori (Parsing JSON jika nyangkut) -->
                            <td class="py-4 px-4 text-center">
                                @php
                                    $kategori_bersih = 'Umum';
                                    if (is_object($s->category) && isset($s->category->name)) {
                                        $kategori_bersih = $s->category->name;
                                    } elseif (is_string($s->category)) {
                                        if(str_starts_with($s->category, '{')) {
                                            $json_data = json_decode($s->category, true);
                                            $kategori_bersih = $json_data['name'] ?? 'Umum';
                                        } else {
                                            $kategori_bersih = $s->category;
                                        }
                                    }

                                    $badgeColor = 'bg-slate-100 text-slate-600 border-slate-200';
                                    $kategori_lower = strtolower($kategori_bersih);
                                    if(str_contains($kategori_lower, 'hard')) $badgeColor = 'bg-blue-50 text-blue-700 border-blue-200/60';
                                    if(str_contains($kategori_lower, 'soft')) $badgeColor = 'bg-emerald-50 text-emerald-700 border-emerald-200/60';
                                    if(str_contains($kategori_lower, 'tool')) $badgeColor = 'bg-amber-50 text-amber-700 border-amber-200/60';
                                @endphp
                                <span class="inline-flex items-center px-3 py-1 rounded-lg text-[11px] font-bold uppercase tracking-wider border {{ $badgeColor }}">
                                    {{ $kategori_bersih }}
                                </span>
                            </td>

                            <!-- Status -->
                            <td class="py-4 px-4 text-center">
                                <div class="flex items-center justify-center">
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold {{ $s->is_active ? 'bg-emerald-50 text-emerald-700 border border-emerald-200/50' : 'bg-slate-100 text-slate-500 border border-slate-200/50' }}">
                                        <span class="w-1.5 h-1.5 rounded-full {{ $s->is_active ? 'bg-emerald-500' : 'bg-slate-400' }}"></span>
                                        {{ $s->is_active ? 'Aktif' : 'Draft' }}
                                    </span>
                                </div>
                            </td>

                            <!-- Tombol Aksi (CRUD) -->
                            <td class="py-4 px-6 text-right">
                                <div class="inline-flex items-center justify-end gap-1.5">
                                    <a href="{{ route('admin.skills.edit', $s->id) }}" class="p-2.5 rounded-xl bg-slate-50 hover:bg-emerald-50 text-slate-500 hover:text-emerald-600 transition shadow-sm" title="Edit Skill">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    </a>
                                    
                                    <button type="button" onclick="openDeleteModal('{{ route('admin.skills.destroy', $s->id) }}', '{{ addslashes($s->name) }}')" class="p-2.5 rounded-xl bg-slate-50 hover:bg-red-50 text-slate-500 hover:text-red-600 transition shadow-sm" title="Hapus Skill">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="py-16 text-center">
                                <div class="max-w-xs mx-auto space-y-3">
                                    <div class="w-16 h-16 bg-blue-50 text-blue-500 rounded-2xl flex items-center justify-center mx-auto text-xl font-bold shadow-inner">🏆</div>
                                    <p class="font-bold text-slate-800">Belum ada kapabilitas terdaftar</p>
                                    <p class="text-xs text-slate-400">Tambahkan skill pertama Anda agar tampil di website.</p>
                                    <a href="{{ route('admin.skills.create') }}" class="inline-block mt-2 px-4 py-2 bg-blue-600 text-white font-semibold rounded-xl text-xs hover:bg-blue-700 transition">Tambah Sekarang</a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>

<!-- 4. MODAL KONFIRMASI HAPUS -->
<div id="deleteModal" class="fixed inset-0 z-50 flex items-center justify-center bg-slate-950/50 backdrop-blur-sm opacity-0 pointer-events-none transition-all duration-300">
    <div id="deleteModalBox" class="bg-white rounded-3xl shadow-2xl border border-slate-100 max-w-md w-full p-6 sm:p-8 transform scale-95 transition-all duration-300 text-center mx-4">
        
        <div class="w-16 h-16 bg-red-50 text-red-500 rounded-2xl flex items-center justify-center mx-auto mb-5 shadow-inner">
            <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
            </svg>
        </div>

        <h3 class="text-xl font-bold text-slate-900 tracking-tight">Hapus Data Ini?</h3>
        <p class="text-sm text-slate-500 mt-2 mb-2">Anda akan menghapus <span id="deleteSkillName" class="font-bold text-slate-700"></span>.</p>
        <p class="text-xs text-slate-400 mb-6">Tindakan ini bersifat permanen dan tidak dapat dibatalkan.</p>

        <div class="flex items-center gap-3">
            <button type="button" onclick="closeDeleteModal()" class="flex-1 py-3 bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold rounded-xl text-sm transition">
                Batal
            </button>
            <form id="deleteForm" method="POST" class="flex-1">
                @csrf @method('DELETE')
                <button type="submit" class="w-full py-3 bg-red-600 hover:bg-red-700 text-white font-semibold rounded-xl text-sm shadow-lg shadow-red-600/20 transition">
                    Ya, Hapus
                </button>
            </form>
        </div>
    </div>
</div>

<script>
    function openDeleteModal(actionUrl, skillName) {
        const modal = document.getElementById('deleteModal');
        const box = document.getElementById('deleteModalBox');
        const form = document.getElementById('deleteForm');
        const nameSpan = document.getElementById('deleteSkillName');

        form.action = actionUrl;
        nameSpan.textContent = `"${skillName}"`;

        modal.classList.remove('opacity-0', 'pointer-events-none');
        box.classList.remove('scale-95');
        box.classList.add('scale-100');
    }

    function closeDeleteModal() {
        const modal = document.getElementById('deleteModal');
        const box = document.getElementById('deleteModalBox');
        modal.classList.add('opacity-0', 'pointer-events-none');
        box.classList.remove('scale-100');
        box.classList.add('scale-95');
    }
</script>
@endsection