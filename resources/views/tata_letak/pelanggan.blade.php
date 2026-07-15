<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('judul', 'Footsal Arena')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="font-sans antialiased text-slate-800 bg-slate-50 flex flex-col min-h-screen selection:bg-indigo-500 selection:text-white">

    <!-- Navbar -->
    <nav class="bg-white/80 backdrop-blur-lg border-b border-slate-200 sticky top-0 z-50 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20">
                <div class="flex items-center">
                    <a href="/" class="flex-shrink-0 flex items-center group">
                        <span class="text-2xl font-black tracking-tighter text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-blue-500 group-hover:scale-105 transition-transform">Footsal Arena</span>
                    </a>
                </div>
                <div class="flex items-center space-x-1 sm:space-x-4">
                    @auth
                        @if(auth()->user()->peran === 'admin')
                            <a href="{{ route('admin.dashboard') }}" class="px-4 py-2 rounded-full text-sm font-medium text-slate-600 hover:text-indigo-600 hover:bg-indigo-50 transition-colors">Dashboard</a>
                        @else
                            <a href="{{ route('pelanggan.lapangan.index') }}" class="px-4 py-2 rounded-full text-sm font-medium {{ request()->routeIs('pelanggan.lapangan.*') ? 'text-indigo-600 bg-indigo-50' : 'text-slate-600 hover:text-indigo-600 hover:bg-indigo-50' }} transition-colors">Cari Lapangan</a>
                            <a href="{{ route('pelanggan.reservasi.index') }}" class="px-4 py-2 rounded-full text-sm font-medium {{ request()->routeIs('pelanggan.reservasi.*') ? 'text-indigo-600 bg-indigo-50' : 'text-slate-600 hover:text-indigo-600 hover:bg-indigo-50' }} transition-colors">Reservasi Saya</a>
                        @endif
                        
                        <div class="h-6 w-px bg-slate-200 mx-2"></div>
                        
                        <div class="flex items-center space-x-3 pl-2">
                            <span class="text-sm font-medium text-slate-700 hidden sm:block">Halo, {{ auth()->user()->nama }}</span>
                            <form action="{{ route('autentikasi.keluar') }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="px-4 py-2 rounded-full text-sm font-medium bg-rose-50 text-rose-600 hover:bg-rose-100 transition-colors">Keluar</button>
                            </form>
                        </div>
                    @else
                        <a href="{{ route('autentikasi.masuk') }}" class="px-5 py-2.5 rounded-full text-sm font-medium text-slate-700 hover:bg-slate-100 transition-colors">Masuk</a>
                        <a href="{{ route('autentikasi.daftar') }}" class="px-5 py-2.5 rounded-full text-sm font-medium bg-indigo-600 text-white hover:bg-indigo-700 shadow-md shadow-indigo-500/30 transition-all hover:-translate-y-0.5">Daftar Sekarang</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Content -->
    <main class="flex-grow w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-12">
        @if(session('sukses'))
            <div class="bg-emerald-50 border border-emerald-200 text-emerald-600 px-4 py-3 rounded-2xl mb-8 flex items-center shadow-sm">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <span class="font-medium">{{ session('sukses') }}</span>
            </div>
        @endif
        @if(session('error'))
            <div class="bg-rose-50 border border-rose-200 text-rose-600 px-4 py-3 rounded-2xl mb-8 flex items-center shadow-sm">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <span class="font-medium">{{ session('error') }}</span>
            </div>
        @endif
        @if($errors->any())
            <div class="bg-rose-50 border border-rose-200 text-rose-600 px-4 py-3 rounded-2xl mb-8 shadow-sm">
                <div class="flex items-center mb-2 font-medium">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    Terdapat beberapa kesalahan:
                </div>
                <ul class="list-disc list-inside text-sm pl-2 space-y-1">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('konten')
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t border-slate-200 mt-auto">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="md:flex md:items-center md:justify-between text-center md:text-left">
                <div class="flex justify-center md:justify-start mb-4 md:mb-0">
                    <span class="text-xl font-black tracking-tighter text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-blue-500">Footsal Arena</span>
                </div>
                <p class="text-slate-500 text-sm font-medium">
                    &copy; {{ date('Y') }} Footsal Arena. Seluruh hak cipta dilindungi.
                </p>
            </div>
        </div>
    </footer>

    @stack('skrip')
</body>
</html>

