@extends('admin.layouts.app')
@section('title', 'Manajemen Proyek')

@section('content')
<div class="space-y-8 pb-10">

    <!-- Header Banner Modern dengan Animasi Lottie -->
    <div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-slate-900 via-blue-950 to-indigo-950 text-white p-6 sm:p-8 shadow-xl flex flex-col lg:flex-row items-center justify-between">
        <div class="absolute -right-10 -bottom-10 w-64 h-64 bg-blue-600 rounded-full blur-3xl opacity-20 pointer-events-none"></div>
        <div class="absolute -left-10 -top-10 w-64 h-64 bg-indigo-500 rounded-full blur-3xl opacity-20 pointer-events-none"></div>

        <div class="relative z-10 max-w-xl text-center lg:text-left mb-6 lg:mb-0">
            <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-semibold bg-blue-500/20 text-blue-300 border border-blue-400/30 mb-3 backdrop-blur-md">
                <svg class="w-3.5 h-3.5 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                Modul Portofolio Aktif
            </span>
            <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight">Manajemen Proyek</h1>
            <p class="mt-2 text-sm text-slate-300 leading-relaxed">
                Kelola seluruh daftar proyek, tambahkan karya baru, dan perbarui dokumentasi portofolio yang terintegrasi secara langsung secara <span class="text-blue-400 font-semibold">realtime</span> ke halaman utama situs Anda.
            </p>
        </div>

        <div class="relative z-10 w-36 sm:w-44 lg:w-48 flex-shrink-0">
            <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
            <lottie-player 
                src="https://assets2.lottiefiles.com/packages/lf20_w51pcehl.json" 
                background="transparent" 
                speed="1" 
                style="width: 100%; height: auto;" 
                loop 
                autoplay>
            </lottie-player>
        </div>
    </div>

    <!-- Bar Kontrol & Tombol Aksi Utama -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 bg-white p-4 sm:p-5 rounded-2xl border border-slate-200/80 shadow-sm">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center font-bold">
                {{ count($projects) }}
            </div>
            <div>
                <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">Total Proyek</p>
                <p class="text-sm font-bold text-slate-800">Tersimpan di Database</p>
            </div>
        </div>

        <a href="{{ route('admin.projects.create') }}" class="inline-flex items-center justify-center gap-2 rounded-xl bg-blue-600 hover:bg-blue-700 active:scale-[0.98] px-5 py-3 text-sm font-semibold text-white shadow-lg shadow-blue-600/20 transition-all duration-200">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
            Tambah Proyek Baru
        </a>
    </div>

    <!-- Tabel Data Proyek Bergaya Premium SaaS -->
    <div class="bg-white border border-slate-200/80 rounded-3xl shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-slate-100 bg-slate-50/80 text-xs font-bold uppercase tracking-wider text-slate-400">
                        <th class="py-4 px-6">Informasi Proyek</th>
                        <th class="py-4 px-4">Kategori</th>
                        <th class="py-4 px-4">Status & Atribut</th>
                        <th class="py-4 px-4 text-center">Urutan</th>
                        <th class="py-4 px-6 text-right">Aksi Kelola</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-sm">
                    @forelse($projects as $p)
                        <tr class="hover:bg-slate-50/60 transition-colors group">
                            <!-- Informasi Proyek & Thumbnail -->
                            <td class="py-4 px-6">
                                <div class="flex items-center gap-4">
                                    @if($p->image)
                                        <div class="relative w-14 h-14 rounded-2xl overflow-hidden border border-slate-200 shadow-sm flex-shrink-0 group-hover:scale-105 transition-transform">
                                            <img src="{{ asset('storage/' . $p->image) }}" alt="{{ $p->title }}" class="w-full h-full object-cover">
                                        </div>
                                    @else
                                        <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-blue-500 to-indigo-600 text-white font-extrabold flex items-center justify-center text-sm shadow-sm flex-shrink-0">
                                            PT
                                        </div>
                                    @endif
                                    <div>
                                        <p class="font-bold text-slate-900 group-hover:text-blue-600 transition-colors">{{ $p->title }}</p>
                                        <p class="text-xs text-slate-500 mt-0.5 line-clamp-1 max-w-sm">{{ $p->description ?: 'Tidak ada deskripsi singkat.' }}</p>
                                    </div>
                                </div>
                            </td>

                            <!-- Kategori -->
                            <td class="py-4 px-4">
                                <span class="inline-flex items-center px-3 py-1 rounded-xl text-xs font-semibold bg-slate-100 text-slate-700">
                                    {{ $p->category ?? 'Umum' }}
                                </span>
                            </td>

                            <!-- Status & Unggulan -->
                            <td class="py-4 px-4">
                                <div class="flex items-center gap-2">
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold {{ $p->is_active ? 'bg-emerald-50 text-emerald-700 border border-emerald-200/50' : 'bg-slate-100 text-slate-500' }}">
                                        <span class="w-1.5 h-1.5 rounded-full {{ $p->is_active ? 'bg-emerald-500' : 'bg-slate-400' }}"></span>
                                        {{ $p->is_active ? 'Aktif' : 'Draft' }}
                                    </span>
                                    @if($p->is_featured)
                                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-bold bg-amber-50 text-amber-700 border border-amber-200/50">
                                            ⭐ Unggulan
                                        </span>
                                    @endif
                                </div>
                            </td>

                            <!-- Urutan -->
                            <td class="py-4 px-4 text-center">
                                <span class="inline-flex w-7 h-7 items-center justify-center rounded-lg bg-slate-100 text-xs font-bold text-slate-700">
                                    {{ $p->sort_order }}
                                </span>
                            </td>

                            <!-- Tombol Aksi (CRUD) -->
                            <td class="py-4 px-6 text-right">
                                <div class="inline-flex items-center justify-end gap-1.5">
                                    <!-- View / Detail -->
                                    <a href="{{ route('admin.projects.show', $p->id) }}" class="p-2.5 rounded-xl bg-slate-50 hover:bg-blue-50 text-slate-500 hover:text-blue-600 transition shadow-sm" title="Lihat Detail">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                    </a>
                                    <!-- Edit -->
                                    <a href="{{ route('admin.projects.edit', $p->id) }}" class="p-2.5 rounded-xl bg-slate-50 hover:bg-emerald-50 text-slate-500 hover:text-emerald-600 transition shadow-sm" title="Edit Proyek">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    </a>
                                    <!-- Hapus (Memicu Modal Kustom) -->
                                    <button type="button" onclick="openDeleteModal('{{ route('admin.projects.destroy', $p->id) }}', '{{ addslashes($p->title) }}')" class="p-2.5 rounded-xl bg-slate-50 hover:bg-red-50 text-slate-500 hover:text-red-600 transition shadow-sm" title="Hapus Proyek">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-16 text-center">
                                <div class="max-w-xs mx-auto space-y-3">
                                    <div class="w-16 h-16 bg-blue-50 text-blue-500 rounded-2xl flex items-center justify-center mx-auto text-xl font-bold shadow-inner">📁</div>
                                    <p class="font-bold text-slate-800">Belum ada proyek terdaftar</p>
                                    <p class="text-xs text-slate-400">Mulai tambahkan proyek portofolio pertama Anda agar tampil di website utama.</p>
                                    <a href="{{ route('admin.projects.create') }}" class="inline-block mt-2 px-4 py-2 bg-blue-600 text-white font-semibold rounded-xl text-xs hover:bg-blue-700 transition">Tambah Sekarang</a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>

<!-- ========================================== -->
<!-- MODAL KONFIRMASI HAPUS KUSTOM (PREMIUM) -->
<!-- ========================================== -->
<div id="deleteModal" class="fixed inset-0 z-50 flex items-center justify-center bg-slate-950/50 backdrop-blur-sm opacity-0 pointer-events-none transition-all duration-300">
    <div id="deleteModalBox" class="bg-white rounded-3xl shadow-2xl border border-slate-100 max-w-md w-full p-6 sm:p-8 transform scale-95 transition-all duration-300 text-center mx-4">
        
        <!-- Ikon Sampah Peringatan -->
        <div class="w-16 h-16 bg-red-50 text-red-500 rounded-2xl flex items-center justify-center mx-auto mb-5 shadow-inner">
            <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
            </svg>
        </div>

        <h3 class="text-xl font-bold text-slate-900 tracking-tight">Hapus Proyek Ini?</h3>
        <p class="text-sm text-slate-500 mt-2 mb-2">Anda akan menghapus proyek <span id="deleteProjectName" class="font-bold text-slate-700"></span>.</p>
        <p class="text-xs text-slate-400 mb-6">Tindakan ini bersifat permanen dan tidak dapat dibatalkan dari sistem.</p>

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
    function openDeleteModal(actionUrl, projectName) {
        const modal = document.getElementById('deleteModal');
        const box = document.getElementById('deleteModalBox');
        const form = document.getElementById('deleteForm');
        const nameSpan = document.getElementById('deleteProjectName');

        form.action = actionUrl;
        nameSpan.textContent = `"${projectName}"`;

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