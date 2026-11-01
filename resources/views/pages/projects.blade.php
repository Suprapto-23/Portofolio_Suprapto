@extends('layouts.app')

@section('content')
<!-- PROJECTS HERO -->
<section class="bg-[#0B1B3A] pt-24 pb-20 lg:pt-32 lg:pb-28 relative overflow-hidden">
    <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjAiIGhlaWdodD0iMjAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGNpcmNsZSBjeD0iMSIgY3k9IjEiIHI9IjEiIGZpbGw9InJnYmEoMjU1LDI1NSwyNTUsMC4wNSkiLz48L3N2Zz4=')] opacity-30"></div>
    <div class="max-w-[1180px] mx-auto px-6 text-center relative z-10">
        <h1 class="text-[36px] md:text-[48px] font-extrabold text-white leading-tight mb-4">
            Featured Projects
        </h1>
        <p class="text-[16px] text-gray-300 max-w-[600px] mx-auto">
            A deep dive into some of the comprehensive web applications and systems I have architected and developed.
        </p>
    </div>
</section>

<!-- PROJECTS LIST (DINAMIS DARI DATABASE ADMIN) -->
<section class="py-24 bg-[#FAFCFF]">
    <div class="max-w-[1180px] mx-auto px-6 flex flex-col gap-24">
        
        @forelse($projects as $index => $project)
            @php
                $isEven = $index % 2 !== 0;

                // Peta logo resmi untuk setiap tools
                $logoMap = [
                    'Laravel' => 'https://raw.githubusercontent.com/devicons/devicon/master/icons/laravel/laravel-original.svg',
                    'PHP' => 'https://raw.githubusercontent.com/devicons/devicon/master/icons/php/php-original.svg',
                    'Python' => 'https://raw.githubusercontent.com/devicons/devicon/master/icons/python/python-original.svg',
                    'MySQL' => 'https://raw.githubusercontent.com/devicons/devicon/master/icons/mysql/mysql-original.svg',
                    'Tailwind CSS' => 'https://raw.githubusercontent.com/devicons/devicon/master/icons/tailwindcss/tailwindcss-original.svg',
                    'JavaScript' => 'https://raw.githubusercontent.com/devicons/devicon/master/icons/javascript/javascript-original.svg',
                    'Node.js' => 'https://raw.githubusercontent.com/devicons/devicon/master/icons/nodejs/nodejs-original.svg',
                    'Git' => 'https://raw.githubusercontent.com/devicons/devicon/master/icons/git/git-original.svg',
                ];

                $projectTools = $project->technologies ? json_decode($project->technologies, true) : [];
            @endphp

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center" data-aos="fade-up">
                
                <!-- Kolom Teks -->
                <div class="{{ $isEven ? 'order-2 lg:order-2' : 'order-2 lg:order-1' }}">
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-[#EAF6FF] text-[#1677FF] text-[12px] font-bold mb-4">
                        <span class="w-2 h-2 rounded-full bg-[#1677FF]"></span> {{ $project->category ?? 'Web Application' }}
                    </div>
                    
                    <h2 class="text-[28px] md:text-[32px] font-bold text-[#0B1B3A] mb-4">
                        {{ $project->title }}
                    </h2>
                    
                    <p class="text-[15px] text-[#64748B] leading-[1.8] mb-6">
                        {{ $project->description }}
                    </p>

                    <!-- Tombol Tautan Live Demo / GitHub -->
                    <div class="flex flex-wrap gap-3 mb-8">
                        @if($project->demo_url)
                            <a href="{{ $project->demo_url }}" target="_blank" class="inline-flex items-center gap-2 px-4 py-2 bg-[#1677FF] text-white rounded-xl text-[13px] font-semibold hover:bg-blue-600 transition shadow-sm">
                                Live Demo →
                            </a>
                        @endif
                        @if($project->github_url)
                            <a href="{{ $project->github_url }}" target="_blank" class="inline-flex items-center gap-2 px-4 py-2 border border-[#DCE7F5] bg-white text-[#0B1B3A] rounded-xl text-[13px] font-semibold hover:bg-slate-50 transition shadow-sm">
                                GitHub Repository
                            </a>
                        @endif
                    </div>

                    <!-- Tech Stack / Tools dengan Logo -->
                    <div class="flex flex-wrap gap-2">
                        @forelse($projectTools as $tool)
                            <span class="inline-flex items-center gap-2 px-3.5 py-1.5 border border-[#DCE7F5] bg-white rounded-xl text-[13px] font-bold text-[#0B1B3A] shadow-2xs">
                                @if(isset($logoMap[$tool]))
                                    <img src="{{ $logoMap[$tool] }}" alt="{{ $tool }}" class="w-4 h-4 object-contain">
                                @endif
                                {{ $tool }}
                            </span>
                        @empty
                            <span class="text-xs text-slate-400">Tidak ada tech stack yang dipilih.</span>
                        @endforelse
                    </div>
                </div>

                <!-- Kolom Gambar Proyek -->
                <div class="{{ $isEven ? 'order-1 lg:order-1' : 'order-1 lg:order-2' }} bg-white p-6 rounded-[24px] border border-[#DCE7F5] shadow-lg shadow-[#1677FF]/5">
                    <div class="bg-[#F4F9FF] rounded-xl overflow-hidden aspect-video flex items-center justify-center">
                        @if($project->image)
                            <img src="{{ asset('storage/' . $project->image) }}" alt="{{ $project->title }}" class="w-full h-full object-cover" onerror="this.style.display='none'">
                        @else
                            <div class="text-slate-400 font-bold text-sm">No Image Available</div>
                        @endif
                    </div>
                </div>

            </div>
        @empty
            <div class="text-center py-16">
                <p class="text-slate-500 text-lg">Belum ada proyek yang ditampilkan.</p>
            </div>
        @endforelse

    </div>
</section>
@endsection