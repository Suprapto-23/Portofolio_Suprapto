@extends('admin.layouts.app')
@section('title', 'Edit Riwayat Pendidikan')

@section('content')
<div class="max-w-4xl mx-auto space-y-8 pb-12" x-data="{ photoPosition: '{{ $education->photo_position }}' }">

    <div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-slate-900 via-blue-950 to-indigo-950 text-white p-6 sm:p-8 shadow-xl flex items-center justify-between">
        <div class="relative z-10 max-w-lg">
            <a href="{{ route('admin.educations.index') }}" class="inline-flex items-center gap-1.5 text-xs font-semibold text-blue-300 hover:text-white bg-blue-500/25 px-3 py-1 rounded-full border border-blue-400/30 transition mb-3">
                ← Kembali ke Daftar
            </a>
            <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight">Edit Pendidikan ✍️</h1>
        </div>
    </div>

    <form action="{{ route('admin.educations.update', $education->id) }}" method="POST" enctype="multipart/form-data" class="bg-white border border-slate-200/80 rounded-3xl shadow-sm p-6 sm:p-10 space-y-6">
        @csrf @method('PUT')
        
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-bold text-slate-800 mb-2">Nama Institusi / Kampus</label>
                <input type="text" name="institution" value="{{ old('institution', $education->institution) }}" required class="w-full px-4 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-sm font-medium focus:bg-white focus:border-blue-600">
            </div>
            <div>
                <label class="block text-sm font-bold text-slate-800 mb-2">Jenjang / Gelar</label>
                <input type="text" name="degree" value="{{ old('degree', $education->degree) }}" required class="w-full px-4 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-sm font-medium focus:bg-white focus:border-blue-600">
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
            <div>
                <label class="block text-sm font-bold text-slate-800 mb-2">Jurusan</label>
                <input type="text" name="major" value="{{ old('major', $education->major) }}" required class="w-full px-4 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-sm font-medium focus:bg-white focus:border-blue-600">
            </div>
            <div>
                <label class="block text-sm font-bold text-slate-800 mb-2">IPK</label>
                <input type="text" name="gpa" value="{{ old('gpa', $education->gpa) }}" required class="w-full px-4 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-sm font-medium focus:bg-white focus:border-blue-600">
            </div>
            <div>
                <label class="block text-sm font-bold text-slate-800 mb-2">Periode Tahun</label>
                <input type="text" name="period" value="{{ old('period', $education->period) }}" required class="w-full px-4 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-sm font-medium focus:bg-white focus:border-blue-600">
            </div>
        </div>

        <!-- Custom Grid Posisi Foto -->
        <div class="p-6 bg-slate-50/80 rounded-2xl border border-slate-200 space-y-4">
            <label class="block text-sm font-extrabold text-slate-900">Kustomisasi Posisi Foto</label>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <label class="flex items-center gap-3 p-4 bg-white border border-slate-200 rounded-xl cursor-pointer transition" :class="{'ring-2 ring-blue-600 border-blue-600 bg-blue-50/30': photoPosition === 'left'}">
                    <input type="radio" name="photo_position" value="left" x-model="photoPosition" class="hidden">
                    <span class="text-sm font-bold text-slate-800">🖼️ Foto di Kiri</span>
                </label>
                <label class="flex items-center gap-3 p-4 bg-white border border-slate-200 rounded-xl cursor-pointer transition" :class="{'ring-2 ring-blue-600 border-blue-600 bg-blue-50/30': photoPosition === 'right'}">
                    <input type="radio" name="photo_position" value="right" x-model="photoPosition" class="hidden">
                    <span class="text-sm font-bold text-slate-800">Foto di Kanan 📝</span>
                </label>
            </div>

            <div class="pt-2">
                <label class="block text-sm font-bold text-slate-800 mb-2">Ganti Foto Profil</label>
                @if($education->photo)
                    <div class="mb-3 w-16 h-16 rounded-xl overflow-hidden border border-slate-200">
                        <img src="{{ asset('storage/' . $education->photo) }}" class="w-full h-full object-cover">
                    </div>
                @endif
                <input type="file" name="photo" accept=".jpg,.jpeg,.png,.webp" class="w-full text-sm text-slate-500 file:mr-4 file:py-3 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-bold file:bg-blue-50 file:text-blue-700 bg-white border border-slate-200 rounded-2xl cursor-pointer">
            </div>
        </div>

        <div>
            <label class="block text-sm font-bold text-slate-800 mb-2">Pengalaman & Deskripsi Kuliah</label>
            <textarea name="description" rows="5" class="w-full px-4 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-sm font-medium focus:bg-white focus:border-blue-600">{{ old('description', $education->description) }}</textarea>
        </div>

        <div>
            <label class="block text-sm font-bold text-slate-800 mb-2">Tambah Dokumentasi Baru (Galeri)</label>
            @if($education->documentations)
                <div class="flex flex-wrap gap-3 mb-3">
                    @foreach(json_decode($education->documentations, true) as $img)
                        <div class="w-16 h-16 rounded-xl overflow-hidden border border-slate-200 relative">
                            <img src="{{ asset('storage/' . $img) }}" class="w-full h-full object-cover">
                        </div>
                    @endforeach
                </div>
            @endif
            <input type="file" name="documentations[]" multiple accept=".jpg,.jpeg,.png,.webp" class="w-full text-sm text-slate-500 file:mr-4 file:py-3 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-bold file:bg-indigo-50 file:text-indigo-700 bg-slate-50 border border-slate-200 rounded-2xl cursor-pointer">
        </div>

        <div class="pt-2">
            <label class="relative flex items-center gap-3 cursor-pointer">
                <input type="checkbox" name="is_active" value="1" {{ $education->is_active ? 'checked' : '' }} class="w-5 h-5 rounded-lg border-slate-300 text-blue-600">
                <span class="text-sm font-bold text-slate-700">Tampilkan di halaman utama</span>
            </label>
        </div>

        <div class="pt-6 border-t border-slate-100 flex items-center justify-end gap-3">
            <a href="{{ route('admin.educations.index') }}" class="px-6 py-4 bg-slate-100 text-slate-700 font-bold rounded-2xl text-sm">Batal</a>
            <button type="submit" class="px-10 py-4 bg-blue-600 hover:bg-blue-700 text-white font-extrabold rounded-2xl text-sm shadow-xl">Perbarui Pendidikan</button>
        </div>
    </form>
</div>
<script src="//unpkg.com/alpinejs" defer></script>
@endsection