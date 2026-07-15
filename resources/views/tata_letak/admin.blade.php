<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('judul', 'Admin Dashboard') — Footsal Arena</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    <style>
        /* Smooth transition for sidebar width and labels */
        .sidebar-transition {
            transition: width 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .label-transition {
            transition: opacity 0.2s ease, transform 0.2s ease;
        }
    </style>
</head>
<body class="bg-[#f8fafc] font-['Inter'] text-slate-800 antialiased">

<div class="flex h-screen overflow-hidden">

    {{-- ====================== SIDEBAR ====================== --}}
    <aside id="sidebar"
        class="relative z-30 flex flex-col w-64 min-h-screen bg-[#0f172a] text-slate-300 border-r border-slate-800 shadow-xl sidebar-transition overflow-hidden shrink-0">

        <!-- Logo & Branding Area -->
        <div class="flex items-center h-20 px-6 border-b border-slate-800 shrink-0">
            <div class="flex items-center gap-3 overflow-hidden">
                <div class="w-10 h-10 shrink-0 rounded-xl bg-gradient-to-tr from-emerald-500 to-teal-600 flex items-center justify-center shadow-lg shadow-emerald-950/50">
                    <!-- Ball Icon -->
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM18 18.75V16.5A2.25 2.25 0 0015.75 14.25h-7.5A2.25 2.25 0 006 16.5v2.25m12 0H6"/>
                    </svg>
                </div>
                <span class="sidebar-label font-extrabold text-white text-lg tracking-tight whitespace-nowrap label-transition">Footsal Arena</span>
            </div>
        </div>

        <!-- Main Navigation Links -->
        <nav class="flex-1 py-6 px-4 overflow-y-auto space-y-1.5 custom-scrollbar-dark">
            <p class="sidebar-label px-3 mb-3 text-[10px] font-bold text-slate-500 uppercase tracking-widest whitespace-nowrap label-transition">Navigasi Utama</p>

            <!-- Dashboard -->
            <a href="{{ route('admin.dashboard') }}"
                title="Dashboard"
                class="group flex items-center gap-4 px-4 py-3.5 rounded-xl text-sm font-semibold transition-all duration-200
                {{ request()->routeIs('admin.dashboard') 
                    ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-600/30' 
                    : 'text-slate-400 hover:bg-slate-800/50 hover:text-white' }}">
                <span class="shrink-0">
                    <svg class="w-5.5 h-5.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z"/>
                    </svg>
                </span>
                <span class="sidebar-label whitespace-nowrap label-transition">Dashboard</span>
            </a>

            <!-- Lapangan -->
            <a href="{{ route('admin.lapangan.index') }}"
                title="Manajemen Lapangan"
                class="group flex items-center gap-4 px-4 py-3.5 rounded-xl text-sm font-semibold transition-all duration-200
                {{ request()->routeIs('admin.lapangan.*') 
                    ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-600/30' 
                    : 'text-slate-400 hover:bg-slate-800/50 hover:text-white' }}">
                <span class="shrink-0">
                    <svg class="w-5.5 h-5.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 01-2.25 2.25M16.5 7.5V18a2.25 2.25 0 002.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 002.25 2.25h13.5M6 7.5h3v3H6v-3z"/>
                    </svg>
                </span>
                <span class="sidebar-label whitespace-nowrap label-transition">Lapangan</span>
            </a>

            <!-- Reservasi -->
            <a href="{{ route('admin.reservasi.index') }}"
                title="Data Reservasi"
                class="group flex items-center gap-4 px-4 py-3.5 rounded-xl text-sm font-semibold transition-all duration-200
                {{ request()->routeIs('admin.reservasi.*') 
                    ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-600/30' 
                    : 'text-slate-400 hover:bg-slate-800/50 hover:text-white' }}">
                <span class="shrink-0">
                    <svg class="w-5.5 h-5.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5m-9-6h.008v.008H12v-.008zM12 15h.008v.008H12V15zm0 2.25h.008v.008H12v-.008zM9.75 15h.008v.008H9.75V15zm0 2.25h.008v.008H9.75v-.008zM7.5 15h.008v.008H7.5V15zm0 2.25h.008v.008H7.5v-.008zm6.75-4.5h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V15zm0 2.25h.008v.008h-.008v-.008zm2.25-4.5h.008v.008H16.5v-.008zm0 2.25h.008v.008H16.5V15z"/>
                    </svg>
                </span>
                <span class="sidebar-label whitespace-nowrap label-transition">Reservasi</span>
            </a>
        </nav>

        <!-- Bottom: Logout & Collapse Sidebar Toggle -->
        <div class="border-t border-slate-800 p-4 space-y-1.5 shrink-0">
            <!-- Logout Button -->
            <form action="{{ route('autentikasi.keluar') }}" method="POST">
                @csrf
                <button type="submit" title="Keluar"
                    class="group w-full flex items-center gap-4 px-4 py-3 rounded-xl text-sm font-semibold text-slate-400 hover:bg-rose-950/40 hover:text-rose-400 transition-all duration-200">
                    <span class="shrink-0 text-slate-500 group-hover:text-rose-400 transition-colors">
                        <svg class="w-5.5 h-5.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75"/>
                        </svg>
                    </span>
                    <span class="sidebar-label whitespace-nowrap label-transition">Keluar Sistem</span>
                </button>
            </form>

            <!-- Toggle Collapse Button -->
            <button id="sidebarToggle" title="Sembunyikan Menu"
                class="group w-full flex items-center gap-4 px-4 py-3 rounded-xl text-sm font-semibold text-slate-400 hover:bg-slate-800/40 hover:text-white transition-all duration-200">
                <span class="shrink-0 text-slate-500 group-hover:text-white transition-colors">
                    <svg id="toggleIcon" class="w-5.5 h-5.5 transition-transform duration-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M18.75 19.5l-7.5-7.5 7.5-7.5m-6 15L5.25 12l7.5-7.5"/>
                    </svg>
                </span>
                <span class="sidebar-label whitespace-nowrap label-transition">Sembunyikan</span>
            </button>
        </div>
    </aside>

    {{-- ====================== MAIN CONTENT AREA ====================== --}}
    <div class="flex flex-col flex-1 min-w-0 overflow-hidden">

        <!-- Top Header/Navbar -->
        <header class="flex items-center justify-between h-20 px-8 bg-white border-b border-slate-200/80 shadow-sm shrink-0 z-20">
            <div>
                <h1 class="text-xl font-extrabold text-slate-900 leading-none">@yield('judul', 'Dashboard')</h1>
                <p class="text-xs text-slate-400 mt-1.5 font-semibold uppercase tracking-wider">Panel Pengelola Footsal Arena</p>
            </div>
            <div class="flex items-center gap-4">
                <!-- User Profile Dropdown / Information -->
                <div class="flex items-center gap-3 px-4 py-2 bg-slate-50 border border-slate-200/80 rounded-2xl shadow-sm">
                    <div class="w-8 h-8 rounded-xl bg-indigo-600 text-white font-extrabold text-sm flex items-center justify-center shadow-md shadow-indigo-100">
                        {{ substr(auth()->user()->nama ?? 'A', 0, 1) }}
                    </div>
                    <div class="hidden sm:block text-left">
                        <p class="text-xs font-bold text-slate-800 leading-none">{{ auth()->user()->nama ?? 'Administrator' }}</p>
                        <p class="text-[9px] font-bold text-slate-400 mt-1 uppercase tracking-wider">Admin</p>
                    </div>
                </div>
            </div>
        </header>

        <!-- Main Scrollable Content Container -->
        <main class="flex-grow overflow-y-auto p-6 md:p-8 bg-[#f8fafc]">
            <div class="max-w-7xl mx-auto">

                {{-- Alert Sukses --}}
                @if(session('sukses'))
                    <div class="flex items-center gap-3 bg-emerald-50 border border-emerald-200 text-emerald-800 px-5 py-4 rounded-2xl mb-6 shadow-sm animate-fade-in">
                        <div class="w-6 h-6 rounded-full bg-emerald-100 flex items-center justify-center shrink-0">
                            <svg class="w-3.5 h-3.5 text-emerald-600" fill="none" stroke="currentColor" stroke-width="3.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/>
                            </svg>
                        </div>
                        <span class="text-sm font-bold">{{ session('sukses') }}</span>
                    </div>
                @endif

                {{-- Alert Error --}}
                @if(session('error'))
                    <div class="flex items-center gap-3 bg-rose-50 border border-rose-200 text-rose-800 px-5 py-4 rounded-2xl mb-6 shadow-sm animate-fade-in">
                        <div class="w-6 h-6 rounded-full bg-rose-100 flex items-center justify-center shrink-0">
                            <svg class="w-3.5 h-3.5 text-rose-600" fill="none" stroke="currentColor" stroke-width="3.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </div>
                        <span class="text-sm font-bold">{{ session('error') }}</span>
                    </div>
                @endif

                {{-- Alert Validation Errors --}}
                @if($errors->any())
                    <div class="bg-rose-50 border border-rose-200 text-rose-800 px-5 py-4 rounded-2xl mb-6 shadow-sm animate-fade-in">
                        <div class="flex items-center gap-3 mb-3">
                            <div class="w-6 h-6 rounded-full bg-rose-100 flex items-center justify-center shrink-0">
                                <svg class="w-3.5 h-3.5 text-rose-600" fill="none" stroke="currentColor" stroke-width="3.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z"/>
                                </svg>
                            </div>
                            <span class="text-sm font-black">Terdapat beberapa kesalahan input:</span>
                        </div>
                        <ul class="list-disc list-inside space-y-1 pl-9">
                            @foreach($errors->all() as $error)
                                <li class="text-xs font-semibold text-rose-700">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @yield('konten')

            </div>
        </main>

    </div>{{-- end main area --}}

</div>{{-- end flex --}}

@stack('skrip')

<script>
document.addEventListener('DOMContentLoaded', function () {
    const sidebar = document.getElementById('sidebar');
    const toggleBtn = document.getElementById('sidebarToggle');
    const toggleIcon = document.getElementById('toggleIcon');
    const labels = document.querySelectorAll('.sidebar-label');

    // Load state from localStorage
    let collapsed = localStorage.getItem('adminSidebarCollapsed') === 'true';

    function apply(instant) {
        if (instant) {
            sidebar.style.transition = 'none';
            labels.forEach(el => el.style.transition = 'none');
        }

        if (collapsed) {
            // Collapse
            sidebar.classList.replace('w-64', 'w-20');
            toggleIcon.style.transform = 'rotate(180deg)';
            labels.forEach(el => {
                el.style.opacity = '0';
                el.style.transform = 'translateX(-10px)';
                el.style.pointerEvents = 'none';
                if (instant) {
                    el.style.display = 'none';
                } else {
                    setTimeout(() => {
                        if (collapsed) el.style.display = 'none';
                    }, 200);
                }
            });
        } else {
            // Expand
            sidebar.classList.replace('w-20', 'w-64');
            toggleIcon.style.transform = 'rotate(0deg)';
            labels.forEach(el => {
                el.style.display = '';
                el.style.pointerEvents = '';
                // Trigger reflow to apply display first, then animate opacity
                requestAnimationFrame(() => {
                    requestAnimationFrame(() => {
                        el.style.opacity = '1';
                        el.style.transform = 'translateX(0)';
                    });
                });
            });
        }

        if (instant) {
            // Trigger reflow & restore transitions
            sidebar.getBoundingClientRect();
            sidebar.style.transition = '';
            labels.forEach(el => el.style.transition = '');
        }
    }

    apply(true); // init instantly

    toggleBtn.addEventListener('click', function () {
        collapsed = !collapsed;
        localStorage.setItem('adminSidebarCollapsed', collapsed);
        apply(false);
    });
});
</script>

</body>
</html>
