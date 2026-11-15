@extends('layouts.admin')

@section('title', 'Daftar Layanan - Admin')
@section('header', 'Daftar Layanan Salon')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <p class="text-sm text-noona-muted">Kelola daftar treatment, harga, dan durasi pengerjaan.</p>
    <a href="{{ route('admin.layanan.create') }}" class="bg-noona-rose hover:bg-noona-dark text-white text-sm font-semibold px-5 py-2.5 rounded-xl transition">
        + Tambah Layanan
    </a>
</div>

<div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left">
            <thead class="bg-gray-50 text-noona-muted font-semibold">
                <tr>
                    <th class="px-6 py-3.5">Foto</th>
                    <th class="px-6 py-3.5">Nama Layanan</th>
                    <th class="px-6 py-3.5">Kategori</th>
                    <th class="px-6 py-3.5">Harga</th>
                    <th class="px-6 py-3.5">Durasi</th>
                    <th class="px-6 py-3.5 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($layanans as $layanan)
                    <tr>
                        <td class="px-6 py-3.5">
                            @if($layanan->foto)
                                <img src="{{ asset('storage/' . $layanan->foto) }}" class="w-14 h-14 rounded-xl object-cover">
                            @else
                                <div class="w-14 h-14 rounded-xl bg-noona-blush flex items-center justify-center text-xs text-noona-rose font-semibold">No Img</div>
                            @endif
                        </td>
                        <td class="px-6 py-3.5 font-semibold">{{ $layanan->nama }}</td>
                        <td class="px-6 py-3.5">{{ $layanan->kategori->nama ?? '-' }}</td>
                        <td class="px-6 py-3.5 font-semibold text-noona-rose">Rp {{ number_format($layanan->harga, 0, ',', '.') }}</td>
                        <td class="px-6 py-3.5">{{ $layanan->durasi_menit }} menit</td>
                        <td class="px-6 py-3.5 text-right space-x-2">
                            <a href="{{ route('admin.layanan.edit', $layanan) }}" class="text-blue-600 hover:underline font-medium">Edit</a>
                            <form action="{{ route('admin.layanan.destroy', $layanan) }}" method="POST" class="inline" onsubmit="return confirm('Hapus layanan ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline font-medium">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-8 text-center text-noona-muted">Belum ada data layanan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection