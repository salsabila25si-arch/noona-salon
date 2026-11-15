@extends('layouts.app')

@section('title', 'Riwayat Reservasi Saya - Noona Salon')

@section('content')
<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="font-serif text-3xl font-bold text-noona-dark">Riwayat Reservasi Saya</h1>
            <p class="text-sm text-noona-muted mt-1">Daftar seluruh jadwal perawatan Anda di Noona Salon</p>
        </div>
        <a href="{{ route('reservasi.create') }}" class="bg-noona-rose hover:bg-noona-dark text-white text-sm font-semibold px-5 py-2.5 rounded-full transition">
            + Booking Baru
        </a>
    </div>

    <div class="bg-white rounded-3xl shadow-sm border border-noona-blush overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="bg-noona-blush/50 text-noona-dark font-semibold">
                    <tr>
                        <th class="px-6 py-4">Kode</th>
                        <th class="px-6 py-4">Layanan</th>
                        <th class="px-6 py-4">Stylist</th>
                        <th class="px-6 py-4">Tanggal & Jam</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($reservasis as $item)
                        <tr>
                            <td class="px-6 py-4 font-bold">
                                <a href="{{ route('reservasi.show', $item->kode) }}" class="text-noona-rose hover:underline">
                                    {{ $item->kode }}
                                </a>
                            </td>
                            <td class="px-6 py-4">{{ $item->layanan->nama }}</td>
                            <td class="px-6 py-4">{{ $item->stylist->nama }}</td>
                            <td class="px-6 py-4">
                                {{ $item->tanggal }}<br>
                                <span class="text-xs text-noona-muted">{{ substr($item->jam_mulai, 0, 5) }} - {{ substr($item->jam_selesai, 0, 5) }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 rounded-full text-xs font-semibold bg-noona-blush text-noona-dark">
                                    {{ $item->status }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                @if($item->status === 'Menunggu')
                                    <form action="{{ route('reservasi.batal', $item->kode) }}" method="POST" onsubmit="return confirm('Batalkan reservasi ini?')">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="text-xs font-semibold text-red-600 hover:underline">
                                            Batalkan
                                        </button>
                                    </form>
                                @else
                                    <span class="text-xs text-gray-400">-</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-10 text-center text-noona-muted">
                                Anda belum memiliki riwayat reservasi.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection