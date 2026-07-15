<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun — Footsal Arena</title>
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
                    Bergabung & Mulai <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-400 to-indigo-400">Bermain Futsal</span>
                </h1>
                <p class="text-slate-400 text-sm font-semibold leading-relaxed">
                    Buat akun baru untuk mulai memesan lapangan dengan mudah, memantau riwayat penyewaan, serta menikmati layanan futsal terbaik di Footsal Arena.
                </p>
            </div>

            <!-- Features Badge List (No Emojis, professional SVGs) -->
            <div class="flex flex-wrap gap-2.5 pt-4">
                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl text-xs font-bold bg-white/5 text-slate-300 border border-white/10">
                    <svg class="w-3.5 h-3.5 text-emerald-400" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/>
                    </svg>
                    Reservasi Instan
                </span>
                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl text-xs font-bold bg-white/5 text-slate-300 border border-white/10">
                    <svg class="w-3.5 h-3.5 text-emerald-400" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/>
                    </svg>
                    Akun Aman
                </span>
                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl text-xs font-bold bg-white/5 text-slate-300 border border-white/10">
                    <svg class="w-3.5 h-3.5 text-emerald-400" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/>
                    </svg>
                    Lapangan Pilihan
                </span>
            </div>
        </div>
    </div>

    {{-- Right Side: Register Form --}}
    <div class="w-full lg:w-1/2 flex flex-col justify-center p-6 sm:p-12 md:p-16 bg-white overflow-y-auto">
        <div class="max-w-md w-full mx-auto space-y-6">
            
            <!-- Mobile Header Logo -->
            <div class="flex lg:hidden items-center gap-3 mb-4">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-emerald-500 to-teal-500 flex items-center justify-center shadow-lg shadow-emerald-500/20">
                    <svg class="w-5.5 h-5.5 text-white" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM18 18.75V16.5A2.25 2.25 0 0015.75 14.25h-7.5A2.25 2.25 0 006 16.5v2.25m12 0H6"/>
                    </svg>
                </div>
                <span class="font-extrabold text-xl text-slate-900 tracking-tight">Footsal Arena</span>
            </div>

            <!-- Titles -->
            <div>
                <h2 class="text-2xl font-black text-slate-900 tracking-tight">Daftarkan Akun Baru</h2>
                <p class="text-xs font-bold text-slate-400 mt-2">Silakan lengkapi formulir pendaftaran di bawah ini.</p>
            </div>

            <!-- Form -->
            <form action="{{ route('autentikasi.prosesDaftar') }}" method="POST" class="space-y-4">
                @csrf

                {{-- Full Name --}}
                <div>
                    <label for="nama" class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-1.5">Nama Lengkap</label>
                    <div class="relative rounded-xl shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </div>
                        <input type="text" name="nama" id="nama" value="{{ old('nama') }}" required autocomplete="name"
                            placeholder="Contoh: Budi Santoso"
                            class="block w-full pl-11 pr-4 py-3 rounded-xl border border-slate-200 bg-slate-50/50 text-xs font-semibold text-slate-800 placeholder-slate-400 focus:bg-white focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 outline-none transition-all @error('nama') border-rose-300 ring-1 ring-rose-500/20 @enderror">
                    </div>
                    @error('nama')
                        <p class="mt-1 text-xs text-rose-600 font-semibold">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Email Address --}}
                <div>
                    <label for="email" class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-1.5">Alamat Email</label>
                    <div class="relative rounded-xl shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25H4.5a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5H4.5a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75"/>
                            </svg>
                        </div>
                        <input type="email" name="email" id="email" value="{{ old('email') }}" required autocomplete="email"
                            placeholder="nama@email.com"
                            class="block w-full pl-11 pr-4 py-3 rounded-xl border border-slate-200 bg-slate-50/50 text-xs font-semibold text-slate-800 placeholder-slate-400 focus:bg-white focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 outline-none transition-all @error('email') border-rose-300 ring-1 ring-rose-500/20 @enderror">
                    </div>
                    @error('email')
                        <p class="mt-1 text-xs text-rose-600 font-semibold">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Phone Number --}}
                <div>
                    <label for="no_telepon" class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-1.5">Nomor Telepon</label>
                    <div class="relative rounded-xl shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-2.824-1.802-5.122-4.1-6.924-6.924l1.293-.97c.362-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z"/>
                            </svg>
                        </div>
                        <input type="text" name="no_telepon" id="no_telepon" value="{{ old('no_telepon') }}" required
                            placeholder="Contoh: 081234567890"
                            class="block w-full pl-11 pr-4 py-3 rounded-xl border border-slate-200 bg-slate-50/50 text-xs font-semibold text-slate-800 placeholder-slate-400 focus:bg-white focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 outline-none transition-all @error('no_telepon') border-rose-300 ring-1 ring-rose-500/20 @enderror">
                    </div>
                    @error('no_telepon')
                        <p class="mt-1 text-xs text-rose-600 font-semibold">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Password --}}
                <div>
                    <label for="kata_sandi" class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-1.5">Kata Sandi</label>
                    <div class="relative rounded-xl shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z"/>
                            </svg>
                        </div>
                        <input type="password" name="kata_sandi" id="kata_sandi" required autocomplete="new-password"
                            placeholder="Minimal 8 karakter"
                            class="block w-full pl-11 pr-4 py-3 rounded-xl border border-slate-200 bg-slate-50/50 text-xs font-semibold text-slate-800 placeholder-slate-400 focus:bg-white focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 outline-none transition-all @error('kata_sandi') border-rose-300 ring-1 ring-rose-500/20 @enderror">
                    </div>
                    @error('kata_sandi')
                        <p class="mt-1 text-xs text-rose-600 font-semibold">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Confirm Password --}}
                <div>
                    <label for="kata_sandi_confirmation" class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-1.5">Konfirmasi Kata Sandi</label>
                    <div class="relative rounded-xl shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z"/>
                            </svg>
                        </div>
                        <input type="password" name="kata_sandi_confirmation" id="kata_sandi_confirmation" required autocomplete="new-password"
                            placeholder="Ulangi kata sandi Anda"
                            class="block w-full pl-11 pr-4 py-3 rounded-xl border border-slate-200 bg-slate-50/50 text-xs font-semibold text-slate-800 placeholder-slate-400 focus:bg-white focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 outline-none transition-all">
                    </div>
                </div>

                {{-- Action Button --}}
                <button type="submit" 
                    class="w-full flex justify-center py-3 px-4 rounded-xl shadow-lg shadow-indigo-600/10 text-xs font-bold text-white bg-indigo-600 hover:bg-indigo-700 transition-all duration-200 hover:-translate-y-0.5 outline-none">
                    Daftar Akun Baru
                </button>
            </form>

            {{-- Footer Text --}}
            <p class="text-center text-xs font-bold text-slate-400">
                Sudah memiliki akun? 
                <a href="{{ route('autentikasi.masuk') }}" class="text-indigo-600 hover:text-indigo-700 transition-colors">
                    Masuk Sekarang
                </a>
            </p>
        </div>
    </div>

</div>

</body>
</html>
