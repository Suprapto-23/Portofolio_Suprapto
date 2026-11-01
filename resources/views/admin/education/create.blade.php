@extends('admin.layouts.app')
@section('title', 'Tambah Riwayat Pendidikan')

@section('content')
<div class="max-w-4xl mx-auto space-y-8 pb-12" x-data="{ photoPosition: 'right' }">

    <!-- Header Banner -->
    <div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-slate-900 via-blue-950 to-indigo-950 text-white p-6 sm:p-8 shadow-xl flex items-center justify-between">
        <div class="absolute -right-10 -bottom-10 w-64 h-64 bg-blue-600 rounded-full blur-3xl opacity-20 pointer-events-none"></div>
        <div class="relative z-10 max-w-lg">
            <a href="{{ route('admin.educations.index') }}" class="inline-flex items-center gap-1.5 text-xs font-semibold text-blue-300 hover:text-white bg-blue-500/25 px-3 py-1 rounded-full border border-blue-400/30 transition mb-3">
                ← Kembali ke Daftar
            </a>
            <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight">Tambah Pendidikan & Pengalaman Kuliah 🎓</h1>
        </div>
    </div>

    <!-- Form Utama -->
    <form action="{{ route('admin.educations.store') }}" method="POST" enctype="multipart/form-data" class="bg-white border border-slate-200/80 rounded-3xl shadow-sm p-6 sm:p-10 space-y-6">
        @csrf
        
        <!-- Informasi Akademik Dasar -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-bold text-slate-800 mb-2">Nama Institusi / Kampus <span class="text-red-500">*</span></label>
                <input type="text" name="institution" value="{{ old('institution') }}" required placeholder="Misal: Universitas Indonesia" class="w-full px-4 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-sm font-medium outline-none focus:bg-white focus:border-blue-600">
            </div>
            <div>
                <label class="block text-sm font-bold text-slate-800 mb-2">Jenjang / Gelar <span class="text-red-500">*</span></label>
                <input type="text" name="degree" value="{{ old('degree') }}" required placeholder="Misal: S1 / Diploma III" class="w-full px-4 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-sm font-medium outline-none focus:bg-white focus:border-blue-600">
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
            <div>
                <label class="block text-sm font-bold text-slate-800 mb-2">Jurusan <span class="text-red-500">*</span></label>
                <input type="text" name="major" value="{{ old('major') }}" required placeholder="Misal: Teknik Informatika" class="w-full px-4 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-sm font-medium outline-none focus:bg-white focus:border-blue-600">
            </div>
            <div>
                <label class="block text-sm font-bold text-slate-800 mb-2">IPK <span class="text-red-500">*</span></label>
                <input type="text" name="gpa" value="{{ old('gpa') }}" required placeholder="Misal: 3.85 / 4.00" class="w-full px-4 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-sm font-medium outline-none focus:bg-white focus:border-blue-600">
            </div>
            <div>
                <label class="block text-sm font-bold text-slate-800 mb-2">Periode Tahun <span class="text-red-500">*</span></label>
                <input type="text" name="period" value="{{ old('period') }}" required placeholder="Misal: 2022 - 2026" class="w-full px-4 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-sm font-medium outline-none focus:bg-white focus:border-blue-600">
            </div>
        </div>

        <!-- CUSTOM GRID POSISI FOTO (Kustomisasi Bebas) -->
        <div class="p-6 bg-slate-50/80 rounded-2xl border border-slate-200 space-y-4">
            <label class="block text-sm font-extrabold text-slate-900">Kustomisasi Posisi Foto & Preview Layout (Grid)</label>
            <p class="text-xs text-slate-500">Pilih tata letak posisi foto Anda terhadap kotak deskripsi di halaman utama nanti.</p>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <!-- Pilihan Kiri -->
                <label class="flex items-center gap-3 p-4 bg-white border border-slate-200 rounded-xl cursor-pointer hover:border-blue-500 transition" :class="{'ring-2 ring-blue-600 border-blue-600 bg-blue-50/30': photoPosition === 'left'}">
                    <input type="radio" name="photo_position" value="left" x-model="photoPosition" class="hidden">
                    <span class="text-lg">🖼️ 📝</span>
                    <div>
                        <p class="text-sm font-bold text-slate-800">Foto di Sebelah Kiri</p>
                        <p class="text-[11px] text-slate-500">Layout: [Foto Profil] | [Deskripsi Kuliah]</p>
                    </div>
                </label>

                <!-- Pilihan Kanan -->
                <label class="flex items-center gap-3 p-4 bg-white border border-slate-200 rounded-xl cursor-pointer hover:border-blue-500 transition" :class="{'ring-2 ring-blue-600 border-blue-600 bg-blue-50/30': photoPosition === 'right'}">
                    <input type="radio" name="photo_position" value="right" x-model="photoPosition" class="hidden">
                    <span class="text-lg">📝 🖼️</span>
                    <div>
                        <p class="text-sm font-bold text-slate-800">Foto di Sebelah Kanan</p>
                        <p class="text-[11px] text-slate-500">Layout: [Deskripsi Kuliah] | [Foto Profil]</p>
                    </div>
                </label>
            </div>

            <!-- Upload Foto Profil -->
            <div class="pt-2">
                <label class="block text-sm font-bold text-slate-800 mb-2">Unggah Foto Profil Mahasiswa (Opsional)</label>
                <input type="file" name="photo" accept=".jpg,.jpeg,.png,.webp" class="w-full text-sm text-slate-500 file:mr-4 file:py-3 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-bold file:bg-blue-50 file:text-blue-700 bg-white border border-slate-200 rounded-2xl cursor-pointer">
            </div>
        </div>

        <!-- Deskripsi Selama Kuliah -->
        <div>
            <label class="block text-sm font-bold text-slate-800 mb-2">Pengalaman & Deskripsi Selama Kuliah</label>
            <textarea name="description" rows="5" placeholder="Ceritakan pengalaman organisasi, fokus studi, atau aktivitas berkesan selama menjadi mahasiswa..." class="w-full px-4 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-sm font-medium outline-none focus:bg-white focus:border-blue-600">{{ old('description') }}</textarea>
        </div>

        <!-- Dokumentasi Multiple Galeri Mahasiswa -->
        <div>
            <label class="block text-sm font-bold text-slate-800 mb-2">Dokumentasi Selama Menjadi Mahasiswa (Multiple Images)</label>
            <input type="file" name="documentations[]" multiple accept=".jpg,.jpeg,.png,.webp" class="w-full text-sm text-slate-500 file:mr-4 file:py-3 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-bold file:bg-indigo-50 file:text-indigo-700 bg-slate-50 border border-slate-200 rounded-2xl cursor-pointer">
            <p class="text-xs text-slate-400 mt-1">Anda dapat memilih beberapa foto sekaligus untuk galeri kegiatan kuliah.</p>
        </div>

        <!-- Status Aktif -->
        <div class="pt-2">
            <label class="relative flex items-center gap-3 cursor-pointer">
                <input type="checkbox" name="is_active" value="1" checked class="w-5 h-5 rounded-lg border-slate-300 text-blue-600">
                <span class="text-sm font-bold text-slate-700">Tampilkan di halaman utama website</span>
            </label>
        </div>

        <div class="pt-6 border-t border-slate-100 flex items-center justify-end gap-3">
            <a href="{{ route('admin.educations.index') }}" class="px-6 py-4 bg-slate-100 text-slate-700 font-bold rounded-2xl text-sm">Batal</a>
            <button type="submit" class="px-10 py-4 bg-blue-600 hover:bg-blue-700 text-white font-extrabold rounded-2xl text-sm shadow-xl shadow-blue-600/25">Simpan Pendidikan</button>
        </div>
    </form>
</div>

<script src="//unpkg.com/alpinejs" defer></script>
@endsection