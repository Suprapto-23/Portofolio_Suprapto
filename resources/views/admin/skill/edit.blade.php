@extends('admin.layouts.app')
@section('title', 'Edit Kapabilitas')

@section('content')
<div class="max-w-3xl mx-auto space-y-8 pb-12" x-data="smartSkillSearch('{{ $skill->icon_url }}', '{{ $skill->category }}')">

    <div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-pink-900 via-rose-900 to-slate-900 text-white p-6 sm:p-8 shadow-2xl flex items-center justify-between">
        <div class="absolute -right-10 -bottom-10 w-64 h-64 bg-pink-500 rounded-full blur-3xl opacity-20 pointer-events-none"></div>
        <div class="relative z-10 max-w-lg">
            <a href="{{ route('admin.skills.index') }}" class="inline-flex items-center gap-1.5 text-xs font-semibold text-pink-300 hover:text-white bg-pink-500/20 px-3 py-1 rounded-full border border-pink-400/30 transition mb-3">
                ← Kembali
            </a>
            <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight">Edit Kapabilitas ✍️</h1>
        </div>
    </div>

    <form action="{{ route('admin.skills.update', $skill->id) }}" method="POST" class="bg-white border border-slate-200/80 rounded-3xl shadow-sm p-6 sm:p-10 space-y-6">
        @csrf @method('PUT')
        
        <!-- Field Pencarian Nama & Ikon -->
        <div class="space-y-2 relative">
            <label class="block text-sm font-bold text-slate-800">Nama Skill / Tool <span class="text-red-500">*</span></label>
            <div class="relative">
                <input type="text" name="name" x-model="searchQuery" @input="filterSuggestions" autocomplete="off" required class="w-full pl-4 pr-12 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-sm font-bold text-slate-800">
                <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                    <img :src="selectedIcon || 'https://cdn-icons-png.flaticon.com/512/888/888879.png'" class="w-6 h-6 object-contain">
                </div>
            </div>
            <input type="hidden" name="icon_url" :value="selectedIcon">

            <!-- Dropdown Auto-Complete -->
            <div x-show="searchQuery.length > 0 && showSuggestions" @click.away="showSuggestions = false" class="absolute z-50 w-full mt-1 bg-white border border-slate-200 rounded-2xl shadow-xl max-h-60 overflow-y-auto p-2">
                <template x-for="item in filteredList" :key="item.name">
                    <div @click="selectItem(item)" class="flex items-center gap-3 p-3 hover:bg-pink-50 rounded-xl cursor-pointer">
                        <img :src="item.icon" class="w-6 h-6 object-contain">
                        <span class="text-sm font-bold text-slate-800" x-text="item.name"></span>
                    </div>
                </template>
                <div @click="selectCustom()" class="p-3 hover:bg-slate-50 rounded-xl cursor-pointer border-t border-slate-100 mt-1">
                    <p class="text-sm font-bold text-slate-800">Gunakan "<span x-text="searchQuery" class="text-pink-600"></span>"</p>
                </div>
            </div>
        </div>

        <!-- Kategori -->
        <div>
            <label class="block text-sm font-bold text-slate-800 mb-3">Kategori</label>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <label class="relative flex items-center justify-center gap-2 p-4 border border-slate-200 rounded-2xl cursor-pointer transition" :class="{'ring-2 ring-pink-500 bg-pink-50': category === 'Hard Skill'}">
                    <input type="radio" name="category" value="Hard Skill" x-model="category" class="hidden">
                    <span class="text-sm font-bold text-slate-700">⚙️ Hard Skill</span>
                </label>
                <label class="relative flex items-center justify-center gap-2 p-4 border border-slate-200 rounded-2xl cursor-pointer transition" :class="{'ring-2 ring-pink-500 bg-pink-50': category === 'Soft Skill'}">
                    <input type="radio" name="category" value="Soft Skill" x-model="category" class="hidden">
                    <span class="text-sm font-bold text-slate-700">💡 Soft Skill</span>
                </label>
                <label class="relative flex items-center justify-center gap-2 p-4 border border-slate-200 rounded-2xl cursor-pointer transition" :class="{'ring-2 ring-pink-500 bg-pink-50': category === 'Tools'}">
                    <input type="radio" name="category" value="Tools" x-model="category" class="hidden">
                    <span class="text-sm font-bold text-slate-700">🛠️ Tools</span>
                </label>
            </div>
        </div>

        <div class="pt-4">
            <label class="relative flex items-center gap-3 cursor-pointer select-none">
                <input type="checkbox" name="is_active" value="1" {{ $skill->is_active ? 'checked' : '' }} class="w-5 h-5 rounded-lg border-slate-300 text-pink-600">
                <span class="text-sm font-bold text-slate-700">Aktifkan</span>
            </label>
        </div>

        <div class="pt-6 border-t border-slate-100 flex items-center justify-end gap-4">
            <a href="{{ route('admin.skills.index') }}" class="px-6 py-3.5 bg-slate-100 text-slate-700 font-semibold rounded-2xl text-sm">Batal</a>
            <button type="submit" class="px-8 py-3.5 bg-pink-600 hover:bg-pink-700 text-white font-bold rounded-2xl text-sm shadow-xl">Perbarui Kapabilitas</button>
        </div>
    </form>
</div>

<script src="//unpkg.com/alpinejs" defer></script>
<script>
    function smartSkillSearch(initialIcon, initialCategory) {
        return {
            searchQuery: '{{ addslashes($skill->name) }}',
            selectedIcon: initialIcon,
            category: initialCategory,
            showSuggestions: false,
            database: [
                { name: 'Laravel', category: 'Hard Skill', icon: 'https://raw.githubusercontent.com/devicons/devicon/master/icons/laravel/laravel-original.svg' },
                { name: 'PHP', category: 'Hard Skill', icon: 'https://raw.githubusercontent.com/devicons/devicon/master/icons/php/php-original.svg' },
                { name: 'Python', category: 'Hard Skill', icon: 'https://raw.githubusercontent.com/devicons/devicon/master/icons/python/python-original.svg' },
                { name: 'JavaScript', category: 'Hard Skill', icon: 'https://raw.githubusercontent.com/devicons/devicon/master/icons/javascript/javascript-original.svg' },
                { name: 'MySQL', category: 'Tools', icon: 'https://raw.githubusercontent.com/devicons/devicon/master/icons/mysql/mysql-original.svg' },
                { name: 'Git', category: 'Tools', icon: 'https://raw.githubusercontent.com/devicons/devicon/master/icons/git/git-original.svg' },
                { name: 'Microsoft Excel', category: 'Tools', icon: 'https://upload.wikimedia.org/wikipedia/commons/3/34/Microsoft_Office_Excel_%282019%E2%80%93present%29.svg' },
            ],
            filteredList: [],
            filterSuggestions() {
                this.showSuggestions = true;
                const query = this.searchQuery.toLowerCase();
                this.filteredList = this.database.filter(item => item.name.toLowerCase().includes(query));
                if(query === '') this.selectedIcon = '';
            },
            selectItem(item) {
                this.searchQuery = item.name;
                this.selectedIcon = item.icon;
                this.category = item.category;
                this.showSuggestions = false;
            },
            selectCustom() {
                this.selectedIcon = 'https://cdn-icons-png.flaticon.com/512/888/888879.png';
                this.showSuggestions = false;
            }
        }
    }
</script>
@endsection