@extends('admin.layouts.app')
@section('title', 'Manajemen Pengalaman Kerja')

@section('content')
<div class="space-y-8 pb-10">

    <!-- Header Banner Modern (Konsisten dengan modul lain) -->
    <div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-slate-900 via-blue-950 to-indigo-950 text-white p-6 sm:p-8 shadow-xl flex flex-col lg:flex-row items-center justify-between">
        <div class="absolute -right-10 -bottom-10 w-64 h-64 bg-blue-600 rounded-full blur-3xl opacity-20 pointer-events-none"></div>
        <div class="absolute -left-10 -top-10 w-64 h-64 bg-indigo-500 rounded-full blur-3xl opacity-20 pointer-events-none"></div>

        <div class="relative z-10 max-w-xl text-center lg:text-left mb-6 lg:mb-0">
            <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-semibold bg-blue-500/25 text-blue-300 border border-blue-400/30 mb-3 backdrop-blur-md">
                💼 Modul Karier Aktif
            </span>
            <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight">Manajemen Pengalaman Kerja</h1>
            <p class="mt-2 text-sm text-slate-300 leading-relaxed">
                Kelola riwayat pekerjaan, posisi profesional, magang, serta deskripsi kontribusi Anda yang terintegrasi secara <span class="text-blue-400 font-semibold">realtime</span> ke halaman utama.
            </p>
        </div>

        <div class="relative z-10 w-36 sm:w-44 lg:w-48 flex-shrink-0">
            <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
            <lottie-player src="https://assets2.lottiefiles.com/packages/lf20_w51pcehl.json" background="transparent" speed="1" style="width: 100%; height: auto;" loop autoplay></lottie-player>
        </div>
    </div>

    <!-- Bar Kontrol & Tombol Tambah -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 bg-white p-4 sm:p-5 rounded-2xl border border-slate-200/80 shadow-sm">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center font-bold">{{ count($experiences) }}</div>
            <div>
                <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">Total Pengalaman</p>
                <p class="text-sm font-bold text-slate-800">Tersimpan di Database</p>
            </div>
        </div>

        <a href="{{ route('admin.experiences.create') }}" class="inline-flex items-center justify-center gap-2 rounded-xl bg-blue-600 hover:bg-blue-700 active:scale-[0.98] px-5 py-3 text-sm font-semibold text-white shadow-lg shadow-blue-600/20 transition-all">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
            Tambah Pengalaman Baru
        </a>
    </div>

    <!-- Tabel Data -->
    <div class="bg-white border border-slate-200/80 rounded-3xl shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-slate-100 bg-slate-50/80 text-xs font-bold uppercase tracking-wider text-slate-400">
                        <th class="py-4 px-6">Posisi & Perusahaan</th>
                        <th class="py-4 px-4">Periode & Lokasi</th>
                        <th class="py-4 px-4 text-center">Status</th>
                        <th class="py-4 px-6 text-right">Aksi Kelola</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-sm">
                    @forelse($experiences as $exp)
                        <tr class="hover:bg-slate-50/60 transition-colors group">
                            <td class="py-4 px-6">
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-blue-500 to-indigo-600 text-white font-extrabold flex items-center justify-center text-sm shadow-sm flex-shrink-0">
                                        💼
                                    </div>
                                    <div>
                                        <p class="font-bold text-slate-900 group-hover:text-blue-600 transition">{{ $exp->position }}</p>
                                        <p class="text-xs text-slate-500 font-semibold">{{ $exp->company }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="py-4 px-4">
                                <span class="inline-flex items-center px-3 py-1 rounded-xl text-xs font-semibold bg-slate-100 text-slate-700">
                                    {{ $exp->period }}
                                </span>
                                <p class="text-xs text-slate-400 mt-1">{{ $exp->location ?? 'Remote / Fleksibel' }}</p>
                            </td>
                            <td class="py-4 px-4 text-center">
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold {{ $exp->is_active ? 'bg-emerald-50 text-emerald-700 border border-emerald-200/50' : 'bg-slate-100 text-slate-500' }}">
                                    <span class="w-1.5 h-1.5 rounded-full {{ $exp->is_active ? 'bg-emerald-500' : 'bg-slate-400' }}"></span>
                                    {{ $exp->is_active ? 'Aktif' : 'Draft' }}
                                </span>
                            </td>
                            <td class="py-4 px-6 text-right">
                                <div class="inline-flex items-center justify-end gap-1.5">
                                    <a href="{{ route('admin.experiences.edit', $exp->id) }}" class="p-2.5 rounded-xl bg-slate-50 hover:bg-emerald-50 text-slate-500 hover:text-emerald-600 transition shadow-sm" title="Edit">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    </a>
                                    <button type="button" onclick="openDeleteModal('{{ route('admin.experiences.destroy', $exp->id) }}', '{{ addslashes($exp->position . ' di ' . $exp->company) }}')" class="p-2.5 rounded-xl bg-slate-50 hover:bg-red-50 text-slate-500 hover:text-red-600 transition shadow-sm" title="Hapus">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="4" class="py-12 text-center text-slate-500">Belum ada data pengalaman kerja.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Konfirmasi Hapus -->
<div id="deleteModal" class="fixed inset-0 z-50 flex items-center justify-center bg-slate-950/50 backdrop-blur-sm opacity-0 pointer-events-none transition-all duration-300">
    <div id="deleteModalBox" class="bg-white rounded-3xl shadow-2xl border border-slate-100 max-w-md w-full p-6 sm:p-8 transform scale-95 transition-all duration-300 text-center mx-4">
        <div class="w-16 h-16 bg-red-50 text-red-500 rounded-2xl flex items-center justify-center mx-auto mb-5 shadow-inner">
            <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
        </div>
        <h3 class="text-xl font-bold text-slate-900 tracking-tight">Hapus Pengalaman Ini?</h3>
        <p class="text-sm text-slate-500 mt-2 mb-6">Anda akan menghapus data <span id="deleteItemName" class="font-bold text-slate-700"></span>.</p>
        <div class="flex items-center gap-3">
            <button type="button" onclick="closeDeleteModal()" class="flex-1 py-3 bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold rounded-xl text-sm transition">Batal</button>
            <form id="deleteForm" method="POST" class="flex-1">
                @csrf @method('DELETE')
                <button type="submit" class="w-full py-3 bg-red-600 hover:bg-red-700 text-white font-semibold rounded-xl text-sm shadow-lg shadow-red-600/20 transition">Ya, Hapus</button>
            </form>
        </div>
    </div>
</div>

<script>
    function openDeleteModal(actionUrl, itemName) {
        document.getElementById('deleteForm').action = actionUrl;
        document.getElementById('deleteItemName').textContent = `"${itemName}"`;
        document.getElementById('deleteModal').classList.remove('opacity-0', 'pointer-events-none');
        document.getElementById('deleteModalBox').classList.remove('scale-95');
        document.getElementById('deleteModalBox').classList.add('scale-100');
    }
    function closeDeleteModal() {
        document.getElementById('deleteModal').classList.add('opacity-0', 'pointer-events-none');
        document.getElementById('deleteModalBox').classList.remove('scale-100');
        document.getElementById('deleteModalBox').classList.add('scale-95');
    }
</script>
@endsection