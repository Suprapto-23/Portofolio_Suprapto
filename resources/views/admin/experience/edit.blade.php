@extends('admin.layouts.app')
@section('title', 'Edit Pengalaman Kerja')

@section('content')
<div class="max-w-3xl mx-auto space-y-8 pb-12">
    <div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-slate-900 via-blue-950 to-indigo-950 text-white p-6 sm:p-8 shadow-xl flex items-center justify-between">
        <div class="relative z-10 max-w-lg">
            <a href="{{ route('admin.experiences.index') }}" class="inline-flex items-center gap-1.5 text-xs font-semibold text-blue-300 hover:text-white bg-blue-500/25 px-3 py-1 rounded-full border border-blue-400/30 transition mb-3">
                ← Kembali ke Daftar
            </a>
            <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight">Edit Pengalaman ✍️</h1>
        </div>
    </div>

    <form action="{{ route('admin.experiences.update', $experience->id) }}" method="POST" class="bg-white border border-slate-200/80 rounded-3xl shadow-sm p-6 sm:p-10 space-y-6">
        @csrf @method('PUT')
        
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-bold text-slate-800 mb-2">Posisi / Jabatan</label>
                <input type="text" name="position" value="{{ old('position', $experience->position) }}" required class="w-full px-4 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-sm font-medium focus:bg-white focus:border-blue-600">
            </div>
            <div>
                <label class="block text-sm font-bold text-slate-800 mb-2">Perusahaan / Instansi</label>
                <input type="text" name="company" value="{{ old('company', $experience->company) }}" required class="w-full px-4 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-sm font-medium focus:bg-white focus:border-blue-600">
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-bold text-slate-800 mb-2">Periode</label>
                <input type="text" name="period" value="{{ old('period', $experience->period) }}" required class="w-full px-4 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-sm font-medium focus:bg-white focus:border-blue-600">
            </div>
            <div>
                <label class="block text-sm font-bold text-slate-800 mb-2">Lokasi</label>
                <input type="text" name="location" value="{{ old('location', $experience->location) }}" class="w-full px-4 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-sm font-medium focus:bg-white focus:border-blue-600">
            </div>
        </div>

        <div>
            <label class="block text-sm font-bold text-slate-800 mb-2">Deskripsi Pekerjaan / Tugas</label>
            <textarea name="description" rows="5" class="w-full px-4 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-sm font-medium focus:bg-white focus:border-blue-600">{{ old('description', $experience->description) }}</textarea>
        </div>

        <div class="pt-2">
            <label class="relative flex items-center gap-3 cursor-pointer">
                <input type="checkbox" name="is_active" value="1" {{ $experience->is_active ? 'checked' : '' }} class="w-5 h-5 rounded-lg border-slate-300 text-blue-600">
                <span class="text-sm font-bold text-slate-700">Tampilkan di halaman utama website</span>
            </label>
        </div>

        <div class="pt-6 border-t border-slate-100 flex items-center justify-end gap-3">
            <a href="{{ route('admin.experiences.index') }}" class="px-6 py-4 bg-slate-100 text-slate-700 font-bold rounded-2xl text-sm">Batal</a>
            <button type="submit" class="px-10 py-4 bg-blue-600 hover:bg-blue-700 text-white font-extrabold rounded-2xl text-sm shadow-xl">Perbarui Pengalaman</button>
        </div>
    </form>
</div>
@endsection