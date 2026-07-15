<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk — Footsal Arena</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
</head>
<body class="bg-slate-50 font-['Inter'] text-slate-800 antialiased h-screen overflow-hidden">

<div class="flex h-full">

    {{-- Left Side: Visual / Branding Panel (Hidden on Mobile) --}}
    <div class="hidden lg:flex lg:w-1/2 relative bg-[#0b0f19] items-center justify-center p-12 overflow-hidden border-r border-slate-900">
        
        <!-- Animated Background Blur & Grid -->
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_right,rgba(99,102,241,0.15),transparent_50%)]"></div>
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_bottom_left,rgba(16,185,129,0.12),transparent_40%)]"></div>
        
        <!-- Abstract Soccer Pitch Grid SVG Overlay -->
        <svg class="absolute inset-0 w-full h-full text-slate-900/40" xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" fill="none">
            <defs>
                <pattern id="grid" width="40" height="40" patternUnits="userSpaceOnUse">
                    <path d="M 40 0 L 0 0 0 40" fill="none" stroke="currentColor" stroke-width="1"/>
                </pattern>
            </defs>
            <rect width="100%" height="100%" fill="url(#grid)" />
            
            <!-- Pitch lines -->
            <circle cx="50%" cy="50%" r="150" stroke="currentColor" stroke-width="1.5" stroke-dasharray="8 8" class="opacity-30" />
            <rect x="10%" y="10%" width="80%" height="80%" rx="20" stroke="currentColor" stroke-width="1.5" stroke-dasharray="10 10" class="opacity-20" />
        </svg>

        <!-- Brand Presentation Content -->
        <div class="relative z-10 max-w-lg text-center lg:text-left space-y-8">
            <div class="flex items-center gap-3">
                <div class="w-12 h-12 rounded-2xl bg-gradient-to-tr from-emerald-500 to-teal-500 flex items-center justify-center shadow-lg shadow-emerald-500/20">
                    <!-- Ball Icon -->
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM18 18.75V16.5A2.25 2.25 0 0015.75 14.25h-7.5A2.25 2.25 0 006 16.5v2.25m12 0H6"/>
                    </svg>
                </div>
                <span class="font-extrabold text-2xl text-white tracking-tight">Footsal Arena</span>
            </div>

            <div class="space-y-4">
                <h1 class="text-4xl lg:text-5xl font-black text-white leading-tight tracking-tight">
                    Pesan Lapangan Futsal <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-400 to-emerald-400">Lebih Mudah</span>
                </h1>
                <p class="text-slate-400 text-sm font-semibold leading-relaxed">
                    Temukan lapangan futsal terbaik pilihan Anda, tentukan jadwal permainan secara instan, dan selesaikan reservasi Anda dengan mudah dan praktis dalam satu platform.
                </p>
            </div>

            <!-- Features Badge List (No Emojis, professional SVGs) -->
            <div class="flex flex-wrap gap-2.5 pt-4">
                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl text-xs font-bold bg-white/5 text-slate-300 border border-white/10">
                    <svg class="w-3.5 h-3.5 text-emerald-400" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/>
                    </svg>
                    Reservasi Lapangan
                </span>
                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl text-xs font-bold bg-white/5 text-slate-300 border border-white/10">
                    <svg class="w-3.5 h-3.5 text-emerald-400" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/>
                    </svg>
                    Jadwal Fleksibel
                </span>
                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl text-xs font-bold bg-white/5 text-slate-300 border border-white/10">
                    <svg class="w-3.5 h-3.5 text-emerald-400" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/>
                    </svg>
                    Konfirmasi Cepat
                </span>
            </div>
        </div>
    </div>

    {{-- Right Side: Login Form --}}
    <div class="w-full lg:w-1/2 flex flex-col justify-center p-6 sm:p-12 md:p-20 bg-white overflow-y-auto">
        <div class="max-w-md w-full mx-auto space-y-8">
            
            <!-- Mobile Header Logo (Visible on screens smaller than lg) -->
            <div class="flex lg:hidden items-center gap-3 mb-8">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-emerald-500 to-teal-500 flex items-center justify-center shadow-lg shadow-emerald-500/20">
                    <svg class="w-5.5 h-5.5 text-white" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM18 18.75V16.5A2.25 2.25 0 0015.75 14.25h-7.5A2.25 2.25 0 006 16.5v2.25m12 0H6"/>
                    </svg>
                </div>
                <span class="font-extrabold text-xl text-slate-900 tracking-tight">Footsal Arena</span>
            </div>

            <!-- Titles -->
            <div>
                <h2 class="text-2xl font-black text-slate-900 tracking-tight">Selamat Datang Kembali</h2>
                <p class="text-xs font-bold text-slate-400 mt-2">Silakan masuk menggunakan kredensial akun Anda.</p>
            </div>

            {{-- Alerts --}}
            @if(session('sukses'))
                <div class="flex items-center gap-3 bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3.5 rounded-2xl shadow-sm">
                    <div class="w-5 h-5 rounded-full bg-emerald-100 flex items-center justify-center shrink-0">
                        <svg class="w-3 h-3 text-emerald-600" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/>
                        </svg>
                    </div>
                    <span class="text-xs font-bold">{{ session('sukses') }}</span>
                </div>
            @endif

            @if(session('error'))
                <div class="flex items-center gap-3 bg-rose-50 border border-rose-200 text-rose-800 px-4 py-3.5 rounded-2xl shadow-sm">
                    <div class="w-5 h-5 rounded-full bg-rose-100 flex items-center justify-center shrink-0">
                        <svg class="w-3 h-3 text-rose-600" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </div>
                    <span class="text-xs font-bold">{{ session('error') }}</span>
                </div>
            @endif

            <!-- Form -->
            <form action="{{ route('autentikasi.prosesMasuk') }}" method="POST" class="space-y-6">
                @csrf

                {{-- Email Address --}}
                <div>
                    <label for="email" class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Username / Email</label>
                    <div class="relative rounded-xl shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM18 18.75V16.5A2.25 2.25 0 0015.75 14.25h-7.5A2.25 2.25 0 006 16.5v2.25m12 0H6"/>
                            </svg>
                        </div>
                        <input type="email" name="email" id="email" value="{{ old('email') }}" required autocomplete="email"
                            placeholder="admin@mail.com atau pelanggan@mail.com"
                            class="block w-full pl-11 pr-4 py-3.5 rounded-xl border border-slate-200 bg-slate-50/50 text-sm font-semibold text-slate-800 placeholder-slate-400 focus:bg-white focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 outline-none transition-all @error('email') border-rose-300 ring-1 ring-rose-500/20 @enderror">
                    </div>
                    @error('email')
                        <p class="mt-1.5 text-xs text-rose-600 font-semibold">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Password --}}
                <div>
                    <label for="password" class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Password</label>
                    <div class="relative rounded-xl shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z"/>
                            </svg>
                        </div>
                        <input type="password" name="password" id="password" required autocomplete="current-password"
                            placeholder="Masukkan password Anda"
                            class="block w-full pl-11 pr-4 py-3.5 rounded-xl border border-slate-200 bg-slate-50/50 text-sm font-semibold text-slate-800 placeholder-slate-400 focus:bg-white focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 outline-none transition-all @error('password') border-rose-300 ring-1 ring-rose-500/20 @enderror">
                    </div>
                    @error('password')
                        <p class="mt-1.5 text-xs text-rose-600 font-semibold">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Remember Me --}}
                <div class="flex items-center">
                    <input type="checkbox" name="ingat_saya" id="ingat_saya" value="1" 
                        class="h-4.5 w-4.5 text-indigo-600 border-slate-300 rounded-lg focus:ring-indigo-500 cursor-pointer">
                    <label for="ingat_saya" class="ml-2 block text-xs text-slate-500 font-bold cursor-pointer select-none">
                        Ingat sesi login saya
                    </label>
                </div>

                {{-- Action Button --}}
                <button type="submit" 
                    class="w-full flex justify-center py-3.5 px-4 rounded-xl shadow-lg shadow-indigo-600/10 text-sm font-bold text-white bg-indigo-600 hover:bg-indigo-700 transition-all duration-200 hover:-translate-y-0.5 outline-none">
                    Masuk ke Akun
                </button>
            </form>

            {{-- Footer Text --}}
            <p class="text-center text-xs font-bold text-slate-400">
                Belum memiliki akun? 
                <a href="{{ route('autentikasi.daftar') }}" class="text-indigo-600 hover:text-indigo-700 transition-colors">
                    Daftar Sekarang
                </a>
            </p>
        </div>
    </div>

</div>

</body>
</html>
