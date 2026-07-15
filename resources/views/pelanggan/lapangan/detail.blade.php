@extends('tata_letak.pelanggan')
@section('judul', $lapangan->nama_lapangan . ' - Footsal Arena')

@section('konten')
    <div class="mb-6">
        <a href="{{ route('pelanggan.lapangan.index') }}"
            class="inline-flex items-center text-sm font-semibold text-slate-500 hover:text-indigo-600 transition-colors group">
            <svg class="w-4 h-4 mr-1.5 group-hover:-translate-x-0.5 transition-transform" fill="none" stroke="currentColor"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Kembali ke Daftar Lapangan
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        {{-- Bagian Kiri: Detail Lapangan --}}
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden">
                {{-- Foto Placeholder --}}
                <div
                    class="h-64 sm:h-80 w-full bg-gradient-to-br from-indigo-50 to-blue-50 flex items-center justify-center border-b border-slate-100">
                    @if($lapangan->foto)
                        <img src="{{ asset('storage/' . $lapangan->foto) }}" alt="{{ $lapangan->nama_lapangan }}"
                            class="w-full h-full object-cover">
                    @else
                        <svg class="w-24 h-24 text-indigo-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                            </path>
                        </svg>
                    @endif
                </div>

                <div class="p-6 sm:p-8">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-3xl font-black text-slate-900 tracking-tight">{{ $lapangan->nama_lapangan }}</h2>
                        @if($lapangan->status === 'aktif')
                            <span
                                class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                <span class="w-2 h-2 rounded-full bg-emerald-500 mr-2 animate-pulse"></span>Tersedia
                            </span>
                        @else
                            <span
                                class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-rose-50 text-rose-700 border border-rose-200">Sedang
                                Perbaikan</span>
                        @endif
                    </div>

                    <p class="text-slate-600 font-medium leading-relaxed mb-6">{{ $lapangan->deskripsi }}</p>

                    @if($lapangan->fasilitas)
                        <div class="pt-6 border-t border-slate-100">
                            <h4 class="text-sm font-bold text-slate-900 uppercase tracking-wider mb-4">Fasilitas Tersedia</h4>
                            <div class="flex flex-wrap gap-2">
                                @foreach($lapangan->fasilitas as $f)
                                    <span
                                        class="inline-flex items-center px-3 py-1.5 rounded-xl text-sm font-semibold bg-slate-100 text-slate-700 border border-slate-200">
                                        <svg class="w-4 h-4 mr-2 text-indigo-500" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                                d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        {{ $f }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- Bagian Kanan: Modul Pemesanan (Sticky) --}}
        <div class="lg:col-span-1">
            <div
                class="bg-white rounded-3xl border border-slate-200 shadow-xl shadow-indigo-500/5 sticky top-28 overflow-hidden">
                <div class="p-6 bg-slate-50 border-b border-slate-100 flex items-end justify-between">
                    <div>
                        <p class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-1">Tarif Sewa</p>
                        <p class="text-2xl font-black text-indigo-600">{{ $lapangan->harga_terformat }} <span
                                class="text-sm font-medium text-slate-400">/ jam</span></p>
                    </div>
                </div>

                <div class="p-6">
                    <form method="GET" action="{{ route('pelanggan.lapangan.detail', $lapangan->id) }}" class="mb-6">
                        <label for="tanggal" class="block text-sm font-bold text-slate-700 mb-2">Pilih Tanggal
                            Bermain</label>
                        <div class="flex gap-2">
                            <input type="date" name="tanggal" id="tanggal" value="{{ $tanggal }}" min="{{ date('Y-m-d') }}"
                                class="block w-full px-4 py-3 rounded-xl border-slate-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm font-semibold text-slate-700 bg-slate-50">
                            <button type="submit"
                                class="px-4 py-3 rounded-xl text-sm font-bold text-white bg-slate-800 hover:bg-slate-900 transition-colors">
                                Cek
                            </button>
                        </div>
                    </form>

                    <h3 class="text-sm font-bold text-slate-900 mb-4 border-b border-slate-100 pb-2">Jadwal:
                        {{ \Carbon\Carbon::parse($tanggal)->translatedFormat('l, d F Y') }}</h3>

                    <div class="space-y-3 max-h-[400px] overflow-y-auto pr-2 custom-scrollbar">
                        @foreach($slotTersedia as $slot)
                            <div
                                class="flex items-center justify-between p-3 rounded-2xl border transition-all {{ $slot['tersedia'] ? 'border-indigo-100 bg-white hover:border-indigo-300 hover:shadow-md' : 'border-slate-100 bg-slate-50 opacity-75' }}">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="px-3 py-1.5 rounded-lg text-sm font-bold {{ $slot['tersedia'] ? 'bg-indigo-50 text-indigo-700' : 'bg-slate-200 text-slate-500' }}">
                                        {{ substr($slot['jam_mulai'], 0, 5) }}
                                    </div>
                                    <span
                                        class="text-sm font-medium {{ $slot['tersedia'] ? 'text-slate-700' : 'text-slate-400 line-through' }}">
                                        {{ $slot['tersedia'] ? 'Tersedia' : 'Terpesan' }}
                                    </span>
                                </div>

                                @if($slot['tersedia'])
                                    <form action="{{ route('pelanggan.reservasi.simpan') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="lapangan_id" value="{{ $lapangan->id }}">
                                        <input type="hidden" name="tanggal" value="{{ $tanggal }}">
                                        <input type="hidden" name="jam_mulai" value="{{ $slot['jam_mulai'] }}">
                                        <input type="hidden" name="jam_selesai" value="{{ $slot['jam_selesai'] }}">
                                        <button type="submit"
                                            class="px-4 py-2 rounded-xl text-xs font-bold text-white bg-indigo-600 hover:bg-indigo-700 shadow-sm shadow-indigo-500/30 transition-all hover:-translate-y-0.5">
                                            Pesan
                                        </button>
                                    </form>
                                @else
                                    <div
                                        class="px-4 py-2 rounded-xl text-xs font-bold text-slate-400 bg-slate-100 cursor-not-allowed">
                                        Penuh
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>

                    @if(count($slotTersedia) == 0)
                        <div class="text-center py-6">
                            <p class="text-sm text-slate-500 font-medium">Tidak ada jadwal tersedia pada tanggal ini.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Custom Scrollbar for schedule list */
        .custom-scrollbar::-webkit-scrollbar {
            width: 4px;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: transparent;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background-color: #cbd5e1;
            border-radius: 20px;
        }
    </style>
@endsection