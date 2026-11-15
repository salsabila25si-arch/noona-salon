@extends('layouts.admin')

@section('title', 'Data Stylist - Admin')
@section('header', 'Data Stylist')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <p class="text-sm text-noona-muted">Kelola daftar stylist dan spesialisasi masing-masing.</p>
    <a href="{{ route('admin.stylist.create') }}" class="bg-noona-rose hover:bg-noona-dark text-white text-sm font-semibold px-5 py-2.5 rounded-xl transition">
        + Tambah Stylist
    </a>
</div>

<div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left">
            <thead class="bg-gray-50 text-noona-muted font-semibold">
                <tr>
                    <th class="px-6 py-3.5">Foto</th>
                    <th class="px-6 py-3.5">Nama Stylist</th>
                    <th class="px-6 py-3.5">Spesialisasi</th>
                    <th class="px-6 py-3.5 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($stylists as $stylist)
                    <tr>
                        <td class="px-6 py-3.5">
                            @if($stylist->foto)
                                <img src="{{ asset('storage/' . $stylist->foto) }}" class="w-12 h-12 rounded-full object-cover">
                            @else
                                <div class="w-12 h-12 rounded-full bg-noona-blush text-noona-rose font-bold flex items-center justify-center">
                                    {{ strtoupper(substr($stylist->nama, 0, 1)) }}
                                </div>
                            @endif
                        </td>
                        <td class="px-6 py-3.5 font-semibold">{{ $stylist->nama }}</td>
                        <td class="px-6 py-3.5">{{ $stylist->spesialisasi }}</td>
                        <td class="px-6 py-3.5 text-right space-x-2">
                            <a href="{{ route('admin.stylist.edit', $stylist) }}" class="text-blue-600 hover:underline font-medium">Edit</a>
                            <form action="{{ route('admin.stylist.destroy', $stylist) }}" method="POST" class="inline" onsubmit="return confirm('Hapus data stylist ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline font-medium">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-8 text-center text-noona-muted">Belum ada data stylist.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection