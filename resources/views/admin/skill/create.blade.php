@extends('admin.layouts.app')
@section('title', 'Tambah Kapabilitas')

@section('content')
<style>[x-cloak]{display:none !important;}</style>

<div class="max-w-4xl mx-auto space-y-8 pb-12" x-data="smartLogoSearch()">

    <!-- HEADER BANNER -->
    <div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-slate-900 via-blue-950 to-indigo-950 text-white p-6 sm:p-10 shadow-xl flex flex-col sm:flex-row items-center justify-between">
        <div class="absolute -right-10 -bottom-10 w-64 h-64 bg-blue-600 rounded-full blur-3xl opacity-20 pointer-events-none"></div>
        <div class="absolute -left-10 -top-10 w-64 h-64 bg-indigo-500 rounded-full blur-3xl opacity-20 pointer-events-none"></div>

        <div class="relative z-10 max-w-lg text-center sm:text-left mb-6 sm:mb-0">
            <a href="{{ route('admin.skills.index') }}" class="inline-flex items-center gap-1.5 text-xs font-semibold text-blue-300 hover:text-white bg-blue-500/20 px-3 py-1 rounded-full border border-blue-400/30 transition mb-3 backdrop-blur-md">
                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                Kembali ke Daftar
            </a>
            <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight">Tambah Skill / Tool ✨</h1>
            <p class="mt-2 text-sm text-slate-300 leading-relaxed">
                Ketik nama tool atau aplikasi, lalu pilih <span class="text-blue-400 font-bold">logo aslinya</span> dari hasil pencarian.
            </p>
        </div>

        <div class="relative z-10 w-32 sm:w-40 flex-shrink-0">
            <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
            <lottie-player src="https://assets10.lottiefiles.com/packages/lf20_jcikwtux.json" background="transparent" speed="1" style="width: 100%; height: auto;" loop autoplay></lottie-player>
        </div>
    </div>

    <!-- FORM UTAMA -->
    <form action="{{ route('admin.skills.store') }}" method="POST" class="bg-white border border-slate-200/80 rounded-3xl shadow-sm p-6 sm:p-10 space-y-8">
        @csrf

        <!-- PENCARIAN LOGO -->
        <div class="space-y-3 relative">
            <label class="block text-sm font-bold text-slate-800">Nama Keahlian / Tool <span class="text-red-500">*</span></label>

            <div class="relative flex items-center">
                <span class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </span>

                <input type="text"
                       name="name"
                       x-model="searchQuery"
                       @input.debounce.400ms="fetchLogo"
                       @focus="results.length && (open = true)"
                       @keydown.enter.prevent=""
                       autocomplete="off"
                       required
                       placeholder="Misal: Word, Excel, VS Code, Gemini, ChatGPT, Canva..."
                       class="w-full pl-11 pr-16 py-4 bg-slate-50 border border-slate-200 rounded-2xl text-base outline-none focus:bg-white focus:border-blue-600 focus:ring-4 focus:ring-blue-600/10 transition-all font-bold text-slate-800 shadow-inner">

                <!-- Loading & Preview -->
                <div class="absolute inset-y-0 right-0 pr-4 flex items-center">
                    <svg x-show="isLoading" x-cloak class="animate-spin w-6 h-6 text-blue-600" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                    <img x-show="!isLoading && selectedIcon" x-cloak :src="selectedIcon" class="w-8 h-8 object-contain drop-shadow-md rounded-md bg-white p-0.5" alt="Preview Logo">
                </div>
            </div>

            <!-- URL logo untuk database -->
            <input type="hidden" name="icon_url" :value="selectedIcon">

            <!-- DROPDOWN HASIL -->
            <div x-show="open && results.length" x-cloak @click.outside="open=false"
                 class="absolute z-20 left-0 right-0 top-full mt-2 bg-white border border-slate-200 rounded-2xl shadow-xl max-h-72 overflow-y-auto p-2 grid grid-cols-2 sm:grid-cols-3 gap-2">
                <template x-for="i in results" :key="i.id">
                    <button type="button" @click="pick(i)" class="flex items-center gap-2 p-2 rounded-xl hover:bg-blue-50 text-left transition">
                        <img :src="i.url" class="w-7 h-7 object-contain" loading="lazy" alt="">
                        <span class="text-xs font-semibold truncate text-slate-700" x-text="i.label"></span>
                    </button>
                </template>
            </div>

            <p class="text-xs text-slate-500 font-medium" x-show="category !== 'Soft Skill'">
                Pilih logo dari daftar yang muncul. Jika kurang pas, coba nama lengkap / bahasa Inggris (misal "visual studio code", "openai").
            </p>
            <p class="text-xs text-slate-500 font-medium" x-show="category === 'Soft Skill'" x-cloak>
                Soft Skill tidak memerlukan logo.
            </p>
        </div>

        <!-- KATEGORI -->
        <div class="pt-4 border-t border-slate-100">
            <label class="block text-sm font-bold text-slate-800 mb-4">Kategori Kapabilitas</label>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <label class="relative flex items-center justify-center gap-3 p-5 border border-slate-200 rounded-2xl cursor-pointer hover:bg-slate-50 transition shadow-sm" :class="{'ring-2 ring-blue-600 border-blue-600 bg-blue-50': category === 'Hard Skill'}">
                    <input type="radio" name="category" value="Hard Skill" x-model="category" @change="fetchLogo" class="hidden">
                    <span class="text-xl">⚙️</span>
                    <span class="text-sm font-bold text-slate-800">Hard Skill</span>
                </label>
                <label class="relative flex items-center justify-center gap-3 p-5 border border-slate-200 rounded-2xl cursor-pointer hover:bg-slate-50 transition shadow-sm" :class="{'ring-2 ring-blue-600 border-blue-600 bg-blue-50': category === 'Soft Skill'}">
                    <input type="radio" name="category" value="Soft Skill" x-model="category" @change="fetchLogo" class="hidden">
                    <span class="text-xl">💡</span>
                    <span class="text-sm font-bold text-slate-800">Soft Skill</span>
                </label>
                <label class="relative flex items-center justify-center gap-3 p-5 border border-slate-200 rounded-2xl cursor-pointer hover:bg-slate-50 transition shadow-sm" :class="{'ring-2 ring-blue-600 border-blue-600 bg-blue-50': category === 'Tools'}">
                    <input type="radio" name="category" value="Tools" x-model="category" @change="fetchLogo" class="hidden">
                    <span class="text-xl">🛠️</span>
                    <span class="text-sm font-bold text-slate-800">Tools / App</span>
                </label>
            </div>
        </div>

        <!-- STATUS -->
        <div class="pt-6">
            <label class="relative flex items-center gap-3 cursor-pointer select-none">
                <input type="checkbox" name="is_active" value="1" checked class="w-5 h-5 rounded-lg border-slate-300 text-blue-600 focus:ring-blue-600 focus:ring-offset-0">
                <span class="text-sm font-bold text-slate-700">Aktifkan & Tampilkan di Halaman Utama</span>
            </label>
        </div>

        <!-- AKSI -->
        <div class="pt-8 border-t border-slate-100 flex flex-col sm:flex-row items-center justify-end gap-3">
            <a href="{{ route('admin.skills.index') }}" class="w-full sm:w-auto px-6 py-4 bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold rounded-2xl text-sm transition text-center shadow-sm">
                Batalkan
            </a>
            <button type="submit" class="w-full sm:w-auto px-10 py-4 bg-blue-600 hover:bg-blue-700 active:scale-[0.98] text-white font-extrabold rounded-2xl text-sm shadow-xl shadow-blue-600/25 transition-all flex items-center justify-center gap-2">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                Simpan Keahlian
            </button>
        </div>
    </form>
</div>

<script src="//unpkg.com/alpinejs" defer></script>
<script>
    function smartLogoSearch() {
        return {
            searchQuery: '',
            selectedIcon: '',
            category: 'Tools',
            isLoading: false,
            results: [],
            open: false,

            async fetchLogo() {
                const q = this.searchQuery.trim();

                if (this.category === 'Soft Skill') {
                    this.selectedIcon = '';
                    this.results = [];
                    this.open = false;
                    return;
                }
                if (q.length < 2) {
                    this.results = [];
                    this.open = false;
                    return;
                }

                this.isLoading = true;
                try {
                    const url = `https://api.iconify.design/search?query=${encodeURIComponent(q)}&prefixes=logos,devicon,simple-icons&limit=24`;
                    const res = await fetch(url);
                    const data = await res.json();

                    this.results = (data.icons || []).map(id => {
                        const [prefix, name] = id.split(':');
                        return {
                            id,
                            url: `https://api.iconify.design/${prefix}/${name}.svg`,
                            label: name.replace(/-/g, ' ').replace(/\b\w/g, c => c.toUpperCase())
                        };
                    });
                    this.open = this.results.length > 0;
                } catch (e) {
                    this.results = [];
                    this.open = false;
                }
                this.isLoading = false;
            },

            pick(item) {
                this.selectedIcon = item.url;
                this.searchQuery = item.label;
                this.open = false;
            }
        }
    }
</script>
@endsection