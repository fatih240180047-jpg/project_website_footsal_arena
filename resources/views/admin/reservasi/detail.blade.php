@extends('tata_letak.admin')
@section('judul', 'Detail Reservasi #' . $reservasi->id)

@section('konten')
<div class="mb-6">
    <a href="{{ route('admin.reservasi.index') }}"
        class="inline-flex items-center text-xs font-bold text-slate-400 hover:text-indigo-600 transition-colors group">
        <svg class="w-4 h-4 mr-1.5 group-hover:-translate-x-0.5 transition-transform" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"/>
        </svg>
        Kembali ke Daftar Reservasi
    </a>
</div>

{{-- Main Details Wrapper --}}
<div class="space-y-6 max-w-5xl mx-auto">

    {{-- Banner Status --}}
    @php
        $bannerBg = 'bg-amber-50 border-amber-200/60 text-amber-800';
        $statusIcon = '<svg class="w-6 h-6 text-amber-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>';
        if ($reservasi->status == 'dikonfirmasi') {
            $bannerBg = 'bg-emerald-50 border-emerald-200/60 text-emerald-800';
            $statusIcon = '<svg class="w-6 h-6 text-emerald-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>';
        } elseif ($reservasi->status == 'dibatalkan') {
            $bannerBg = 'bg-rose-50 border-rose-200/60 text-rose-800';
            $statusIcon = '<svg class="w-6 h-6 text-rose-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>';
        } elseif ($reservasi->status == 'selesai') {
            $bannerBg = 'bg-indigo-50 border-indigo-200/60 text-indigo-800';
            $statusIcon = '<svg class="w-6 h-6 text-indigo-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>';
        }
    @endphp
    
    <div class="rounded-3xl border p-6 flex flex-col sm:flex-row sm:items-center justify-between gap-4 {{ $bannerBg }} shadow-sm">
        <div class="flex items-center gap-4">
            <div class="w-12 h-12 rounded-2xl bg-white flex items-center justify-center shadow-sm">
                {!! $statusIcon !!}
            </div>
            <div>
                <p class="text-[10px] font-bold uppercase tracking-wider opacity-60">Status Reservasi</p>
                <h3 class="text-lg font-black tracking-tight mt-0.5">Pemesanan ini {{ $reservasi->label_status }}</h3>
            </div>
        </div>
        <div>
            <span class="text-xs font-bold bg-white/80 border border-current/25 px-3 py-1.5 rounded-xl">
                Kode Transaksi #{{ $reservasi->id }}
            </span>
        </div>
    </div>

    {{-- Info Grid --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        
        {{-- Pelanggan Card --}}
        <div class="bg-white rounded-3xl border border-slate-200/80 p-6 shadow-sm flex flex-col md:col-span-1">
            <h3 class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-6">Informasi Pemesan</h3>
            
            <div class="text-center pb-6 border-b border-slate-100 flex flex-col items-center">
                <div class="w-20 h-20 rounded-full bg-slate-50 text-slate-700 font-black text-3xl flex items-center justify-center border border-slate-200 shadow-sm mb-4">
                    {{ substr($reservasi->pengguna->nama, 0, 1) }}
                </div>
                <h4 class="text-base font-extrabold text-slate-800 leading-snug">{{ $reservasi->pengguna->nama }}</h4>
                <p class="text-xs text-slate-400 font-semibold mt-1">ID Pelanggan #{{ $reservasi->pengguna->id }}</p>
            </div>

            <div class="pt-6 space-y-4 flex-grow">
                <div>
                    <span class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1">Alamat Email</span>
                    <p class="text-xs font-bold text-slate-700 break-all">{{ $reservasi->pengguna->email }}</p>
                </div>
                
                <div>
                    <span class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1">Nomor Telepon</span>
                    <p class="text-xs font-bold text-slate-700">{{ $reservasi->pengguna->no_telepon }}</p>
                </div>
            </div>
        </div>

        {{-- Detail Reservasi --}}
        <div class="bg-white rounded-3xl border border-slate-200/80 p-6 shadow-sm md:col-span-2 space-y-6">
            <h3 class="text-xs font-bold text-slate-400 uppercase tracking-widest">Detail Lapangan & Jadwal</h3>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-4">
                <div>
                    <span class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1">Lapangan</span>
                    <span class="text-sm font-extrabold text-slate-800">{{ $reservasi->lapangan->nama_lapangan }}</span>
                </div>
                
                <div>
                    <span class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1">Tanggal Sewa</span>
                    <span class="text-sm font-extrabold text-slate-800">{{ $reservasi->tanggal->translatedFormat('l, d F Y') }}</span>
                </div>

                <div>
                    <span class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1">Waktu Main</span>
                    <span class="text-sm font-extrabold text-slate-800">
                        {{ substr($reservasi->jam_mulai, 0, 5) }} - {{ substr($reservasi->jam_selesai, 0, 5) }} 
                        <span class="text-xs text-slate-400 font-semibold ml-1">({{ $reservasi->durasi }} Jam)</span>
                    </span>
                </div>

                <div>
                    <span class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1">Tanggal Booking</span>
                    <span class="text-sm font-semibold text-slate-600">{{ $reservasi->created_at->translatedFormat('d F Y, H:i') }} WIB</span>
                </div>

                <div class="sm:col-span-2 pt-4 border-t border-slate-100">
                    <span class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1">Total Biaya Sewa</span>
                    <span class="text-xl font-black text-indigo-600">{{ $reservasi->total_harga_terformat }}</span>
                </div>

                @if($reservasi->keterangan)
                    <div class="sm:col-span-2 pt-4 border-t border-slate-100">
                        <span class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1">Catatan Tambahan / Keterangan</span>
                        <p class="text-xs font-semibold text-slate-500 bg-slate-50 border border-slate-100 p-3.5 rounded-xl mt-1.5 leading-relaxed">{{ $reservasi->keterangan }}</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    {{-- Action Buttons Footer Card --}}
    <div class="bg-white rounded-3xl border border-slate-200/80 p-6 shadow-sm flex flex-wrap items-center justify-between gap-4">
        <div>
            <p class="text-xs text-slate-400 font-bold">Harap verifikasi pembayaran / jadwal sebelum mengambil keputusan.</p>
        </div>
        <div class="flex items-center gap-2">
            @if($reservasi->status === 'pending')
                <form action="{{ route('admin.reservasi.konfirmasi', $reservasi->id) }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" 
                        class="px-5 py-3 rounded-2xl text-xs font-bold text-white bg-emerald-500 hover:bg-emerald-600 transition-all duration-200 shadow-md shadow-emerald-500/10 hover:-translate-y-0.5">
                        Konfirmasi Reservasi
                    </button>
                </form>
            @endif

            @if($reservasi->status === 'dikonfirmasi')
                <form action="{{ route('admin.reservasi.selesai', $reservasi->id) }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" 
                        class="px-5 py-3 rounded-2xl text-xs font-bold text-white bg-indigo-600 hover:bg-indigo-700 transition-all duration-200 shadow-md shadow-indigo-600/10 hover:-translate-y-0.5">
                        Tandai Selesai Main
                    </button>
                </form>
            @endif

            @if(!in_array($reservasi->status, ['selesai', 'dibatalkan']))
                <form action="{{ route('admin.reservasi.batalkan', $reservasi->id) }}" method="POST" class="inline"
                    onsubmit="return confirm('Apakah Anda yakin ingin membatalkan reservasi ini?');">
                    @csrf
                    <input type="hidden" name="keterangan" value="Dibatalkan oleh administrator.">
                    <button type="submit" 
                        class="px-5 py-3 rounded-2xl text-xs font-bold text-rose-600 bg-rose-50 hover:bg-rose-100 transition-all duration-200 border border-rose-200/50">
                        Batalkan Reservasi
                    </button>
                </form>
            @endif
        </div>
    </div>
</div>
@endsection
