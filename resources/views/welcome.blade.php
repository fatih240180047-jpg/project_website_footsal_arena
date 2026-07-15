@extends('tata_letak.pelanggan')
@section('judul', 'Footsal Arena - Reservasi Lapangan Futsal Terbaik')

@section('konten')
<!-- Hero Section -->
<div class="relative bg-white overflow-hidden rounded-3xl shadow-xl shadow-slate-200/40 mb-16">
    <div class="max-w-7xl mx-auto">
        <div class="relative z-10 pb-8 bg-white sm:pb-16 md:pb-20 lg:max-w-2xl lg:w-full lg:pb-28 xl:pb-32">
            <main class="mt-10 mx-auto max-w-7xl px-4 sm:mt-12 sm:px-6 md:mt-16 lg:mt-20 lg:px-8 xl:mt-28">
                <div class="sm:text-center lg:text-left">
                    <h1 class="text-4xl tracking-tight font-black text-slate-900 sm:text-5xl md:text-6xl">
                        <span class="block xl:inline">Main Futsal Makin</span>
                        <span class="block text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-blue-500">Seru & Mudah</span>
                    </h1>
                    <p class="mt-3 text-base text-slate-500 sm:mt-5 sm:text-lg sm:max-w-xl sm:mx-auto md:mt-5 md:text-xl lg:mx-0 font-medium">
                        Temukan dan reservasi lapangan futsal terbaik di sekitarmu hanya dengan beberapa klik. Jadwal terupdate secara real-time.
                    </p>
                    <div class="mt-5 sm:mt-8 sm:flex sm:justify-center lg:justify-start">
                        <div class="rounded-full shadow-lg shadow-indigo-500/30">
                            <a href="{{ route('pelanggan.lapangan.index') }}" class="w-full flex items-center justify-center px-8 py-4 border border-transparent text-base font-medium rounded-full text-white bg-indigo-600 hover:bg-indigo-700 hover:-translate-y-0.5 transition-all md:text-lg md:px-10">
                                Cari Lapangan Sekarang
                            </a>
                        </div>
                        <div class="mt-3 sm:mt-0 sm:ml-3">
                            <a href="{{ route('autentikasi.daftar') }}" class="w-full flex items-center justify-center px-8 py-4 border-2 border-indigo-100 text-base font-medium rounded-full text-indigo-700 bg-indigo-50 hover:bg-indigo-100 transition-colors md:text-lg md:px-10">
                                Daftar Akun Baru
                            </a>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <div class="lg:absolute lg:inset-y-0 lg:right-0 lg:w-1/2 bg-slate-100">
        <!-- Placeholder image using generic gradient for aesthetic -->
        <div class="h-56 w-full sm:h-72 md:h-96 lg:w-full lg:h-full bg-gradient-to-br from-indigo-400 via-blue-500 to-cyan-400">
            <div class="flex items-center justify-center h-full w-full opacity-20">
                <svg class="w-32 h-32 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
        </div>
    </div>
</div>

<!-- Features Section -->
<div class="py-12 bg-transparent">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="lg:text-center mb-12">
            <h2 class="text-base text-indigo-600 font-semibold tracking-wide uppercase">Fitur Unggulan</h2>
            <p class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-slate-900 sm:text-4xl">
                Cara Terbaik Reservasi Lapangan
            </p>
            <p class="mt-4 max-w-2xl text-xl text-slate-500 lg:mx-auto font-medium">
                Kami menyediakan sistem reservasi yang memanjakan pengguna dengan berbagai kemudahan.
            </p>
        </div>

        <div class="mt-10">
            <dl class="space-y-10 md:space-y-0 md:grid md:grid-cols-3 md:gap-x-8 md:gap-y-10">
                <div class="relative bg-white p-6 rounded-2xl shadow-sm border border-slate-100 hover:shadow-md transition-shadow">
                    <dt>
                        <div class="absolute flex items-center justify-center h-12 w-12 rounded-xl bg-indigo-500 text-white shadow-lg shadow-indigo-500/40">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <p class="ml-16 text-lg leading-6 font-bold text-slate-900">Real-time Jadwal</p>
                    </dt>
                    <dd class="mt-2 ml-16 text-base text-slate-500 font-medium">
                        Lihat jadwal lapangan secara real-time. Tidak ada lagi double-booking atau jadwal bentrok.
                    </dd>
                </div>

                <div class="relative bg-white p-6 rounded-2xl shadow-sm border border-slate-100 hover:shadow-md transition-shadow">
                    <dt>
                        <div class="absolute flex items-center justify-center h-12 w-12 rounded-xl bg-indigo-500 text-white shadow-lg shadow-indigo-500/40">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                        </div>
                        <p class="ml-16 text-lg leading-6 font-bold text-slate-900">Pembayaran Mudah</p>
                    </dt>
                    <dd class="mt-2 ml-16 text-base text-slate-500 font-medium">
                        Konfirmasi dan metode pembayaran yang terintegrasi untuk keamanan dan kenyamanan Anda.
                    </dd>
                </div>

                <div class="relative bg-white p-6 rounded-2xl shadow-sm border border-slate-100 hover:shadow-md transition-shadow">
                    <dt>
                        <div class="absolute flex items-center justify-center h-12 w-12 rounded-xl bg-indigo-500 text-white shadow-lg shadow-indigo-500/40">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <p class="ml-16 text-lg leading-6 font-bold text-slate-900">Kenyamanan Ekstra</p>
                    </dt>
                    <dd class="mt-2 ml-16 text-base text-slate-500 font-medium">
                        Fasilitas lapangan lengkap, info detail, dan UI website yang dirancang agar mudah digunakan siapa saja.
                    </dd>
                </div>
            </dl>
        </div>
    </div>
</div>
@endsection

