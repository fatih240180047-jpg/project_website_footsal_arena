@extends('tata_letak.pelanggan')
@section('judul', 'Detail Reservasi - Footsal Arena')

@section('konten')
<div class="mb-6 max-w-3xl mx-auto">
    <a href="{{ route('pelanggan.reservasi.index') }}" class="inline-flex items-center text-sm font-semibold text-slate-500 hover:text-indigo-600 transition-colors group">
        <svg class="w-4 h-4 mr-1.5 group-hover:-translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
        Kembali ke Daftar Reservasi
    </a>
</div>

<div class="max-w-3xl mx-auto">
    <div class="bg-white rounded-3xl border border-slate-200 shadow-xl shadow-slate-200/50 overflow-hidden relative">
        {{-- Header Struk --}}
        <div class="bg-gradient-to-br from-indigo-600 to-blue-500 p-8 text-center relative overflow-hidden">
            {{-- Decorative circles --}}
            <div class="absolute top-0 right-0 -mr-8 -mt-8 w-32 h-32 rounded-full bg-white/10 blur-2xl"></div>
            <div class="absolute bottom-0 left-0 -ml-8 -mb-8 w-24 h-24 rounded-full bg-white/10 blur-xl"></div>
            
            <div class="relative z-10">
                <p class="text-indigo-100 font-medium text-sm tracking-widest uppercase mb-1">E-Receipt Footsal Arena</p>
                <h2 class="text-3xl font-black text-white">INV-{{ str_pad($reservasi->id, 5, '0', STR_PAD_LEFT) }}</h2>
                <div class="mt-4 flex justify-center">
                    @php
                        $badgeClass = 'bg-amber-100 text-amber-800';
                        if ($reservasi->status == 'dikonfirmasi') $badgeClass = 'bg-emerald-100 text-emerald-800';
                        elseif ($reservasi->status == 'dibatalkan') $badgeClass = 'bg-rose-100 text-rose-800';
                        elseif ($reservasi->status == 'selesai') $badgeClass = 'bg-blue-100 text-blue-800';
                    @endphp
                    <span class="inline-flex items-center px-4 py-1.5 rounded-full text-sm font-bold {{ $badgeClass }} shadow-sm">
                        {{ $reservasi->label_status }}
                    </span>
                </div>
            </div>
        </div>

        {{-- Edge cutouts for receipt look --}}
        <div class="relative h-6 bg-white overflow-hidden flex justify-between items-center px-[-10px] z-20" style="margin-top:-12px; margin-bottom:-12px;">
            <div class="w-6 h-6 rounded-full bg-slate-50 absolute -left-3 shadow-inner"></div>
            <div class="w-full border-t-2 border-dashed border-slate-200 mx-4"></div>
            <div class="w-6 h-6 rounded-full bg-slate-50 absolute -right-3 shadow-inner"></div>
        </div>

        <div class="p-8">
            <h3 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-4">Detail Booking</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-y-4 gap-x-8 mb-8">
                <div>
                    <p class="text-sm text-slate-500 font-medium">Lapangan</p>
                    <p class="text-base font-bold text-slate-900">{{ $reservasi->lapangan->nama_lapangan }}</p>
                </div>
                <div>
                    <p class="text-sm text-slate-500 font-medium">Tanggal Main</p>
                    <p class="text-base font-bold text-slate-900">{{ $reservasi->tanggal->translatedFormat('l, d F Y') }}</p>
                </div>
                <div>
                    <p class="text-sm text-slate-500 font-medium">Waktu</p>
                    <p class="text-base font-bold text-slate-900">{{ $reservasi->jam_mulai }} - {{ $reservasi->jam_selesai }} ({{ $reservasi->durasi }} jam)</p>
                </div>
                <div>
                    <p class="text-sm text-slate-500 font-medium">Tanggal Pemesanan</p>
                    <p class="text-base font-bold text-slate-900">{{ $reservasi->created_at->translatedFormat('d F Y, H:i') }} WIB</p>
                </div>
                <div class="md:col-span-2">
                    <p class="text-sm text-slate-500 font-medium">Pemesan</p>
                    <p class="text-base font-bold text-slate-900">{{ $reservasi->pengguna->nama }} ({{ $reservasi->pengguna->no_telepon }})</p>
                </div>
                @if($reservasi->keterangan)
                <div class="md:col-span-2">
                    <p class="text-sm text-slate-500 font-medium">Keterangan Tambahan</p>
                    <p class="text-base font-medium text-slate-700 bg-slate-50 p-3 rounded-lg border border-slate-100 mt-1">{{ $reservasi->keterangan }}</p>
                </div>
                @endif
            </div>

            <div class="bg-slate-50 rounded-2xl p-6 border border-slate-100 mb-8 flex justify-between items-center">
                <div>
                    <p class="text-sm text-slate-500 font-medium">Tarif Dasar</p>
                    <p class="text-sm font-bold text-slate-700">{{ $reservasi->lapangan->harga_terformat }} x {{ $reservasi->durasi }} jam</p>
                </div>
                <div class="text-right">
                    <p class="text-sm text-slate-500 font-medium">Total Harga</p>
                    <p class="text-3xl font-black text-indigo-600">{{ $reservasi->total_harga_terformat }}</p>
                </div>
            </div>

            {{-- Informasi Pembayaran (Hanya tampil jika pending) --}}
            @if($reservasi->status === 'pending')
            <div class="bg-gradient-to-br from-amber-50 to-amber-100/50 rounded-2xl p-6 border border-amber-200 shadow-sm relative overflow-hidden">
                <div class="absolute top-0 right-0 p-4 opacity-10">
                    <svg class="w-24 h-24 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                </div>
                <div class="relative z-10">
                    <div class="flex items-center gap-2 mb-4">
                        <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <h3 class="text-base font-bold text-amber-900">Instruksi Pembayaran</h3>
                    </div>
                    
                    <p class="text-sm font-medium text-amber-800 mb-4">Segera lakukan transfer sesuai nominal <strong class="text-amber-900">{{ $reservasi->total_harga_terformat }}</strong> ke rekening berikut:</p>
                    
                    <div class="bg-white/60 backdrop-blur-sm rounded-xl p-4 border border-amber-200/60 mb-4">
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <p class="text-xs text-amber-700 font-medium">Bank</p>
                                <p class="font-bold text-amber-900">BCA</p>
                            </div>
                            <div>
                                <p class="text-xs text-amber-700 font-medium">Atas Nama</p>
                                <p class="font-bold text-amber-900">Ulil Amri</p>
                            </div>
                            <div class="col-span-2">
                                <p class="text-xs text-amber-700 font-medium">No. Rekening</p>
                                <div class="flex items-center gap-2 mt-0.5">
                                    <p class="text-xl font-black text-amber-900 tracking-widest">1234567890</p>
                                    <button type="button" class="text-amber-600 hover:text-amber-800" title="Salin Rekening">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <ul class="text-xs text-amber-700 font-medium space-y-1">
                        <li>&bull; Reservasi akan dikonfirmasi otomatis/manual setelah pembayaran diverifikasi.</li>
                        <li>&bull; Harap simpan bukti transfer Anda dengan baik.</li>
                    </ul>
                </div>
            </div>
            @endif

            @if(!in_array($reservasi->status, ['dibatalkan', 'selesai']))
                <div class="mt-8 pt-6 border-t border-slate-100 flex justify-end">
                    <form action="{{ route('pelanggan.reservasi.batalkan', $reservasi->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin membatalkan reservasi ini? Tindakan ini tidak dapat diurungkan.');">
                        @csrf
                        <button type="submit" class="inline-flex items-center px-5 py-2.5 rounded-xl text-sm font-bold text-rose-700 bg-rose-50 hover:bg-rose-100 border border-rose-200 transition-colors">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            Batalkan Reservasi
                        </button>
                    </form>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

