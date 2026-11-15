@extends('layouts.admin')

@section('title', 'Tambah Kategori - Admin')
@section('header', 'Tambah Kategori Layanan')

@section('content')
<div class="bg-white p-6 rounded-2xl border border-gray-200 shadow-sm max-w-lg">
    <form action="{{ route('admin.kategori.store') }}" method="POST" class="space-y-4">
        @csrf
        <div>
            <label class="block text-sm font-medium mb-1.5">Nama Kategori</label>
            <input type="text" name="nama" value="{{ old('nama') }}" placeholder="Contoh: Haircut & Styling" required
                class="w-full px-4 py-2.5 rounded-xl border border-gray-300 focus:border-noona-rose outline-none">
        </div>

        <div class="flex items-center gap-3 pt-2">
            <button type="submit" class="bg-noona-rose hover:bg-noona-dark text-white text-sm font-semibold px-6 py-2.5 rounded-xl transition">
                Simpan
            </button>
            <a href="{{ route('admin.kategori.index') }}" class="text-sm text-noona-muted hover:text-noona-dark">Batal</a>
        </div>
    </form>
</div>
@endsection