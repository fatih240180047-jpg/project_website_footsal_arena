@extends('tata_letak.pelanggan')
@section('judul', 'Cari Lapangan - Footsal Arena')

@section('konten')
<div class="mb-8">
    <h2 class="text-3xl font-black text-slate-900 tracking-tight">Cari Lapangan Futsal</h2>
    <p class="mt-2 text-slate-500 font-medium">Temukan jadwal lapangan yang tersedia sesuai dengan kebutuhan Anda.</p>
</div>

<div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 mb-10">
    <form method="GET" action="{{ route('pelanggan.lapangan.index') }}">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6 items-end">
            <div>
                <label for="tanggal" class="block text-sm font-semibold text-slate-700 mb-2">Tanggal</label>
                <input type="date" name="tanggal" id="tanggal" value="{{ $tanggal }}" required class="block w-full px-4 py-3 rounded-xl border-slate-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm font-medium">
            </div>
            <div>
                <label for="jam_mulai" class="block text-sm font-semibold text-slate-700 mb-2">Jam Mulai</label>
                <select name="jam_mulai" id="jam_mulai" class="block w-full px-4 py-3 rounded-xl border-slate-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm font-medium bg-white">
                    @for($i = 8; $i < 23; $i++)
                        <option value="{{ sprintf('%02d:00', $i) }}" {{ $jamMulai == sprintf('%02d:00', $i) ? 'selected' : '' }}>{{ sprintf('%02d:00', $i) }}</option>
                    @endfor
                </select>
            </div>
            <div>
                <label for="jam_selesai" class="block text-sm font-semibold text-slate-700 mb-2">Jam Selesai</label>
                <select name="jam_selesai" id="jam_selesai" class="block w-full px-4 py-3 rounded-xl border-slate-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm font-medium bg-white">
                    @for($i = 9; $i <= 23; $i++)
                        <option value="{{ sprintf('%02d:00', $i) }}" {{ $jamSelesai == sprintf('%02d:00', $i) ? 'selected' : '' }}>{{ sprintf('%02d:00', $i) }}</option>
                    @endfor
                </select>
            </div>
            <div>
                <label for="kata_kunci" class="block text-sm font-semibold text-slate-700 mb-2">Kata Kunci (Opsional)</label>
                <input type="text" name="kata_kunci" id="kata_kunci" value="{{ $kataKunci }}" placeholder="Cari nama lapangan..." class="block w-full px-4 py-3 rounded-xl border-slate-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm font-medium">
            </div>
            <div>
                <button type="submit" name="cari" value="1" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-xl shadow-md shadow-indigo-500/20 text-sm font-bold text-white bg-indigo-600 hover:bg-indigo-700 hover:-translate-y-0.5 transition-all focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    Cari Lapangan
                </button>
            </div>
        </div>
    </form>
</div>

@if(isset($lapanganTersedia))
    <div class="flex items-center justify-between mb-6">
        <h3 class="text-xl font-bold text-slate-900">Hasil Pencarian</h3>
        <span class="bg-indigo-50 text-indigo-700 py-1 px-3 rounded-full text-sm font-semibold">{{ $lapanganTersedia->count() }} Ditemukan</span>
    </div>
    
    @if($lapanganTersedia->isEmpty())
        <div class="bg-white rounded-2xl border border-slate-200 p-12 text-center shadow-sm">
            <svg class="mx-auto h-12 w-12 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            <h3 class="mt-2 text-lg font-medium text-slate-900">Tidak ada lapangan tersedia</h3>
            <p class="mt-1 text-sm text-slate-500 font-medium">Coba sesuaikan tanggal atau jam pencarian Anda.</p>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($lapanganTersedia as $lp)
                <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-sm hover:shadow-xl hover:shadow-indigo-500/10 transition-all group flex flex-col h-full">
                    <div class="h-48 bg-slate-100 relative overflow-hidden">
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-900/60 to-transparent z-10"></div>
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($lp->nama_lapangan) }}&background=6366f1&color=fff&size=400" alt="{{ $lp->nama_lapangan }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        <div class="absolute bottom-4 left-4 right-4 z-20">
                            <h3 class="text-xl font-bold text-white mb-1">{{ $lp->nama_lapangan }}</h3>
                        </div>
                    </div>
                    
                    <div class="p-6 flex-grow flex flex-col">
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center text-indigo-600 font-bold text-lg">
                                <span>{{ $lp->harga_terformat }}</span>
                                <span class="text-slate-400 text-sm font-medium ml-1">/jam</span>
                            </div>
                        </div>
                        
                        <p class="text-slate-600 text-sm mb-6 flex-grow line-clamp-3 font-medium">{{ $lp->deskripsi }}</p>
                        
                        @if($lp->fasilitas)
                            <div class="mb-6">
                                <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Fasilitas</p>
                                <div class="flex flex-wrap gap-2">
                                    @foreach($lp->fasilitas as $f)
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-medium bg-slate-100 text-slate-600">
                                            {{ $f }}
                                        </span>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                        
                        <div class="grid grid-cols-2 gap-3 mt-auto pt-4 border-t border-slate-100">
                            <a href="{{ route('pelanggan.lapangan.detail', ['lapangan' => $lp->id, 'tanggal' => $tanggal]) }}" class="flex justify-center items-center px-4 py-2.5 border border-slate-200 rounded-xl text-sm font-semibold text-slate-700 bg-white hover:bg-slate-50 transition-colors">
                                Info Detail
                            </a>
                            <a href="{{ route('pelanggan.reservasi.buat', ['lapangan_id' => $lp->id, 'tanggal' => $tanggal]) }}" class="flex justify-center items-center px-4 py-2.5 border border-transparent rounded-xl text-sm font-semibold text-white bg-indigo-600 hover:bg-indigo-700 hover:shadow-md hover:shadow-indigo-500/20 transition-all">
                                Pesan
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
@else
    <div class="flex items-center justify-between mb-6">
        <h3 class="text-xl font-bold text-slate-900">Semua Lapangan Kami</h3>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach($semuaLapangan as $lp)
            <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-sm hover:shadow-xl hover:shadow-indigo-500/10 transition-all group flex flex-col h-full">
                <div class="h-48 bg-slate-100 relative overflow-hidden">
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-900/60 to-transparent z-10"></div>
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($lp->nama_lapangan) }}&background=6366f1&color=fff&size=400" alt="{{ $lp->nama_lapangan }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    <div class="absolute bottom-4 left-4 right-4 z-20">
                        <h3 class="text-xl font-bold text-white mb-1">{{ $lp->nama_lapangan }}</h3>
                    </div>
                </div>
                
                <div class="p-6 flex-grow flex flex-col">
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center text-indigo-600 font-bold text-lg">
                            <span>{{ $lp->harga_terformat }}</span>
                            <span class="text-slate-400 text-sm font-medium ml-1">/jam</span>
                        </div>
                    </div>
                    
                    <p class="text-slate-600 text-sm mb-6 flex-grow line-clamp-3 font-medium">{{ $lp->deskripsi }}</p>
                    
                    @if($lp->fasilitas)
                        <div class="mb-6">
                            <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Fasilitas</p>
                            <div class="flex flex-wrap gap-2">
                                @foreach($lp->fasilitas as $f)
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-medium bg-slate-100 text-slate-600">
                                        {{ $f }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    @endif
                    
                    <div class="mt-auto pt-4 border-t border-slate-100">
                        <a href="{{ route('pelanggan.lapangan.detail', ['lapangan' => $lp->id]) }}" class="w-full flex justify-center items-center px-4 py-3 border border-transparent rounded-xl text-sm font-semibold text-indigo-700 bg-indigo-50 hover:bg-indigo-100 transition-colors">
                            Lihat Detail & Ketersediaan
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endif
@endsection

