@extends('layouts.admin')

@section('title', 'Edit Kategori - Admin')
@section('header', 'Edit Kategori Layanan')

@section('content')
<div class="bg-white p-6 rounded-2xl border border-gray-200 shadow-sm max-w-lg">
    <form action="{{ route('admin.kategori.update', $kategori) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')
        <div>
            <label class="block text-sm font-medium mb-1.5">Nama Kategori</label>
            <input type="text" name="nama" value="{{ old('nama', $kategori->nama) }}" required
                class="w-full px-4 py-2.5 rounded-xl border border-gray-300 focus:border-noona-rose outline-none">
        </div>

        <div class="flex items-center gap-3 pt-2">
            <button type="submit" class="bg-noona-rose hover:bg-noona-dark text-white text-sm font-semibold px-6 py-2.5 rounded-xl transition">
                Perbarui
            </button>
            <a href="{{ route('admin.kategori.index') }}" class="text-sm text-noona-muted hover:text-noona-dark">Batal</a>
        </div>
    </form>
</div>
@endsection