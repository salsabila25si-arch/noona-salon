@extends('layouts.admin')

@section('title', 'Kelola Reservasi - Admin')
@section('header', 'Kelola Data Reservasi')

@section('content')
<!-- Filter -->
<div class="bg-white p-4 rounded-2xl border border-gray-200 shadow-sm mb-6">
    <form action="{{ route('admin.reservasi.index') }}" method="GET" class="flex flex-wrap items-end gap-4">
        <div>
            <label class="block text-xs font-medium text-noona-muted mb-1">Filter Status</label>
            <select name="status" class="px-3.5 py-2 rounded-xl border border-gray-300 text-sm outline-none">
                <option value="">Semua Status</option>
                @foreach(['Menunggu', 'Dikonfirmasi', 'Selesai', 'Batal'] as $st)
                    <option value="{{ $st }}" {{ request('status') === $st ? 'selected' : '' }}>{{ $st }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block text-xs font-medium text-noona-muted mb-1">Filter Tanggal</label>
            <input type="date" name="tanggal" value="{{ request('tanggal') }}" class="px-3.5 py-2 rounded-xl border border-gray-300 text-sm outline-none">
        </div>

        <div class="flex gap-2">
            <button type="submit" class="bg-noona-dark text-white text-sm font-semibold px-4 py-2 rounded-xl hover:bg-noona-rose transition">
                Terapkan
            </button>
            @if(request()->hasAny(['status', 'tanggal']))
                <a href="{{ route('admin.reservasi.index') }}" class="px-4 py-2 rounded-xl border border-gray-300 text-sm text-noona-muted hover:text-noona-dark">
                    Reset
                </a>
            @endif
        </div>
    </form>
</div>

<!-- Tabel Reservasi -->
<div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left">
            <thead class="bg-gray-50 text-noona-muted font-semibold">
                <tr>
                    <th class="px-5 py-3.5">Kode</th>
                    <th class="px-5 py-3.5">Pelanggan</th>
                    <th class="px-5 py-3.5">Layanan & Stylist</th>
                    <th class="px-5 py-3.5">Jadwal</th>
                    <th class="px-5 py-3.5">Ubah Status</th>
                    <th class="px-5 py-3.5 text-right">Hapus</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($reservasis as $item)
                    <tr>
                        <td class="px-5 py-4 font-mono text-xs font-bold">{{ $item->kode }}</td>
                        <td class="px-5 py-4">
                            <p class="font-semibold">{{ $item->nama_pelanggan }}</p>
                            <p class="text-xs text-noona-muted">{{ $item->no_hp }}</p>
                            @if($item->catatan)
                                <p class="text-xs text-noona-rose italic mt-1">"{{ $item->catatan }}"</p>
                            @endif
                        </td>
                        <td class="px-5 py-4">
                            <p class="font-medium">{{ $item->layanan->nama }}</p>
                            <p class="text-xs text-noona-muted">Stylist: {{ $item->stylist->nama }}</p>
                        </td>
                        <td class="px-5 py-4">
                            <p class="font-medium">{{ $item->tanggal }}</p>
                            <p class="text-xs text-noona-muted">{{ substr($item->jam_mulai, 0, 5) }} - {{ substr($item->jam_selesai, 0, 5) }} WIB</p>
                        </td>
                        <td class="px-5 py-4">
                            <form action="{{ route('admin.reservasi.status', $item) }}" method="POST" class="flex items-center gap-2">
                                @csrf
                                @method('PATCH')
                                <select name="status" onchange="this.form.submit()" class="px-3 py-1.5 rounded-xl border border-gray-300 text-xs font-semibold outline-none">
                                    @foreach(['Menunggu', 'Dikonfirmasi', 'Selesai', 'Batal'] as $st)
                                        <option value="{{ $st }}" {{ $item->status === $st ? 'selected' : '' }}>{{ $st }}</option>
                                    @endforeach
                                </select>
                            </form>
                        </td>
                        <td class="px-5 py-4 text-right">
                            <form action="{{ route('admin.reservasi.destroy', $item) }}" method="POST" onsubmit="return confirm('Hapus data reservasi ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-xs text-red-600 hover:underline font-medium">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-10 text-center text-noona-muted">Tidak ada data reservasi ditemukan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection