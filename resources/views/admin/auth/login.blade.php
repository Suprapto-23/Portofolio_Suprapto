<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Admin - Pra Tecnology</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Player Khusus untuk format file .lottie -->
    <script src="https://unpkg.com/@dotlottie/player-component@latest/dist/dotlottie-player.mjs" type="module"></script>

    <style>
        /* Animasi aman (Fail-safe) */
        .fade-in-up {
            animation: fadeInUp 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }
        .delay-100 { animation-delay: 50ms; }
        .delay-200 { animation-delay: 100ms; }
        .delay-300 { animation-delay: 150ms; }

        @keyframes fadeInUp {
            0% { opacity: 0; transform: translateY(15px); }
            100% { opacity: 1; transform: translateY(0); }
        }

        /* Animasi Toast Alert */
        .toast-enter { animation: toastEnter 0.4s cubic-bezier(0.2, 1.2, 0.3, 1) forwards; }
        .toast-leave { animation: toastLeave 0.3s ease-in forwards; }
        @keyframes toastEnter {
            0% { opacity: 0; transform: translateY(-100%) scale(0.95); }
            100% { opacity: 1; transform: translateY(0) scale(1); }
        }
        @keyframes toastLeave {
            0% { opacity: 1; transform: translateY(0) scale(1); }
            100% { opacity: 0; transform: translateY(-100%) scale(0.95); }
        }
    </style>
</head>
<body class="min-h-screen bg-slate-50 flex items-center justify-center font-sans antialiased px-4 sm:px-6 relative overflow-hidden">

    <!-- Container Notifikasi Toast -->
    <div id="toast-container" class="fixed top-6 left-1/2 -translate-x-1/2 z-50 flex flex-col gap-3 pointer-events-none w-full max-w-sm px-4">
        @if (session('toast.message'))
            <div class="toast-notification pointer-events-auto flex items-start gap-3 bg-white border border-slate-100 shadow-xl rounded-2xl p-4">
                <div class="flex-shrink-0 w-8 h-8 flex items-center justify-center rounded-full bg-green-50 text-green-600 mt-0.5">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                </div>
                <div class="flex-1">
                    <p class="text-sm font-bold text-slate-800">Berhasil</p>
                    <p class="text-sm text-slate-500 mt-0.5">{{ session('toast.message') }}</p>
                </div>
            </div>
        @endif

        @if ($errors->any())
            <div class="toast-notification pointer-events-auto flex items-start gap-3 bg-white border border-slate-100 shadow-xl rounded-2xl p-4">
                <div class="flex-shrink-0 w-8 h-8 flex items-center justify-center rounded-full bg-red-50 text-red-500 mt-0.5">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <div class="flex-1">
                    <p class="text-sm font-bold text-slate-800">Autentikasi Gagal</p>
                    <p class="text-sm text-slate-500 mt-0.5">{{ $errors->first() }}</p>
                </div>
            </div>
        @endif
    </div>

    <!-- Login Container -->
    <div class="w-full max-w-[900px] h-auto min-h-[500px] bg-white rounded-[2rem] shadow-2xl overflow-hidden flex flex-col md:flex-row border border-slate-100/50">
        
        <!-- Sisi Kiri (Animasi Lottie) -->
        <div class="hidden md:flex md:w-[45%] bg-blue-50/40 flex-col items-center justify-center p-8 relative overflow-hidden">
            <div class="absolute top-0 right-0 -mt-16 -mr-16 w-48 h-48 bg-blue-100 rounded-full blur-3xl opacity-50"></div>
            <div class="absolute bottom-0 left-0 -mb-16 -ml-16 w-48 h-48 bg-blue-200 rounded-full blur-3xl opacity-50"></div>
            
            <div class="relative z-10 w-full max-w-[280px]">
                <!-- Animasi dengan Tautan Baru Anda -->
                <dotlottie-player 
                    src="https://lottie.host/6652c3c9-6c18-4f1d-b249-aeac40d96827/xSiq8AVKBT.lottie" 
                    background="transparent" 
                    speed="1" 
                    style="width: 100%; height: auto;" 
                    loop 
                    autoplay>
                </dotlottie-player>
            </div>
            
            <div class="relative z-10 mt-6 text-center">
                <h3 class="text-lg font-bold text-slate-800">Sistem Manajemen</h3>
                <p class="text-sm text-slate-500 mt-1">Kelola proyek dan portofolio Anda dengan mudah dan efisien.</p>
            </div>
        </div>

        <!-- Sisi Kanan (Form Login) -->
        <div class="w-full md:w-[55%] p-8 sm:p-12 flex flex-col justify-center relative">
            
            <!-- Logo Pra Tecnology -->
            <div class="flex justify-center mb-6 fade-in-up delay-100">
                <img src="{{ asset('images/logo.png') }}" alt="Logo Pra Tecnology" class="h-10 sm:h-12 w-auto object-contain">
            </div>

            <!-- Teks Sapaan -->
            <div class="mb-8 text-center fade-in-up delay-200">
                <h1 class="text-3xl font-bold tracking-tight text-slate-900">Selamat Datang</h1>
                <p class="text-sm text-slate-500 mt-2">Silakan masukkan kredensial Anda untuk masuk ke dasbor.</p>
            </div>

            <form method="POST" action="{{ route('login.attempt') }}" class="space-y-5 fade-in-up delay-300"
                  onsubmit="const btn=this.querySelector('button'); btn.disabled=true; btn.classList.add('opacity-80', 'cursor-wait'); btn.innerHTML='<svg class=\'animate-spin -ml-1 mr-2 h-5 w-5 text-white inline\' xmlns=\'http://www.w3.org/2000/svg\' fill=\'none\' viewBox=\'0 0 24 24\'><circle class=\'opacity-25\' cx=\'12\' cy=\'12\' r=\'10\' stroke=\'currentColor\' stroke-width=\'4\'></circle><path class=\'opacity-75\' fill=\'currentColor\' d=\'M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z\'></path></svg> Memproses...';">
                @csrf
                
                <div>
                    <label for="email" class="block text-sm font-semibold text-slate-700 mb-1.5">Email</label>
                    <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus
                        class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl outline-none focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all duration-300 text-slate-900 placeholder-slate-400 font-medium"
                        placeholder="admin@pratecnology.com">
                </div>

                <div>
                    <label for="password" class="block text-sm font-semibold text-slate-700 mb-1.5">Kata Sandi</label>
                    <input id="password" name="password" type="password" required
                        class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl outline-none focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all duration-300 text-slate-900 placeholder-slate-400 font-medium"
                        placeholder="••••••••">
                </div>

                <div class="flex items-center justify-between text-sm mt-2">
                    <label class="flex items-center gap-2 cursor-pointer group">
                        <input type="checkbox" name="remember" class="w-4 h-4 rounded border-slate-300 text-blue-600 focus:ring-blue-500 transition-colors">
                        <span class="text-slate-600 font-medium group-hover:text-slate-900 transition-colors">Ingat saya</span>
                    </label>
                </div>

                <button type="submit" class="w-full mt-4 py-3.5 bg-blue-600 hover:bg-blue-700 active:scale-[0.98] text-white font-semibold rounded-xl shadow-lg shadow-blue-600/20 transition-all duration-200 flex justify-center items-center">
                    Masuk ke Dasbor
                </button>
            </form>
            
        </div>
    </div>

    <!-- Script Pengendali Toast Alert -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const toasts = document.querySelectorAll('.toast-notification');
            
            toasts.forEach(toast => {
                toast.classList.add('toast-enter');
                setTimeout(() => {
                    toast.classList.remove('toast-enter');
                    toast.classList.add('toast-leave');
                    setTimeout(() => { toast.remove(); }, 300);
                }, 4000);
            });
        });
    </script>
</body>
</html>