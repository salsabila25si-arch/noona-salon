@extends('layouts.admin')

@section('title', 'Dashboard Admin - Noona Salon')
@section('header', 'Dashboard Overview')

@section('content')
<!-- Statistik Cards -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4 mb-8">
    <div class="bg-white p-5 rounded-2xl border border-gray-200 shadow-sm">
        <p class="text-xs font-medium text-noona-muted">Reservasi Menunggu</p>
        <p class="text-2xl font-bold text-amber-600 mt-1">{{ $reservasiMenunggu }}</p>
    </div>

    <div class="bg-white p-5 rounded-2xl border border-gray-200 shadow-sm">
        <p class="text-xs font-medium text-noona-muted">Total Layanan</p>
        <p class="text-2xl font-bold text-noona-dark mt-1">{{ $totalLayanan }}</p>
    </div>

    <div class="bg-white p-5 rounded-2xl border border-gray-200 shadow-sm">
        <p class="text-xs font-medium text-noona-muted">Total Stylist</p>
        <p class="text-2xl font-bold text-noona-dark mt-1">{{ $totalStylist }}</p>
    </div>

    <div class="bg-white p-5 rounded-2xl border border-gray-200 shadow-sm">
        <p class="text-xs font-medium text-noona-muted">Pelanggan Terdaftar</p>
        <p class="text-2xl font-bold text-noona-dark mt-1">{{ $totalPelanggan }}</p>
    </div>

    <div class="bg-white p-5 rounded-2xl border border-gray-200 shadow-sm">
        <p class="text-xs font-medium text-noona-muted">Pendapatan Selesai</p>
        <p class="text-xl font-bold text-emerald-600 mt-1">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</p>
    </div>
</div>

<!-- Jadwal Hari Ini -->
<div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
        <h2 class="font-bold text-noona-dark">Jadwal Reservasi Hari Ini ({{ now()->translatedFormat('d M Y') }})</h2>
        <a href="{{ route('admin.reservasi.index') }}" class="text-xs font-semibold text-noona-rose hover:underline">
            Kelola Semua Reservasi →
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left">
            <thead class="bg-gray-50 text-noona-muted font-semibold">
                <tr>
                    <th class="px-6 py-3">Jam</th>
                    <th class="px-6 py-3">Kode</th>
                    <th class="px-6 py-3">Pelanggan</th>
                    <th class="px-6 py-3">Layanan</th>
                    <th class="px-6 py-3">Stylist</th>
                    <th class="px-6 py-3">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($reservasiHariIni as $item)
                    <tr>
                        <td class="px-6 py-3.5 font-semibold">{{ substr($item->jam_mulai, 0, 5) }} - {{ substr($item->jam_selesai, 0, 5) }}</td>
                        <td class="px-6 py-3.5 font-mono text-xs">{{ $item->kode }}</td>
                        <td class="px-6 py-3.5">
                            {{ $item->nama_pelanggan }}<br>
                            <span class="text-xs text-noona-muted">{{ $item->no_hp }}</span>
                        </td>
                        <td class="px-6 py-3.5">{{ $item->layanan->nama }}</td>
                        <td class="px-6 py-3.5">{{ $item->stylist->nama }}</td>
                        <td class="px-6 py-3.5">
                            <span class="px-3 py-1 rounded-full text-xs font-semibold bg-noona-blush text-noona-dark">
                                {{ $item->status }}
                            </span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-8 text-center text-noona-muted">Tidak ada jadwal reservasi untuk hari ini.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection