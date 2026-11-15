@extends('layouts.app')

@section('title', 'Cek Status Booking - Noona Salon')

@section('content')
<div class="max-w-xl mx-auto px-4 py-14">
    <div class="bg-white p-8 rounded-3xl shadow-sm border border-noona-blush">
        <div class="text-center mb-6">
            <h1 class="font-serif text-3xl font-bold text-noona-dark">Cek Status Reservasi</h1>
            <p class="text-sm text-noona-muted mt-2">Masukkan kode booking Anda (contoh: NNA-20261115-XXXX)</p>
        </div>

        <form action="{{ route('reservasi.cek') }}" method="GET" class="flex gap-2">
            <input type="text" name="kode" value="{{ request('kode') }}" placeholder="Masukkan kode booking..." required
                class="flex-1 px-4 py-3 rounded-xl border border-gray-300 focus:border-noona-rose outline-none uppercase">
            <button type="submit" class="bg-noona-rose hover:bg-noona-dark text-white font-semibold px-6 py-3 rounded-xl transition">
                Cari
            </button>
        </form>

        @if($reservasi)
            <div class="mt-8 pt-6 border-t border-gray-100 space-y-3 text-sm">
                <div class="flex justify-between items-center">
                    <span class="font-bold text-base">{{ $reservasi->kode }}</span>
                    <span class="px-3 py-1 rounded-full text-xs font-bold bg-noona-blush text-noona-dark">{{ $reservasi->status }}</span>
                </div>
                <p><span class="text-noona-muted">Pelanggan:</span> <strong>{{ $reservasi->nama_pelanggan }}</strong></p>
                <p><span class="text-noona-muted">Layanan:</span> <strong>{{ $reservasi->layanan->nama }}</strong></p>
                <p><span class="text-noona-muted">Stylist:</span> <strong>{{ $reservasi->stylist->nama }}</strong></p>
                <p><span class="text-noona-muted">Jadwal:</span> <strong>{{ $reservasi->tanggal }} ({{ substr($reservasi->jam_mulai, 0, 5) }} - {{ substr($reservasi->jam_selesai, 0, 5) }})</strong></p>
            </div>
        @endif
    </div>
</div>
@endsection