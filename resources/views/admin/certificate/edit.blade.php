@extends('admin.layouts.app')
@section('title', 'Edit Sertifikat')

@section('content')
<div class="max-w-4xl mx-auto space-y-8 pb-12">
    <!-- Header Banner -->
    <div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-slate-900 via-amber-950 to-orange-950 text-white p-6 sm:p-10 shadow-xl flex flex-col sm:flex-row items-center justify-between">
        <div class="absolute -right-10 -bottom-10 w-64 h-64 bg-amber-600 rounded-full blur-3xl opacity-20 pointer-events-none"></div>
        <div class="relative z-10 max-w-lg">
            <a href="{{ route('admin.certificates.index') }}" class="inline-flex items-center gap-1.5 text-xs font-semibold text-amber-300 hover:text-white bg-amber-500/20 px-3 py-1 rounded-full border border-amber-400/30 transition mb-3">
                ← Kembali ke Daftar
            </a>
            <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight">Edit Sertifikat ✍️</h1>
        </div>
    </div>

    <!-- Form -->
    <form action="{{ route('admin.certificates.update', $certificate->id) }}" method="POST" enctype="multipart/form-data" class="bg-white border border-slate-200/80 rounded-3xl shadow-sm p-6 sm:p-10 space-y-6">
        @csrf @method('PUT')
        
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-bold text-slate-800 mb-2">Nama Sertifikat</label>
                <input type="text" name="title" value="{{ old('title', $certificate->title) }}" required class="w-full px-4 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-sm font-medium focus:bg-white focus:border-amber-500">
            </div>
            <div>
                <label class="block text-sm font-bold text-slate-800 mb-2">Penerbit / Institusi</label>
                <input type="text" name="issuer" value="{{ old('issuer', $certificate->issuer) }}" required class="w-full px-4 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-sm font-medium focus:bg-white focus:border-amber-500">
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-bold text-slate-800 mb-2">Tanggal Terbit</label>
                <input type="date" name="issued_date" value="{{ old('issued_date', $certificate->issued_date) }}" required class="w-full px-4 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-sm font-medium focus:bg-white focus:border-amber-500">
            </div>
            <div>
                <label class="block text-sm font-bold text-slate-800 mb-2">URL Kredensial</label>
                <input type="url" name="credential_url" value="{{ old('credential_url', $certificate->credential_url) }}" class="w-full px-4 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-sm font-medium focus:bg-white focus:border-amber-500">
            </div>
        </div>

        <div>
            <label class="block text-sm font-bold text-slate-800 mb-2">File Sertifikat</label>
            @if($certificate->file_path)
                <div class="mb-4 p-3 bg-slate-50 rounded-xl border border-slate-200 text-sm">
                    <span class="font-bold text-slate-700">File Saat ini:</span> {{ basename($certificate->file_path) }}
                </div>
            @endif
            <input type="file" name="file_path" accept=".jpg,.jpeg,.png,.pdf" class="w-full text-sm text-slate-500 file:mr-4 file:py-3 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-bold file:bg-amber-50 file:text-amber-700 bg-slate-50 border border-slate-200 rounded-2xl">
        </div>

        <div>
            <label class="block text-sm font-bold text-slate-800 mb-2">Deskripsi Singkat</label>
            <textarea name="description" rows="3" class="w-full px-4 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-sm font-medium focus:bg-white focus:border-amber-500">{{ old('description', $certificate->description) }}</textarea>
        </div>

        <div class="pt-2">
            <label class="relative flex items-center gap-3 cursor-pointer">
                <input type="checkbox" name="is_active" value="1" {{ $certificate->is_active ? 'checked' : '' }} class="w-5 h-5 rounded-lg border-slate-300 text-amber-500 focus:ring-amber-500">
                <span class="text-sm font-bold text-slate-700">Tampilkan di halaman utama</span>
            </label>
        </div>

        <div class="pt-6 border-t border-slate-100 flex items-center justify-end gap-3">
            <a href="{{ route('admin.certificates.index') }}" class="px-6 py-4 bg-slate-100 text-slate-700 font-bold rounded-2xl text-sm">Batal</a>
            <button type="submit" class="px-10 py-4 bg-amber-500 hover:bg-amber-600 text-white font-extrabold rounded-2xl text-sm shadow-xl shadow-amber-500/25">Perbarui Sertifikat</button>
        </div>
    </form>
</div>
@endsection