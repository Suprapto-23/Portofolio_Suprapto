<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard') - Admin Pra Tecnology</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50 text-slate-800 antialiased font-sans">

<!-- Overlay untuk Mobile -->
<div id="overlay" class="fixed inset-0 z-30 hidden bg-slate-900/40 backdrop-blur-sm lg:hidden transition-opacity" onclick="toggleSidebar()"></div>

<!-- Memanggil Komponen Sidebar -->
@include('admin.layouts.partials.sidebar')

<!-- Main Wrapper -->
<div id="main-wrapper" class="lg:pl-64 flex flex-col min-h-screen transition-all duration-300">
    
    <!-- Top Header -->
    <header class="sticky top-0 z-20 flex h-16 items-center justify-between border-b border-slate-200 bg-white/80 px-4 sm:px-8 backdrop-blur-md">
        
        <!-- Sisi Kiri Header -->
        <div class="flex items-center gap-3">
            <h1 class="text-lg font-bold tracking-tight text-slate-800">@yield('title', 'Dashboard')</h1>
        </div>

        <!-- Sisi Kanan Header (Profil & Tombol Logout) -->
        <div class="flex items-center gap-4">
            
            <div class="hidden sm:flex items-center gap-3 pr-4 border-r border-slate-200">
                <div class="flex flex-col items-end">
                    <span class="text-sm font-bold text-slate-800 leading-none">{{ auth()->user()->name ?? 'Administrator' }}</span>
                    <span class="text-xs font-medium text-slate-400 mt-1">Admin Panel</span>
                </div>
                <div class="flex h-9 w-9 items-center justify-center rounded-full bg-gradient-to-tr from-blue-600 to-blue-400 text-sm font-bold text-white shadow-sm shadow-blue-200">
                    {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
                </div>
            </div>

            <!-- Tombol Keluar memicu Modal Konfirmasi -->
            <button type="button" onclick="openLogoutModal()" class="flex items-center gap-2 rounded-xl bg-slate-50 px-3.5 py-2 text-sm font-semibold text-slate-600 border border-slate-200 transition-all hover:bg-red-50 hover:text-red-600 hover:border-red-100 shadow-sm">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                <span class="hidden sm:inline">Keluar</span>
            </button>

        </div>
    </header>

    <!-- Konten Halaman -->
    <main class="flex-1 p-4 sm:p-8">
        @yield('content')
    </main>

</div>

<!-- ========================================== -->
<!-- MODAL VALIDASI LOGOUT (YA / TIDAK) -->
<!-- ========================================== -->
<div id="logoutModal" class="fixed inset-0 z-50 flex items-center justify-center bg-slate-950/50 backdrop-blur-sm opacity-0 pointer-events-none transition-all duration-300">
    <div id="logoutModalBox" class="bg-white rounded-3xl shadow-2xl border border-slate-100 max-w-md w-full p-6 sm:p-8 transform scale-95 transition-all duration-300 text-center mx-4">
        
        <!-- Ikon Peringatan / Logout -->
        <div class="w-16 h-16 bg-red-50 text-red-500 rounded-2xl flex items-center justify-center mx-auto mb-5 shadow-inner">
            <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
            </svg>
        </div>

        <h3 class="text-xl font-bold text-slate-900 tracking-tight">Konfirmasi Keluar</h3>
        <p class="text-sm text-slate-500 mt-2 mb-6">Apakah Anda yakin ingin keluar dari sesi admin? Anda harus masuk kembali untuk mengakses panel.</p>

        <div class="flex items-center gap-3">
            <button type="button" onclick="closeLogoutModal()" class="flex-1 py-3 bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold rounded-xl text-sm transition">
                Tidak
            </button>
            <form id="logoutForm" method="POST" action="{{ route('logout') }}" class="flex-1">
                @csrf
                <button type="submit" class="w-full py-3 bg-red-600 hover:bg-red-700 text-white font-semibold rounded-xl text-sm shadow-lg shadow-red-600/20 transition">
                    Ya, Keluar
                </button>
            </form>
        </div>

    </div>
</div>

<!-- ========================================== -->
<!-- PREMIUM ANIMATED TOAST ALERT (LOGIN SUCCESS) -->
<!-- ========================================== -->
<div id="toast-container" class="fixed top-6 right-6 z-50 flex flex-col gap-3 pointer-events-none w-full max-w-sm px-4"></div>

<script>
    // Fungsi Modal Logout
    function openLogoutModal() {
        const modal = document.getElementById('logoutModal');
        const box = document.getElementById('logoutModalBox');
        modal.classList.remove('opacity-0', 'pointer-events-none');
        box.classList.remove('scale-95');
        box.classList.add('scale-100');
    }

    function closeLogoutModal() {
        const modal = document.getElementById('logoutModal');
        const box = document.getElementById('logoutModalBox');
        modal.classList.add('opacity-0', 'pointer-events-none');
        box.classList.remove('scale-100');
        box.classList.add('scale-95');
    }

    // Fungsi Toggle Sidebar Collapse
    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        const mainWrapper = document.getElementById('main-wrapper');
        const overlay = document.getElementById('overlay');
        const sidebarTexts = document.querySelectorAll('.sidebar-text');
        const categoryLabels = document.querySelectorAll('.category-label');
        const toggleIcon = document.getElementById('toggle-icon');
        const logoContainer = document.getElementById('sidebar-logo-container');
        
        if (window.innerWidth >= 1024) {
            const isCollapsed = sidebar.classList.toggle('w-20');
            sidebar.classList.toggle('w-64', !isCollapsed);

            mainWrapper.classList.toggle('lg:pl-64', !isCollapsed);
            mainWrapper.classList.toggle('lg:pl-20', isCollapsed);

            sidebarTexts.forEach(el => {
                el.classList.toggle('opacity-0', isCollapsed);
                el.classList.toggle('pointer-events-none', isCollapsed);
                el.classList.toggle('hidden', isCollapsed);
            });

            categoryLabels.forEach(el => {
                el.classList.toggle('hidden', isCollapsed);
            });

            if(toggleIcon) toggleIcon.classList.toggle('rotate-180', isCollapsed);

            const logoImg = logoContainer ? logoContainer.querySelector('img') : null;
            if (logoImg) {
                logoImg.style.transform = isCollapsed ? 'scale(0.8)' : 'scale(1)';
            }
        } else {
            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
        }
    }

    // Sistem Toast Animatif Modern & Premium
    window.toast = function (message, type = 'success') {
        const container = document.getElementById('toasts') || document.getElementById('toast-container');
        if(!container) return;

        const el = document.createElement('div');
        
        const isError = type === 'error';
        const borderColor = isError ? 'border-red-500/20' : 'border-emerald-500/20';
        const iconBg = isError ? 'bg-red-50 text-red-600' : 'bg-emerald-50 text-emerald-600';
        const icon = isError 
            ? `<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>`
            : `<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>`;

        el.className = `transform translate-y-[-20px] opacity-0 transition-all duration-500 ease-out pointer-events-auto flex items-center gap-4 bg-white/95 backdrop-blur-xl border ${borderColor} rounded-2xl p-4 shadow-2xl shadow-slate-500/10`;
        el.innerHTML = `
            <div class="flex-shrink-0 w-10 h-10 flex items-center justify-center rounded-xl ${iconBg} shadow-sm">
                ${icon}
            </div>
            <div class="flex-1 pr-2">
                <p class="text-xs font-bold uppercase tracking-wider text-slate-400">${isError ? 'Pemberitahuan' : 'Autentikasi Berhasil'}</p>
                <p class="text-sm font-semibold text-slate-800 mt-0.5">${message}</p>
            </div>
        `;
        
        container.appendChild(el);
        
        requestAnimationFrame(() => {
            el.classList.remove('translate-y-[-20px]', 'opacity-0');
        });

        setTimeout(() => {
            el.classList.add('translate-y-[-20px]', 'opacity-0');
            setTimeout(() => el.remove(), 400);
        }, 4500);
    };

    @if (session('toast.message'))
        window.toast(@json(session('toast.message')), @json(session('toast.type', 'success')));
    @endif
</script>

@stack('scripts')
</body>
</html>