@extends('admin.layouts.app')
@section('title', 'Edit Proyek')

@section('content')
<div class="max-w-4xl mx-auto space-y-8 pb-12">

    <!-- Header Banner Edit (Nuansa Emerald/Teal) -->
    <div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-emerald-950 via-teal-900 to-slate-900 text-white p-6 sm:p-8 shadow-2xl flex flex-col sm:flex-row items-center justify-between">
        <div class="absolute -right-10 -bottom-10 w-64 h-64 bg-emerald-500 rounded-full blur-3xl opacity-20 pointer-events-none"></div>
        <div class="absolute -left-10 -top-10 w-64 h-64 bg-teal-500 rounded-full blur-3xl opacity-20 pointer-events-none"></div>

        <div class="relative z-10 max-w-lg text-center sm:text-left mb-6 sm:mb-0">
            <a href="{{ route('admin.projects.index') }}" class="inline-flex items-center gap-1.5 text-xs font-semibold text-emerald-300 hover:text-white bg-emerald-500/20 px-3 py-1 rounded-full border border-emerald-400/30 transition mb-3 backdrop-blur-md">
                ← Kembali ke Daftar Proyek
            </a>
            <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight">Edit Proyek: {{ Str::limit($project->title, 20) }} ✍️</h1>
            <p class="mt-2 text-sm text-slate-300 leading-relaxed">
                Ubah informasi *Tech Stack*, *Soft Skills*, atau dokumentasi. Perubahan langsung disinkronkan secara <span class="text-emerald-400 font-semibold">realtime</span>.
            </p>
        </div>
        <div class="relative z-10 w-32 sm:w-40 flex-shrink-0">
            <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
            <lottie-player src="https://assets4.lottiefiles.com/packages/lf20_v1yqrgzy.json" background="transparent" speed="1" style="width: 100%; height: auto;" loop autoplay></lottie-player>
        </div>
    </div>

    <!-- Form Container Edit -->
    <form action="{{ route('admin.projects.update', $project->id) }}" method="POST" enctype="multipart/form-data" class="bg-white border border-slate-200/80 rounded-3xl shadow-sm p-6 sm:p-10 space-y-8">
        @csrf @method('PUT')
        
        <!-- BAGIAN 1: INFORMASI UTAMA -->
        <div class="space-y-4">
            <h3 class="text-base font-bold text-slate-900 border-b border-slate-100 pb-2 flex items-center gap-2">
                <span class="text-emerald-500">📌</span> 1. Informasi Utama Proyek
            </h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-bold text-slate-800 mb-2">Judul Proyek <span class="text-red-500">*</span></label>
                    <input type="text" name="title" value="{{ old('title', $project->title) }}" required class="w-full px-4 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-sm outline-none focus:bg-white focus:border-emerald-600 focus:ring-4 focus:ring-emerald-600/10 transition-all font-medium text-slate-800">
                </div>
                <div>
                    <label class="block text-sm font-bold text-slate-800 mb-2">Kategori Proyek</label>
                    <input type="text" name="category" value="{{ old('category', $project->category) }}" class="w-full px-4 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-sm outline-none focus:bg-white focus:border-emerald-600 focus:ring-4 focus:ring-emerald-600/10 transition-all font-medium text-slate-800">
                </div>
            </div>
        </div>

        <!-- BAGIAN 2: TOOLS & TEKNOLOGI (Menerima Data Lama) -->
        <div class="space-y-4" x-data="toolSearch({{ $project->technologies ?: '[]' }})">
            <h3 class="text-base font-bold text-slate-900 border-b border-slate-100 pb-2 flex items-center gap-2">
                <span class="text-emerald-500">🛠️</span> 2. Tools & Teknologi yang Digunakan
            </h3>
            
            <div class="relative">
                <span class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </span>
                <input type="text" x-model="searchQuery" @input="filterTools" placeholder="Cari tools..." class="w-full pl-11 pr-4 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-sm outline-none focus:bg-white focus:border-emerald-600 focus:ring-4 focus:ring-emerald-600/10 transition-all font-medium text-slate-800">
            </div>

            <!-- Dropdown Pencarian Tools -->
            <div x-show="searchQuery.length > 0 && filteredTools.length > 0" class="bg-white border border-slate-200 rounded-2xl shadow-lg p-2 max-h-56 overflow-y-auto space-y-1">
                <template x-for="tool in filteredTools" :key="tool.name">
                    <div @click="selectTool(tool)" class="flex items-center justify-between p-2.5 hover:bg-emerald-50 rounded-xl cursor-pointer transition">
                        <div class="flex items-center gap-3">
                            <img :src="tool.icon" class="w-6 h-6 object-contain" alt="">
                            <span class="text-xs font-bold text-slate-800" x-text="tool.name"></span>
                        </div>
                        <span class="text-[11px] font-bold text-emerald-600 bg-emerald-50 px-2.5 py-1 rounded-lg">+ Pilih</span>
                    </div>
                </template>
            </div>

            <!-- Tools Terpilih -->
            <div class="flex flex-wrap gap-2 min-h-[48px] p-3.5 bg-slate-50/80 border border-slate-200/80 rounded-2xl">
                <template x-for="(tool, index) in selectedTools" :key="tool.name">
                    <div class="inline-flex items-center gap-2 px-3.5 py-1.5 bg-white border border-slate-200 rounded-xl shadow-2xs text-xs font-bold text-slate-800">
                        <img :src="tool.icon" class="w-4 h-4 object-contain" alt="">
                        <span x-text="tool.name"></span>
                        <button type="button" @click="removeTool(index)" class="text-slate-400 hover:text-red-500 ml-1">×</button>
                        <input type="hidden" name="technologies[]" :value="tool.name">
                    </div>
                </template>
            </div>
        </div>

        <!-- BAGIAN 3: SOFT SKILLS (Menerima Data Lama) -->
        <div class="space-y-4" x-data="skillSearch({{ $project->soft_skills ?: '[]' }})">
            <h3 class="text-base font-bold text-slate-900 border-b border-slate-100 pb-2 flex items-center gap-2">
                <span class="text-emerald-500">💡</span> 3. Soft Skills & Metodologi
            </h3>
            
            <div class="relative">
                <span class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </span>
                <input type="text" x-model="searchSkillQuery" @input="filterSkills" placeholder="Cari soft skills..." class="w-full pl-11 pr-4 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-sm outline-none focus:bg-white focus:border-emerald-600 focus:ring-4 focus:ring-emerald-600/10 transition-all font-medium text-slate-800">
            </div>

            <!-- Dropdown Pencarian Skills -->
            <div x-show="searchSkillQuery.length > 0 && filteredSkills.length > 0" class="bg-white border border-slate-200 rounded-2xl shadow-lg p-2 max-h-56 overflow-y-auto space-y-1">
                <template x-for="skill in filteredSkills" :key="skill">
                    <div @click="selectSkill(skill)" class="flex items-center justify-between p-2.5 hover:bg-emerald-50 rounded-xl cursor-pointer transition">
                        <span class="text-xs font-bold text-slate-800" x-text="skill"></span>
                    </div>
                </template>
            </div>

            <!-- Skills Terpilih -->
            <div class="flex flex-wrap gap-2 min-h-[48px] p-3.5 bg-slate-50/80 border border-slate-200/80 rounded-2xl">
                <template x-for="(skill, index) in selectedSkills" :key="skill">
                    <div class="inline-flex items-center gap-2 px-3.5 py-1.5 bg-emerald-50 border border-emerald-200 rounded-xl text-xs font-bold text-emerald-800">
                        <span x-text="skill"></span>
                        <button type="button" @click="removeSkill(index)" class="text-emerald-400 hover:text-red-500 ml-1">×</button>
                        <input type="hidden" name="soft_skills[]" :value="skill">
                    </div>
                </template>
            </div>
        </div>

        <!-- BAGIAN 4: DESKRIPSI & DOKUMENTASI -->
        <div class="space-y-4">
            <h3 class="text-base font-bold text-slate-900 border-b border-slate-100 pb-2 flex items-center gap-2">
                <span class="text-emerald-500">📝</span> 4. Deskripsi & Dokumentasi
            </h3>
            <div>
                <label class="block text-sm font-bold text-slate-800 mb-2">Deskripsi Singkat</label>
                <textarea name="description" rows="3" class="w-full px-4 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-sm outline-none focus:bg-white focus:border-emerald-600 focus:ring-4 focus:ring-emerald-600/10">{{ old('description', $project->description) }}</textarea>
            </div>
            <div>
                <label class="block text-sm font-bold text-slate-800 mb-2">Dokumentasi / Arsitektur</label>
                <textarea name="documentation" rows="5" class="w-full px-4 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-sm outline-none focus:bg-white focus:border-emerald-600 focus:ring-4 focus:ring-emerald-600/10">{{ old('documentation', $project->documentation) }}</textarea>
            </div>
        </div>

        <!-- BAGIAN 5: TAUTAN & THUMBNAIL -->
        <div class="space-y-4">
            <h3 class="text-base font-bold text-slate-900 border-b border-slate-100 pb-2 flex items-center gap-2">
                <span class="text-emerald-500">🔗</span> 5. Tautan & Thumbnail
            </h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-bold text-slate-800 mb-2">Link Demo</label>
                    <input type="url" name="demo_url" value="{{ old('demo_url', $project->demo_url) }}" class="w-full px-4 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-sm outline-none focus:bg-white focus:border-emerald-600">
                </div>
                <div>
                    <label class="block text-sm font-bold text-slate-800 mb-2">Link GitHub</label>
                    <input type="url" name="github_url" value="{{ old('github_url', $project->github_url) }}" class="w-full px-4 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-sm outline-none focus:bg-white focus:border-emerald-600">
                </div>
            </div>

            <!-- Thumbnail Saat Ini -->
            @if($project->image)
                <div class="flex items-center gap-4 p-4 bg-slate-50 rounded-2xl border border-slate-200">
                    <img src="{{ asset('storage/' . $project->image) }}" alt="Current Image" class="w-16 h-16 rounded-xl object-cover border border-slate-300 shadow-sm">
                    <div>
                        <p class="text-xs font-bold text-slate-700">Gambar Saat Ini:</p>
                        <p class="text-xs text-slate-400">{{ basename($project->image) }}</p>
                    </div>
                </div>
            @endif

            <div>
                <label class="block text-sm font-bold text-slate-800 mb-2">Ganti Gambar (Opsional)</label>
                <input type="file" name="image" accept="image/*" class="w-full text-sm text-slate-500 file:mr-4 file:py-3 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100 transition cursor-pointer bg-slate-50 border border-slate-200 rounded-2xl">
            </div>
        </div>

        <!-- Status Aktif -->
        <div class="pt-2">
            <label class="relative flex items-center gap-3 cursor-pointer select-none">
                <input type="checkbox" name="is_active" value="1" {{ $project->is_active ? 'checked' : '' }} class="w-5 h-5 rounded-lg border-slate-300 text-emerald-600 focus:ring-emerald-500 cursor-pointer">
                <span class="text-sm font-bold text-slate-700">Aktifkan Proyek (Publikasikan Langsung)</span>
            </label>
        </div>

        <!-- Tombol Aksi -->
        <div class="pt-6 border-t border-slate-100 flex items-center justify-end gap-4">
            <a href="{{ route('admin.projects.index') }}" class="px-6 py-3.5 bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold rounded-2xl text-sm transition">Batal</a>
            <button type="submit" class="px-8 py-3.5 bg-emerald-600 hover:bg-emerald-700 active:scale-[0.98] text-white font-bold rounded-2xl text-sm shadow-xl shadow-emerald-600/25 transition-all">Perbarui Proyek</button>
        </div>
    </form>
</div>

<!-- Alpine.js -->
<script src="//unpkg.com/alpinejs" defer></script>
<script>
    function toolSearch(initialTools = []) {
        return {
            searchQuery: '',
            allTools: [
                { name: 'Laravel', icon: 'https://raw.githubusercontent.com/devicons/devicon/master/icons/laravel/laravel-original.svg' },
                { name: 'PHP', icon: 'https://raw.githubusercontent.com/devicons/devicon/master/icons/php/php-original.svg' },
                { name: 'C++', icon: 'https://raw.githubusercontent.com/devicons/devicon/master/icons/cplusplus/cplusplus-original.svg' },
                { name: 'C#', icon: 'https://raw.githubusercontent.com/devicons/devicon/master/icons/csharp/csharp-original.svg' },
                { name: 'Python', icon: 'https://raw.githubusercontent.com/devicons/devicon/master/icons/python/python-original.svg' },
                { name: 'MySQL', icon: 'https://raw.githubusercontent.com/devicons/devicon/master/icons/mysql/mysql-original.svg' },
                { name: 'PostgreSQL', icon: 'https://raw.githubusercontent.com/devicons/devicon/master/icons/postgresql/postgresql-original.svg' },
                { name: 'Tailwind CSS', icon: 'https://raw.githubusercontent.com/devicons/devicon/master/icons/tailwindcss/tailwindcss-original.svg' },
                { name: 'JavaScript', icon: 'https://raw.githubusercontent.com/devicons/devicon/master/icons/javascript/javascript-original.svg' },
                { name: 'Node.js', icon: 'https://raw.githubusercontent.com/devicons/devicon/master/icons/nodejs/nodejs-original.svg' },
                { name: 'Git', icon: 'https://raw.githubusercontent.com/devicons/devicon/master/icons/git/git-original.svg' },
                { name: 'Microsoft Word', icon: 'https://upload.wikimedia.org/wikipedia/commons/f/fd/Microsoft_Office_Word_%282019%E2%80%93present%29.svg' },
                { name: 'Microsoft Excel', icon: 'https://upload.wikimedia.org/wikipedia/commons/3/34/Microsoft_Office_Excel_%282019%E2%80%93present%29.svg' },
                { name: 'Figma', icon: 'https://raw.githubusercontent.com/devicons/devicon/master/icons/figma/figma-original.svg' },
                { name: 'React', icon: 'https://raw.githubusercontent.com/devicons/devicon/master/icons/react/react-original.svg' },
                { name: 'Docker', icon: 'https://raw.githubusercontent.com/devicons/devicon/master/icons/docker/docker-original.svg' }
            ],
            filteredTools: [],
            selectedTools: [],
            init() {
                // Load data yang sudah ada dari database
                if(initialTools && initialTools.length > 0) {
                    this.selectedTools = initialTools.map(toolName => {
                        let found = this.allTools.find(t => t.name === toolName);
                        return found ? found : { name: toolName, icon: 'https://cdn-icons-png.flaticon.com/512/888/888879.png' }; 
                    });
                }
            },
            filterTools() {
                if (this.searchQuery.trim() === '') {
                    this.filteredTools = [];
                    return;
                }
                const query = this.searchQuery.toLowerCase();
                this.filteredTools = this.allTools.filter(tool => 
                    tool.name.toLowerCase().includes(query) && 
                    !this.selectedTools.some(selected => selected.name === tool.name)
                );
            },
            selectTool(tool) {
                this.selectedTools.push(tool);
                this.searchQuery = '';
                this.filteredTools = [];
            },
            removeTool(index) {
                this.selectedTools.splice(index, 1);
            }
        }
    }

    function skillSearch(initialSkills = []) {
        return {
            searchSkillQuery: '',
            allSkills: [
                'Teamwork (Kerjasama Tim)',
                'Analytical Thinking (Berpikir Analitis)',
                'Problem Solving (Pemecahan Masalah)',
                'Time Management (Manajemen Waktu)',
                'Communication (Komunikasi Efektif)',
                'Leadership (Kepemimpinan)',
                'Adaptability (Adaptabilitas)',
                'Attention to Detail (Teliti & Detail)'
            ],
            filteredSkills: [],
            selectedSkills: initialSkills,
            filterSkills() {
                if (this.searchSkillQuery.trim() === '') {
                    this.filteredSkills = [];
                    return;
                }
                const query = this.searchSkillQuery.toLowerCase();
                this.filteredSkills = this.allSkills.filter(skill => 
                    skill.toLowerCase().includes(query) && 
                    !this.selectedSkills.includes(skill)
                );
            },
            selectSkill(skill) {
                this.selectedSkills.push(skill);
                this.searchSkillQuery = '';
                this.filteredSkills = [];
            },
            removeSkill(index) {
                this.selectedSkills.splice(index, 1);
            }
        }
    }
</script>
@endsection