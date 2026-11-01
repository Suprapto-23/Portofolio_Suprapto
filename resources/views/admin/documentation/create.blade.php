@extends('admin.layouts.app')
@section('title', 'Tambah Dokumentasi')

@section('content')
<div class="max-w-3xl mx-auto space-y-8 pb-12">
    <div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-slate-900 via-blue-950 to-indigo-950 text-white p-6 sm:p-8 shadow-xl flex items-center justify-between">
        <div class="relative z-10 max-w-lg">
            <a href="{{ route('admin.documentations.index') }}" class="inline-flex items-center gap-1.5 text-xs font-semibold text-blue-300 hover:text-white bg-blue-500/25 px-3 py-1 rounded-full border border-blue-400/30 transition mb-3">
                ← Kembali ke Daftar
            </a>
            <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight">Tambah Dokumentasi Baru 📸</h1>
        </div>
    </div>

    <form action="{{ route('admin.documentations.store') }}" method="POST" enctype="multipart/form-data" class="bg-white border border-slate-200/80 rounded-3xl shadow-sm p-6 sm:p-10 space-y-6">
        @csrf
        
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-bold text-slate-800 mb-2">Judul Dokumentasi <span class="text-red-500">*</span></label>
                <input type="text" name="title" value="{{ old('title') }}" required placeholder="Misal: Seminar Nasional Teknologi" class="w-full px-4 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-sm font-medium outline-none focus:bg-white focus:border-blue-600">
            </div>
            <div>
                <label class="block text-sm font-bold text-slate-800 mb-2">Kategori</label>
                <input type="text" name="category" value="{{ old('category') }}" placeholder="Misal: Kegiatan / Event / Organisasi" class="w-full px-4 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-sm font-medium outline-none focus:bg-white focus:border-blue-600">
            </div>
        </div>

        <div>
            <label class="block text-sm font-bold text-slate-800 mb-2">Unggah Foto Dokumentasi <span class="text-red-500">*</span></label>
            <input type="file" name="image_path" accept=".jpg,.jpeg,.png,.webp" required class="w-full text-sm text-slate-500 file:mr-4 file:py-3 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-bold file:bg-blue-50 file:text-blue-700 bg-slate-50 border border-slate-200 rounded-2xl cursor-pointer">
            <p class="text-xs text-slate-400 mt-1">Mendukung format JPG, PNG, WEBP (Maksimal 5MB).</p>
        </div>

        <div>
            <label class="block text-sm font-bold text-slate-800 mb-2">Deskripsi Singkat</label>
            <textarea name="description" rows="4" placeholder="Tuliskan keterangan atau cerita singkat di balik dokumentasi ini..." class="w-full px-4 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-sm font-medium outline-none focus:bg-white focus:border-blue-600">{{ old('description') }}</textarea>
        </div>

        <div class="pt-2">
            <label class="relative flex items-center gap-3 cursor-pointer">
                <input type="checkbox" name="is_active" value="1" checked class="w-5 h-5 rounded-lg border-slate-300 text-blue-600">
                <span class="text-sm font-bold text-slate-700">Tampilkan di halaman publik website</span>
            </label>
        </div>

        <div class="pt-6 border-t border-slate-100 flex items-center justify-end gap-3">
            <a href="{{ route('admin.documentations.index') }}" class="px-6 py-4 bg-slate-100 text-slate-700 font-bold rounded-2xl text-sm">Batal</a>
            <button type="submit" class="px-10 py-4 bg-blue-600 hover:bg-blue-700 text-white font-extrabold rounded-2xl text-sm shadow-xl">Simpan Dokumentasi</button>
        </div>
    </form>
</div>
@endsection