@extends('layouts.admin')

@section('title', 'Kategori Layanan - Admin')
@section('header', 'Kategori Layanan')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <p class="text-sm text-noona-muted">Kelola pengelompokan layanan perawatan salon.</p>
    <a href="{{ route('admin.kategori.create') }}" class="bg-noona-rose hover:bg-noona-dark text-white text-sm font-semibold px-5 py-2.5 rounded-xl transition">
        + Tambah Kategori
    </a>
</div>

<div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden max-w-3xl">
    <table class="w-full text-sm text-left">
        <thead class="bg-gray-50 text-noona-muted font-semibold">
            <tr>
                <th class="px-6 py-3.5 w-16">No</th>
                <th class="px-6 py-3.5">Nama Kategori</th>
                <th class="px-6 py-3.5">Jumlah Layanan</th>
                <th class="px-6 py-3.5 text-right">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($kategoris as $index => $kategori)
                <tr>
                    <td class="px-6 py-4">{{ $index + 1 }}</td>
                    <td class="px-6 py-4 font-semibold">{{ $kategori->nama }}</td>
                    <td class="px-6 py-4">{{ $kategori->layanans_count }} layanan</td>
                    <td class="px-6 py-4 text-right space-x-2">
                        <a href="{{ route('admin.kategori.edit', $kategori) }}" class="text-blue-600 hover:underline font-medium">Edit</a>
                        <form action="{{ route('admin.kategori.destroy', $kategori) }}" method="POST" class="inline" onsubmit="return confirm('Hapus kategori ini? Semua layanan di dalamnya juga akan terhapus.')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline font-medium">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="px-6 py-8 text-center text-noona-muted">Belum ada data kategori.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection