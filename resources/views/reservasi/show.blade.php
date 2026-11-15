@extends('layouts.app')

@section('title', 'Detail Reservasi - Noona Salon')

@section('content')
<div class="max-w-xl mx-auto px-4 py-12">
    <div class="bg-white p-8 rounded-3xl shadow-sm border border-noona-blush">
        <div class="text-center border-b border-dashed border-gray-200 pb-6">
            <span class="text-xs font-bold uppercase tracking-widest text-noona-rose">Bukti Reservasi</span>
            <h1 class="font-serif text-3xl font-bold text-noona-dark mt-2">{{ $reservasi->kode }}</h1>
            <p class="text-xs text-noona-muted mt-1">Simpan kode ini untuk mengecek status reservasi Anda</p>

            <div class="mt-4">
                @php
                    $badgeColor = match($reservasi->status) {
                        'Menunggu' => 'bg-amber-100 text-amber-800',
                        'Dikonfirmasi' => 'bg-blue-100 text-blue-800',
                        'Selesai' => 'bg-emerald-100 text-emerald-800',
                        'Batal' => 'bg-red-100 text-red-800',
                    };
                @endphp
                <span class="px-4 py-1.5 rounded-full text-xs font-bold {{ $badgeColor }}">
                    Status: {{ $reservasi->status }}
                </span>
            </div>
        </div>

        <div class="py-6 space-y-3.5 text-sm">
            <div class="flex justify-between">
                <span class="text-noona-muted">Nama Pelanggan</span>
                <span class="font-semibold">{{ $reservasi->nama_pelanggan }}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-noona-muted">No. HP</span>
                <span class="font-semibold">{{ $reservasi->no_hp }}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-noona-muted">Layanan</span>
                <span class="font-semibold">{{ $reservasi->layanan->nama }}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-noona-muted">Stylist</span>
                <span class="font-semibold">{{ $reservasi->stylist->nama }}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-noona-muted">Tanggal</span>
                <span class="font-semibold">{{ \Carbon\Carbon::parse($reservasi->tanggal)->translatedFormat('d F Y') }}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-noona-muted">Waktu</span>
                <span class="font-semibold">{{ substr($reservasi->jam_mulai, 0, 5) }} – {{ substr($reservasi->jam_selesai, 0, 5) }} WIB</span>
            </div>
            <div class="flex justify-between border-t border-gray-100 pt-3">
                <span class="text-noona-muted">Estimasi Biaya</span>
                <span class="font-bold text-base text-noona-rose">Rp {{ number_format($reservasi->layanan->harga, 0, ',', '.') }}</span>
            </div>
            @if($reservasi->catatan)
                <div class="pt-2">
                    <span class="text-noona-muted block mb-1">Catatan:</span>
                    <p class="bg-noona-cream p-3 rounded-xl text-xs">{{ $reservasi->catatan }}</p>
                </div>
            @endif
        </div>

        <div class="pt-4 border-t border-gray-100 flex justify-between items-center">
            <a href="{{ route('home') }}" class="text-sm font-medium text-noona-muted hover:text-noona-dark">← Kembali ke Beranda</a>
            <a href="{{ route('reservasi.cek') }}" class="text-sm font-semibold text-noona-rose hover:underline">Cek Kode Lain</a>
        </div>
    </div>
</div>
@endsection