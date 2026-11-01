@extends('admin.layouts.app')
@section('title', 'Manajemen Sertifikat')

@section('content')
<div class="space-y-8 pb-10">

    <!-- Header Banner Modern (Disamakan persis 100% dengan Halaman Proyek) -->
    <div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-slate-900 via-blue-950 to-indigo-950 text-white p-6 sm:p-8 shadow-xl flex flex-col lg:flex-row items-center justify-between">
        <div class="absolute -right-10 -bottom-10 w-64 h-64 bg-blue-600 rounded-full blur-3xl opacity-20 pointer-events-none"></div>
        <div class="absolute -left-10 -top-10 w-64 h-64 bg-indigo-500 rounded-full blur-3xl opacity-20 pointer-events-none"></div>

        <div class="relative z-10 max-w-xl text-center lg:text-left mb-6 lg:mb-0">
            <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-semibold bg-blue-500/20 text-blue-300 border border-blue-400/30 mb-3 backdrop-blur-md">
                <svg class="w-3.5 h-3.5 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                Modul Validasi Aktif
            </span>
            <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight">Manajemen Sertifikat</h1>
            <p class="mt-2 text-sm text-slate-300 leading-relaxed">
                Etalase pencapaian dan validasi kompetensi Anda. Tambahkan <span class="text-blue-400 font-semibold">Sertifikat</span>, <span class="text-blue-400 font-semibold">Lisensi</span>, atau <span class="text-blue-400 font-semibold">Penghargaan</span> yang terintegrasi langsung secara <span class="text-blue-400 font-semibold">realtime</span> ke halaman utama situs Anda.
            </p>
        </div>

        <!-- Animasi Lottie Sertifikat / Medali (Ukuran dan posisi diperjelas) -->
        <div class="relative z-10 w-36 sm:w-44 lg:w-48 flex-shrink-0 flex items-center justify-center">
            <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
            <lottie-player 
                src="https://assets2.lottiefiles.com/packages/lf20_wqd1j1xq.json" 
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
                {{ count($certificates) }}
            </div>
            <div>
                <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">Total Pencapaian</p>
                <p class="text-sm font-bold text-slate-800">Tersimpan di Database</p>
            </div>
        </div>

        <a href="{{ route('admin.certificates.create') }}" class="inline-flex items-center justify-center gap-2 rounded-xl bg-blue-600 hover:bg-blue-700 active:scale-[0.98] px-5 py-3 text-sm font-semibold text-white shadow-lg shadow-blue-600/20 transition-all duration-200">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
            Tambah Sertifikat Baru
        </a>
    </div>

    <!-- Tabel Data Sertifikat Bergaya Premium SaaS -->
    <div class="bg-white border border-slate-200/80 rounded-3xl shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-slate-100 bg-slate-50/80 text-xs font-bold uppercase tracking-wider text-slate-400">
                        <th class="py-4 px-6">Informasi Sertifikat</th>
                        <th class="py-4 px-4">Penerbit & Tanggal</th>
                        <th class="py-4 px-4">Status Publikasi</th>
                        <th class="py-4 px-6 text-right">Aksi Kelola</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-sm">
                    @forelse($certificates as $cert)
                        <tr class="hover:bg-slate-50/60 transition-colors group">
                            <!-- Informasi Sertifikat & Thumbnail -->
                            <td class="py-4 px-6">
                                <div class="flex items-center gap-4">
                                    @if($cert->file_path)
                                        <div class="relative w-14 h-14 rounded-2xl overflow-hidden border border-slate-200 shadow-sm flex-shrink-0 group-hover:scale-105 transition-transform flex items-center justify-center bg-slate-50">
                                            @if(Str::endsWith($cert->file_path, '.pdf'))
                                                <span class="text-red-500 font-bold text-xs">PDF</span>
                                            @else
                                                <img src="{{ asset('storage/' . $cert->file_path) }}" alt="{{ $cert->title }}" class="w-full h-full object-cover">
                                            @endif
                                        </div>
                                    @else
                                        <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-blue-500 to-indigo-600 text-white font-extrabold flex items-center justify-center text-sm shadow-sm flex-shrink-0">
                                            📜
                                        </div>
                                    @endif
                                    <div>
                                        <p class="font-bold text-slate-900 group-hover:text-blue-600 transition-colors">{{ $cert->title }}</p>
                                        @if($cert->credential_url)
                                            <a href="{{ $cert->credential_url }}" target="_blank" class="text-xs text-blue-500 hover:underline mt-0.5 inline-flex items-center gap-1 font-medium">
                                                Verifikasi Kredensial <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                                            </a>
                                        @else
                                            <p class="text-xs text-slate-400 mt-0.5">Tidak ada link verifikasi</p>
                                        @endif
                                    </div>
                                </div>
                            </td>

                            <!-- Penerbit -->
                            <td class="py-4 px-4">
                                <span class="inline-flex items-center px-3 py-1 rounded-xl text-xs font-semibold bg-slate-100 text-slate-700">
                                    {{ $cert->issuer }}
                                </span>
                                <p class="text-xs text-slate-400 mt-1 font-medium">{{ \Carbon\Carbon::parse($cert->issued_date)->translatedFormat('F Y') }}</p>
                            </td>

                            <!-- Status -->
                            <td class="py-4 px-4">
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold {{ $cert->is_active ? 'bg-emerald-50 text-emerald-700 border border-emerald-200/50' : 'bg-slate-100 text-slate-500' }}">
                                    <span class="w-1.5 h-1.5 rounded-full {{ $cert->is_active ? 'bg-emerald-500' : 'bg-slate-400' }}"></span>
                                    {{ $cert->is_active ? 'Aktif' : 'Draft' }}
                                </span>
                            </td>

                            <!-- Tombol Aksi (CRUD) -->
                            <td class="py-4 px-6 text-right">
                                <div class="inline-flex items-center justify-end gap-1.5">
                                    <a href="{{ route('admin.certificates.edit', $cert->id) }}" class="p-2.5 rounded-xl bg-slate-50 hover:bg-emerald-50 text-slate-500 hover:text-emerald-600 transition shadow-sm" title="Edit Sertifikat">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    </a>
                                    <button type="button" onclick="openDeleteModal('{{ route('admin.certificates.destroy', $cert->id) }}', '{{ addslashes($cert->title) }}')" class="p-2.5 rounded-xl bg-slate-50 hover:bg-red-50 text-slate-500 hover:text-red-600 transition shadow-sm" title="Hapus Sertifikat">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="py-16 text-center">
                                <div class="max-w-xs mx-auto space-y-3">
                                    <div class="w-16 h-16 bg-blue-50 text-blue-500 rounded-2xl flex items-center justify-center mx-auto text-xl font-bold shadow-inner">📜</div>
                                    <p class="font-bold text-slate-800">Belum ada sertifikat terdaftar</p>
                                    <p class="text-xs text-slate-400">Mulai tambahkan sertifikat atau penghargaan pertama Anda agar tampil di website utama.</p>
                                    <a href="{{ route('admin.certificates.create') }}" class="inline-block mt-2 px-4 py-2 bg-blue-600 text-white font-semibold rounded-xl text-xs hover:bg-blue-700 transition">Tambah Sekarang</a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>

<!-- Modal Konfirmasi Hapus Kustom (Premium) -->
<div id="deleteModal" class="fixed inset-0 z-50 flex items-center justify-center bg-slate-950/50 backdrop-blur-sm opacity-0 pointer-events-none transition-all duration-300">
    <div id="deleteModalBox" class="bg-white rounded-3xl shadow-2xl border border-slate-100 max-w-md w-full p-6 sm:p-8 transform scale-95 transition-all duration-300 text-center mx-4">
        
        <div class="w-16 h-16 bg-red-50 text-red-500 rounded-2xl flex items-center justify-center mx-auto mb-5 shadow-inner">
            <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
            </svg>
        </div>

        <h3 class="text-xl font-bold text-slate-900 tracking-tight">Hapus Sertifikat Ini?</h3>
        <p class="text-sm text-slate-500 mt-2 mb-2">Anda akan menghapus sertifikat <span id="deleteItemName" class="font-bold text-slate-700"></span>.</p>
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
    function openDeleteModal(actionUrl, itemName) {
        const modal = document.getElementById('deleteModal');
        const box = document.getElementById('deleteModalBox');
        const form = document.getElementById('deleteForm');
        const nameSpan = document.getElementById('deleteItemName');

        form.action = actionUrl;
        nameSpan.textContent = `"${itemName}"`;

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