@extends('tata_letak.pelanggan')
@section('judul', 'Reservasi Saya - Footsal Arena')

@section('konten')
<div class="mb-8">
    <h2 class="text-3xl font-black text-slate-900 tracking-tight">Reservasi Saya</h2>
    <p class="mt-2 text-slate-500 font-medium">Riwayat dan status pemesanan lapangan Anda.</p>
</div>

@if($reservasi->isEmpty())
    <div class="bg-white rounded-2xl border border-slate-200 p-12 text-center shadow-sm">
        <svg class="mx-auto h-16 w-16 text-slate-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
        <h3 class="text-lg font-bold text-slate-900 mb-1">Belum Ada Reservasi</h3>
        <p class="text-slate-500 font-medium mb-6">Anda belum pernah melakukan pemesanan lapangan. Yuk mulai bermain!</p>
        <a href="{{ route('pelanggan.lapangan.index') }}" class="inline-flex items-center px-6 py-3 border border-transparent rounded-full shadow-sm text-sm font-bold text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
            Cari Lapangan Sekarang
        </a>
    </div>
@else
    <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-sm">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-200">
                <thead class="bg-slate-50">
                    <tr>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">No</th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Lapangan</th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Jadwal</th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Total</th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Status</th>
                        <th scope="col" class="px-6 py-4 text-right text-xs font-bold text-slate-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-slate-200">
                    @foreach($reservasi as $i => $r)
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-slate-900">
                                {{ $i + 1 }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-bold text-slate-900">{{ $r->lapangan->nama_lapangan }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-slate-900">{{ $r->tanggal->format('d/m/Y') }}</div>
                                <div class="text-xs text-slate-500 mt-0.5">{{ $r->jam_mulai }} - {{ $r->jam_selesai }} ({{ $r->durasi }} jam)</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-indigo-600">
                                {{ $r->total_harga_terformat }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @php
                                    $badgeClass = 'bg-slate-100 text-slate-800';
                                    if ($r->status == 'pending') $badgeClass = 'bg-amber-50 text-amber-700 border border-amber-200/50';
                                    elseif ($r->status == 'dikonfirmasi') $badgeClass = 'bg-emerald-50 text-emerald-700 border border-emerald-200/50';
                                    elseif ($r->status == 'dibatalkan') $badgeClass = 'bg-rose-50 text-rose-700 border border-rose-200/50';
                                    elseif ($r->status == 'selesai') $badgeClass = 'bg-blue-50 text-blue-700 border border-blue-200/50';
                                @endphp
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold {{ $badgeClass }}">
                                    @if($r->status == 'pending')
                                        <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    @elseif($r->status == 'dikonfirmasi')
                                        <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    @elseif($r->status == 'dibatalkan')
                                        <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    @elseif($r->status == 'selesai')
                                        <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                    @endif
                                    {{ $r->label_status }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a href="{{ route('pelanggan.reservasi.detail', $r->id) }}" class="text-indigo-600 hover:text-indigo-900 bg-indigo-50 hover:bg-indigo-100 px-3 py-1.5 rounded-lg transition-colors">Lihat Detail</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endif
@endsection

