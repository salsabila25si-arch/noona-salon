@extends('layouts.app')

@section('title', 'Buat Reservasi - Noona Salon')

@section('content')
<div class="max-w-2xl mx-auto px-4 py-12">
    <div class="bg-white p-8 rounded-3xl shadow-sm border border-noona-blush">
        <div class="text-center mb-8">
            <h1 class="font-serif text-3xl font-bold text-noona-dark">Reservasi Jadwal</h1>
            <p class="text-sm text-noona-muted mt-2">Pilih layanan, stylist, dan waktu kunjungan yang Anda inginkan.</p>
        </div>

        @if($errors->any())
            <div class="mb-6 bg-red-50 border border-red-200 text-red-700 text-sm px-4 py-3 rounded-xl">
                <ul class="list-disc list-inside space-y-1">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('reservasi.store') }}" method="POST" class="space-y-5">
            @csrf

            <div>
                <label class="block text-sm font-medium mb-1.5">Pilih Layanan</label>
                <select name="layanan_id" required class="w-full px-4 py-2.5 rounded-xl border border-gray-300 focus:border-noona-rose focus:ring-2 focus:ring-noona-blush outline-none">
                    <option value="">-- Pilih Layanan --</option>
                    @foreach($layanans as $layanan)
                        <option value="{{ $layanan->id }}" {{ old('layanan_id', $selectedLayananId) == $layanan->id ? 'selected' : '' }}>
                            {{ $layanan->nama }} - Rp {{ number_format($layanan->harga, 0, ',', '.') }} ({{ $layanan->durasi_menit }} mnt)
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium mb-1.5">Pilih Stylist</label>
                <select name="stylist_id" required class="w-full px-4 py-2.5 rounded-xl border border-gray-300 focus:border-noona-rose focus:ring-2 focus:ring-noona-blush outline-none">
                    <option value="">-- Pilih Stylist --</option>
                    @foreach($stylists as $stylist)
                        <option value="{{ $stylist->id }}" {{ old('stylist_id') == $stylist->id ? 'selected' : '' }}>
                            {{ $stylist->nama }} ({{ $stylist->spesialisasi }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium mb-1.5">Nama Lengkap</label>
                    <input type="text" name="nama_pelanggan" value="{{ old('nama_pelanggan', auth()->user()->nama ?? '') }}" required
                        class="w-full px-4 py-2.5 rounded-xl border border-gray-300 focus:border-noona-rose focus:ring-2 focus:ring-noona-blush outline-none">
                </div>

                <div>
                    <label class="block text-sm font-medium mb-1.5">Nomor HP / WhatsApp</label>
                    <input type="text" name="no_hp" value="{{ old('no_hp', auth()->user()->no_hp ?? '') }}" required
                        class="w-full px-4 py-2.5 rounded-xl border border-gray-300 focus:border-noona-rose focus:ring-2 focus:ring-noona-blush outline-none">
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium mb-1.5">Tanggal Kunjungan</label>
                    <input type="date" name="tanggal" min="{{ date('Y-m-d') }}" value="{{ old('tanggal', date('Y-m-d')) }}" required
                        class="w-full px-4 py-2.5 rounded-xl border border-gray-300 focus:border-noona-rose focus:ring-2 focus:ring-noona-blush outline-none">
                </div>

                <div>
                    <label class="block text-sm font-medium mb-1.5">Jam Mulai</label>
                    <input type="time" name="jam_mulai" min="09:00" max="20:00" value="{{ old('jam_mulai', '10:00') }}" required
                        class="w-full px-4 py-2.5 rounded-xl border border-gray-300 focus:border-noona-rose focus:ring-2 focus:ring-noona-blush outline-none">
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium mb-1.5">Catatan Tambahan (Opsional)</label>
                <textarea name="catatan" rows="3" placeholder="Contoh: Rambut sebahu, ingin warna ash brown..."
                    class="w-full px-4 py-2.5 rounded-xl border border-gray-300 focus:border-noona-rose focus:ring-2 focus:ring-noona-blush outline-none">{{ old('catatan') }}</textarea>
            </div>

            <button type="submit" class="w-full bg-noona-rose hover:bg-noona-dark text-white font-semibold py-3.5 rounded-xl transition shadow-sm">
                Konfirmasi Reservasi
            </button>
        </form>
    </div>
</div>
@endsection