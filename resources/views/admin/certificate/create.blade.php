@extends('admin.layouts.app')
@section('title', 'Tambah Sertifikat')

@section('content')
<div class="max-w-4xl mx-auto space-y-8 pb-12">

    <!-- Header Banner Modern (Konsisten dengan Halaman Proyek & Skill) -->
    <div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-slate-900 via-blue-950 to-indigo-950 text-white p-6 sm:p-10 shadow-xl flex flex-col sm:flex-row items-center justify-between">
        <div class="absolute -right-10 -bottom-10 w-64 h-64 bg-blue-600 rounded-full blur-3xl opacity-20 pointer-events-none"></div>
        <div class="absolute -left-10 -top-10 w-64 h-64 bg-indigo-500 rounded-full blur-3xl opacity-20 pointer-events-none"></div>

        <div class="relative z-10 max-w-lg text-center sm:text-left mb-6 sm:mb-0">
            <a href="{{ route('admin.certificates.index') }}" class="inline-flex items-center gap-1.5 text-xs font-semibold text-blue-300 hover:text-white bg-blue-500/20 px-3 py-1 rounded-full border border-blue-400/30 transition mb-3 backdrop-blur-md">
                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                Kembali ke Daftar
            </a>
            <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight">Tambah Sertifikat Baru 📜</h1>
            <p class="mt-2 text-sm text-slate-300 leading-relaxed">
                Tambahkan sertifikasi, lisensi, atau penghargaan resmi untuk memvalidasi keahlian Anda di halaman utama portofolio.
            </p>
        </div>
        
        <!-- Animasi Lottie Sertifikat / Penghargaan -->
        <div class="relative z-10 w-36 sm:w-44 flex-shrink-0 flex items-center justify-center">
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

    <!-- Form Utama Bergaya SaaS Premium -->
    <form action="{{ route('admin.certificates.store') }}" method="POST" enctype="multipart/form-data" class="bg-white border border-slate-200/80 rounded-3xl shadow-sm p-6 sm:p-10 space-y-6">
        @csrf
        
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-bold text-slate-800 mb-2">Nama Sertifikat / Penghargaan <span class="text-red-500">*</span></label>
                <input type="text" name="title" value="{{ old('title') }}" required placeholder="Misal: Belajar Dasar AWS Cloud" class="w-full px-4 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-sm font-medium focus:bg-white focus:border-blue-600 focus:ring-4 focus:ring-blue-600/10 transition-all outline-none text-slate-800">
            </div>
            <div>
                <label class="block text-sm font-bold text-slate-800 mb-2">Penerbit / Institusi <span class="text-red-500">*</span></label>
                <input type="text" name="issuer" value="{{ old('issuer') }}" required placeholder="Misal: Dicoding Academy / Coursera" class="w-full px-4 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-sm font-medium focus:bg-white focus:border-blue-600 focus:ring-4 focus:ring-blue-600/10 transition-all outline-none text-slate-800">
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-bold text-slate-800 mb-2">Tanggal Terbit <span class="text-red-500">*</span></label>
                <input type="date" name="issued_date" value="{{ old('issued_date') }}" required class="w-full px-4 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-sm font-medium focus:bg-white focus:border-blue-600 focus:ring-4 focus:ring-blue-600/10 transition-all outline-none text-slate-800">
            </div>
            <div>
                <label class="block text-sm font-bold text-slate-800 mb-2">URL Verifikasi Kredensial (Opsional)</label>
                <input type="url" name="credential_url" value="{{ old('credential_url') }}" placeholder="https://www.dicoding.com/certificates/..." class="w-full px-4 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-sm font-medium focus:bg-white focus:border-blue-600 focus:ring-4 focus:ring-blue-600/10 transition-all outline-none text-slate-800">
            </div>
        </div>

        <div>
            <label class="block text-sm font-bold text-slate-800 mb-2">Berkas Sertifikat / Gambar (Opsional)</label>
            <input type="file" name="file_path" accept=".jpg,.jpeg,.png,.webp,.pdf" class="w-full text-sm text-slate-500 file:mr-4 file:py-3 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-bold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 transition cursor-pointer bg-slate-50 border border-slate-200 rounded-2xl">
            <p class="text-xs text-slate-400 mt-2">Mendukung format JPG, PNG, WEBP, dan PDF (Maksimal 5MB).</p>
        </div>

        <div>
            <label class="block text-sm font-bold text-slate-800 mb-2">Deskripsi Singkat (Opsional)</label>
            <textarea name="description" rows="3" placeholder="Tuliskan ringkasan materi atau kompetensi yang dipelajari..." class="w-full px-4 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-sm font-medium focus:bg-white focus:border-blue-600 focus:ring-4 focus:ring-blue-600/10 transition-all outline-none text-slate-800">{{ old('description') }}</textarea>
        </div>

        <div class="pt-2">
            <label class="relative flex items-center gap-3 cursor-pointer select-none">
                <input type="checkbox" name="is_active" value="1" checked class="w-5 h-5 rounded-lg border-slate-300 text-blue-600 focus:ring-blue-600">
                <span class="text-sm font-bold text-slate-700">Aktifkan dan tampilkan di halaman utama situs</span>
            </label>
        </div>

        <div class="pt-6 border-t border-slate-100 flex flex-col sm:flex-row items-center justify-end gap-3">
            <a href="{{ route('admin.certificates.index') }}" class="w-full sm:w-auto px-6 py-4 bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold rounded-2xl text-sm transition text-center shadow-sm">
                Batalkan
            </a>
            <button type="submit" class="w-full sm:w-auto px-10 py-4 bg-blue-600 hover:bg-blue-700 text-white font-extrabold rounded-2xl text-sm shadow-xl shadow-blue-600/25 active:scale-[0.98] transition-all flex items-center justify-center gap-2">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                Simpan Sertifikat
            </button>
        </div>
    </form>
</div>
@endsection