@extends('tata_letak.admin')
@section('judul', 'Dashboard Admin')

@section('konten')
{{-- Stat Cards Grid --}}
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    {{-- Total Lapangan --}}
    <div class="bg-white rounded-3xl border border-slate-200/80 p-6 shadow-sm hover:shadow-md transition-all duration-200 flex items-center justify-between">
        <div>
            <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1.5">Total Lapangan</p>
            <p class="text-3xl font-black text-slate-900 tracking-tight">{{ $totalLapangan }}</p>
            <span class="inline-flex items-center px-2 py-0.5 rounded-md text-[10px] font-bold bg-emerald-50 text-emerald-700 mt-2 border border-emerald-100">
                {{ $lapanganAktif }} Aktif
            </span>
        </div>
        <div class="h-12 w-12 bg-indigo-50 text-indigo-600 rounded-2xl flex items-center justify-center shadow-sm">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 21v-4.875c0-.621.504-1.125 1.125-1.125h5.25c.621 0 1.125.504 1.125 1.125V21m0 0h4.5V3.545M21 21h-1.5V3.545m0 0a1.125 1.125 0 011.125-1.125H3.375A1.125 1.125 0 012.25 3.545V21h1.5V3.545M19.5 21H18m-12 0h1.5v-9a1.125 1.125 0 011.125-1.125h2.25A1.125 1.125 0 0112 12v9h1.5m-9 0H3"/>
            </svg>
        </div>
    </div>

    {{-- Total Pelanggan --}}
    <div class="bg-white rounded-3xl border border-slate-200/80 p-6 shadow-sm hover:shadow-md transition-all duration-200 flex items-center justify-between">
        <div>
            <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1.5">Total Pelanggan</p>
            <p class="text-3xl font-black text-slate-900 tracking-tight">{{ $totalPelanggan }}</p>
            <p class="text-[11px] font-semibold text-slate-400 mt-2">Pengguna terdaftar</p>
        </div>
        <div class="h-12 w-12 bg-emerald-50 text-emerald-600 rounded-2xl flex items-center justify-center shadow-sm">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.109A11.978 11.978 0 0112.25 18c-2.01-.268-3.8-.914-5.285-1.857M17 6a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5-3a3 3 0 11-6 0 3 3 0 016 0zm-3 9a3.75 3.75 0 00-3 3.75v.75c0 .34.02.67.06.996h6.88a4.5 4.5 0 01-.137-1.17V15z"/>
            </svg>
        </div>
    </div>

    {{-- Pendapatan Hari Ini --}}
    <div class="bg-white rounded-3xl border border-slate-200/80 p-6 shadow-sm hover:shadow-md transition-all duration-200 flex items-center justify-between">
        <div>
            <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1.5">Pendapatan Hari Ini</p>
            <p class="text-2xl font-black text-slate-900 tracking-tight leading-none">Rp {{ number_format($pendapatanHariIni, 0, ',', '.') }}</p>
            <p class="text-[11px] font-bold text-slate-400 mt-2.5">{{ date('d M Y') }}</p>
        </div>
        <div class="h-12 w-12 bg-amber-50 text-amber-600 rounded-2xl flex items-center justify-center shadow-sm">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818l.214.123a3.408 3.408 0 004.572 0l.214-.123M6.75 12h10.5m-10.5 3h10.5M6.75 9h10.5"/>
            </svg>
        </div>
    </div>

    {{-- Pendapatan Bulan Ini --}}
    <div class="bg-gradient-to-br from-indigo-600 to-indigo-800 rounded-3xl p-6 shadow-lg shadow-indigo-500/20 flex items-center justify-between">
        <div>
            <p class="text-xs font-bold text-indigo-200 uppercase tracking-wider mb-1.5">Pendapatan Bulan Ini</p>
            <p class="text-2xl font-black text-white tracking-tight leading-none">Rp {{ number_format($pendapatanBulanIni, 0, ',', '.') }}</p>
            <p class="text-[11px] font-bold text-indigo-200 mt-2.5">{{ date('F Y') }}</p>
        </div>
        <div class="h-12 w-12 bg-white/10 text-white rounded-2xl flex items-center justify-center shadow-sm">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5h16.5M4.5 19.5h15m-15-3h15m-15-3h15m-15-3h15m-15-3h15"/>
            </svg>
        </div>
    </div>
</div>

{{-- Two-column Layout for Pending and Schedule --}}
<div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
    {{-- Pending Approvals --}}
    <div class="bg-white rounded-3xl border border-slate-200/80 shadow-sm overflow-hidden flex flex-col">
        <div class="px-6 py-5 border-b border-slate-100 flex items-center justify-between bg-slate-50/50">
            <div>
                <h3 class="text-base font-bold text-slate-800">Menunggu Konfirmasi</h3>
                <p class="text-xs text-slate-400 mt-1 font-medium">{{ $reservasiPending->count() }} pemesanan belum disetujui</p>
            </div>
            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-amber-50 text-amber-700 border border-amber-200/50">
                {{ $reservasiPending->count() }} Pending
            </span>
        </div>

        <div class="flex-grow">
            @if($reservasiPending->isEmpty())
                <div class="p-12 text-center flex flex-col items-center justify-center">
                    <div class="w-16 h-16 bg-slate-50 text-slate-300 rounded-full flex items-center justify-center mb-4">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <p class="text-sm font-semibold text-slate-600">Semua Beres!</p>
                    <p class="text-xs text-slate-400 mt-1">Tidak ada reservasi yang menunggu konfirmasi.</p>
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-100">
                        <thead class="bg-slate-50/30">
                            <tr>
                                <th scope="col" class="px-6 py-3.5 text-left text-xs font-bold text-slate-400 uppercase tracking-wider">Pemesan</th>
                                <th scope="col" class="px-6 py-3.5 text-left text-xs font-bold text-slate-400 uppercase tracking-wider">Lapangan & Waktu</th>
                                <th scope="col" class="px-6 py-3.5 text-left text-xs font-bold text-slate-400 uppercase tracking-wider">Total</th>
                                <th scope="col" class="px-6 py-3.5 class text-right text-xs font-bold text-slate-400 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 bg-white">
                            @foreach($reservasiPending as $r)
                                <tr class="hover:bg-slate-50/50 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center gap-3">
                                            <div class="w-8 h-8 rounded-full bg-slate-100 text-slate-700 flex items-center justify-center text-xs font-black">
                                                {{ substr($r->pengguna->nama, 0, 1) }}
                                            </div>
                                            <div>
                                                <p class="text-sm font-bold text-slate-800">{{ $r->pengguna->nama }}</p>
                                                <p class="text-[10px] text-slate-400 font-medium">ID #{{ $r->id }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <p class="text-sm font-bold text-slate-800">{{ $r->lapangan->nama_lapangan }}</p>
                                        <p class="text-xs text-slate-500 font-semibold mt-0.5">{{ $r->tanggal->format('d/m/Y') }} &bull; {{ substr($r->jam_mulai, 0, 5) }} - {{ substr($r->jam_selesai, 0, 5) }}</p>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="text-sm font-extrabold text-indigo-600">{{ $r->total_harga_terformat }}</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-xs font-bold">
                                        <div class="flex items-center justify-end gap-2">
                                            <a href="{{ route('admin.reservasi.detail', $r->id) }}" class="px-3 py-1.5 rounded-lg bg-slate-100 text-slate-600 hover:bg-slate-200 transition-colors">Detail</a>
                                            <form action="{{ route('admin.reservasi.konfirmasi', $r->id) }}" method="POST" class="inline">
                                                @csrf
                                                <button type="submit" class="px-3 py-1.5 rounded-lg bg-emerald-500 text-white hover:bg-emerald-600 transition-colors shadow-sm shadow-emerald-500/20">Setujui</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>

    {{-- Today's Schedule --}}
    <div class="bg-white rounded-3xl border border-slate-200/80 shadow-sm overflow-hidden flex flex-col">
        <div class="px-6 py-5 border-b border-slate-100 flex items-center justify-between bg-slate-50/50">
            <div>
                <h3 class="text-base font-bold text-slate-800">Jadwal Hari Ini</h3>
                <p class="text-xs text-slate-400 mt-1 font-medium">{{ $reservasiHariIni->count() }} pertandingan terdaftar</p>
            </div>
            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-indigo-50 text-indigo-700 border border-indigo-200/50">
                {{ date('d M Y') }}
            </span>
        </div>

        <div class="flex-grow">
            @if($reservasiHariIni->isEmpty())
                <div class="p-12 text-center flex flex-col items-center justify-center">
                    <div class="w-16 h-16 bg-slate-50 text-slate-300 rounded-full flex items-center justify-center mb-4">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5m-9-6h.008v.008H12v-.008z"/>
                        </svg>
                    </div>
                    <p class="text-sm font-semibold text-slate-600">Sepi Hari Ini</p>
                    <p class="text-xs text-slate-400 mt-1">Belum ada pertandingan terjadwal untuk hari ini.</p>
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-100">
                        <thead class="bg-slate-50/30">
                            <tr>
                                <th scope="col" class="px-6 py-3.5 text-left text-xs font-bold text-slate-400 uppercase tracking-wider">Pelanggan</th>
                                <th scope="col" class="px-6 py-3.5 text-left text-xs font-bold text-slate-400 uppercase tracking-wider">Lapangan</th>
                                <th scope="col" class="px-6 py-3.5 text-left text-xs font-bold text-slate-400 uppercase tracking-wider">Waktu</th>
                                <th scope="col" class="px-6 py-3.5 text-center text-xs font-bold text-slate-400 uppercase tracking-wider">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 bg-white">
                            @foreach($reservasiHariIni as $r)
                                <tr class="hover:bg-slate-50/50 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center gap-3">
                                            <div class="w-8 h-8 rounded-full bg-slate-100 text-slate-700 flex items-center justify-center text-xs font-black">
                                                {{ substr($r->pengguna->nama, 0, 1) }}
                                            </div>
                                            <span class="text-sm font-bold text-slate-800">{{ $r->pengguna->nama }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-slate-800">
                                        {{ $r->lapangan->nama_lapangan }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-indigo-600">
                                        {{ substr($r->jam_mulai, 0, 5) }} - {{ substr($r->jam_selesai, 0, 5) }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        @php
                                            $badgeCls = 'bg-amber-50 text-amber-700 border-amber-200/50';
                                            if ($r->status == 'dikonfirmasi') $badgeCls = 'bg-emerald-50 text-emerald-700 border-emerald-200/50';
                                            elseif ($r->status == 'selesai') $badgeCls = 'bg-indigo-50 text-indigo-700 border-indigo-200/50';
                                            elseif ($r->status == 'dibatalkan') $badgeCls = 'bg-rose-50 text-rose-700 border-rose-200/50';
                                        @endphp
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold border {{ $badgeCls }}">
                                            {{ $r->label_status }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
