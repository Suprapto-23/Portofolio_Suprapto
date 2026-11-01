<aside id="sidebar" class="fixed inset-y-0 left-0 z-40 flex flex-col border-r border-slate-200 bg-white transition-all duration-300 w-64">
    
    <!-- Sidebar Header / Logo Custom (Posisi Center) -->
    <div class="flex h-20 items-center justify-center px-6 border-b border-slate-100">
        <a href="{{ route('admin.dashboard') }}" class="flex flex-col items-center justify-center text-center group">
            <div class="flex items-center justify-center mb-1">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-10 w-auto object-contain transition-transform duration-200 group-hover:scale-105">
            </div>
            <div class="sidebar-text">
                <span class="block text-[11px] font-semibold text-slate-400 tracking-wide">Portfolio Management</span>
            </div>
        </a>
    </div>

    <!-- Sidebar Navigation Menu (Menu lainnya tetap seperti semula) -->
    <div class="flex-1 overflow-y-auto px-4 py-6 space-y-6">
        
        <!-- Dashboard Menu -->
        <div>
            <p class="sidebar-text px-3 text-[11px] font-bold uppercase tracking-wider text-slate-400 mb-2">Utama</p>
            <nav class="space-y-1">
                <a href="{{ route('admin.dashboard') }}" title="Dashboard"
                   class="flex items-center gap-3 rounded-xl px-3.5 py-3 transition-all group {{ request()->routeIs('admin.dashboard') ? 'bg-blue-600 text-white shadow-lg shadow-blue-600/25 font-bold' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900 font-semibold' }}">
                    <svg class="h-5 w-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
                    </svg>
                    <span class="sidebar-text whitespace-nowrap text-sm">Dashboard Utama</span>
                </a>
            </nav>
        </div>

        <!-- Manajemen Portofolio -->
        <div>
            <p class="sidebar-text px-3 text-[11px] font-bold uppercase tracking-wider text-slate-400 mb-2">Manajemen Portofolio</p>
            <nav class="space-y-1.5">
                
                <!-- Proyek -->
                <a href="{{ route('admin.projects.index') }}" title="Proyek"
                   class="flex items-center gap-3 rounded-xl px-3.5 py-3 transition-all group {{ request()->routeIs('admin.projects.*') ? 'bg-blue-50 text-blue-700 shadow-sm font-bold border border-blue-100' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900 font-semibold' }}">
                    <svg class="h-5 w-5 flex-shrink-0 {{ request()->routeIs('admin.projects.*') ? 'text-blue-600' : 'text-slate-400 group-hover:text-slate-600' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                    </svg>
                    <span class="sidebar-text whitespace-nowrap text-sm">Proyek</span>
                </a>

                <!-- Keahlian / Skills -->
                <a href="{{ route('admin.skills.index') }}" title="Keahlian & Tools"
                   class="flex items-center gap-3 rounded-xl px-3.5 py-3 transition-all group {{ request()->routeIs('admin.skills.*') ? 'bg-blue-50 text-blue-700 shadow-sm font-bold border border-blue-100' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900 font-semibold' }}">
                    <svg class="h-5 w-5 flex-shrink-0 {{ request()->routeIs('admin.skills.*') ? 'text-blue-600' : 'text-slate-400 group-hover:text-slate-600' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                    <span class="sidebar-text whitespace-nowrap text-sm">Keahlian (Skills)</span>
                </a>

                <!-- Sertifikat -->
                <a href="{{ route('admin.certificates.index') }}" title="Sertifikat"
                   class="flex items-center gap-3 rounded-xl px-3.5 py-3 transition-all group {{ request()->routeIs('admin.certificates.*') ? 'bg-blue-50 text-blue-700 shadow-sm font-bold border border-blue-100' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900 font-semibold' }}">
                    <svg class="h-5 w-5 flex-shrink-0 {{ request()->routeIs('admin.certificates.*') ? 'text-blue-600' : 'text-slate-400 group-hover:text-slate-600' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                    </svg>
                    <span class="sidebar-text whitespace-nowrap text-sm">Sertifikat</span>
                </a>

                <!-- Pengalaman -->
                <a href="{{ route('admin.experiences.index') }}" title="Pengalaman"
                   class="flex items-center gap-3 rounded-xl px-3.5 py-3 transition-all group {{ request()->routeIs('admin.experiences.*') ? 'bg-blue-50 text-blue-700 shadow-sm font-bold border border-blue-100' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900 font-semibold' }}">
                    <svg class="h-5 w-5 flex-shrink-0 {{ request()->routeIs('admin.experiences.*') ? 'text-blue-600' : 'text-slate-400 group-hover:text-slate-600' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                    <span class="sidebar-text whitespace-nowrap text-sm">Pengalaman</span>
                </a>

                <!-- Pendidikan -->
                <a href="{{ route('admin.educations.index') }}" title="Pendidikan"
                   class="flex items-center gap-3 rounded-xl px-3.5 py-3 transition-all group {{ request()->routeIs('admin.educations.*') ? 'bg-blue-50 text-blue-700 shadow-sm font-bold border border-blue-100' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900 font-semibold' }}">
                    <svg class="h-5 w-5 flex-shrink-0 {{ request()->routeIs('admin.educations.*') ? 'text-blue-600' : 'text-slate-400 group-hover:text-slate-600' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 14l9-5-9-5-9 5 9 5z"/><path stroke-linecap="round" stroke-linejoin="round" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/>
                    </svg>
                    <span class="sidebar-text whitespace-nowrap text-sm">Pendidikan</span>
                </a>

                <!-- Training -->
                <a href="{{ route('admin.trainings.index') }}" title="Training"
                   class="flex items-center gap-3 rounded-xl px-3.5 py-3 transition-all group {{ request()->routeIs('admin.trainings.*') ? 'bg-blue-50 text-blue-700 shadow-sm font-bold border border-blue-100' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900 font-semibold' }}">
                    <svg class="h-5 w-5 flex-shrink-0 {{ request()->routeIs('admin.trainings.*') ? 'text-blue-600' : 'text-slate-400 group-hover:text-slate-600' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                    </svg>
                    <span class="sidebar-text whitespace-nowrap text-sm">Training</span>
                </a>

                <!-- Dokumentasi -->
                <a href="{{ route('admin.documentations.index') }}" title="Dokumentasi"
                   class="flex items-center gap-3 rounded-xl px-3.5 py-3 transition-all group {{ request()->routeIs('admin.documentations.*') ? 'bg-blue-50 text-blue-700 shadow-sm font-bold border border-blue-100' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900 font-semibold' }}">
                    <svg class="h-5 w-5 flex-shrink-0 {{ request()->routeIs('admin.documentations.*') ? 'text-blue-600' : 'text-slate-400 group-hover:text-slate-600' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 19a2 2 0 01-2-2V7a2 2 0 012-2h4l2 2h4a2 2 0 012 2v1M5 19h14a2 2 0 002-2v-5a2 2 0 00-2-2H9a2 2 0 00-2 2v5a2 2 0 01-2 2z"/>
                    </svg>
                    <span class="sidebar-text whitespace-nowrap text-sm">Dokumentasi</span>
                </a>
            </nav>
        </div>

        <!-- Sistem -->
        <div>
            <p class="sidebar-text px-3 text-[11px] font-bold uppercase tracking-wider text-slate-400 mb-2">Sistem</p>
            <nav class="space-y-1.5">
                <a href="{{ route('admin.messages.index') }}" title="Pesan Masuk"
                   class="flex items-center gap-3 rounded-xl px-3.5 py-3 transition-all group {{ request()->routeIs('admin.messages.*') ? 'bg-blue-50 text-blue-700 shadow-sm font-bold border border-blue-100' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900 font-semibold' }}">
                    <svg class="h-5 w-5 flex-shrink-0 {{ request()->routeIs('admin.messages.*') ? 'text-blue-600' : 'text-slate-400 group-hover:text-slate-600' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a20 20 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                    <span class="sidebar-text whitespace-nowrap text-sm">Pesan Masuk</span>
                </a>
            </nav>
        </div>

    </div>

    <!-- Sidebar Footer / Tombol Logout -->
    <div class="p-4 border-t border-slate-100">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="w-full flex items-center gap-3 rounded-xl px-3.5 py-3 text-red-600 hover:bg-red-50 transition font-semibold text-sm">
                <svg class="h-5 w-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                </svg>
                <span class="sidebar-text whitespace-nowrap">Keluar (Logout)</span>
            </button>
        </form>
    </div>
</aside>