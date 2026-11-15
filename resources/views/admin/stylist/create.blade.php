@extends('layouts.admin')

@section('title', 'Tambah Stylist - Admin')
@section('header', 'Tambah Stylist Baru')

@section('content')
<div class="bg-white p-6 rounded-2xl border border-gray-200 shadow-sm max-w-lg">
    <form action="{{ route('admin.stylist.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        <div>
            <label class="block text-sm font-medium mb-1.5">Nama Stylist</label>
            <input type="text" name="nama" value="{{ old('nama') }}" required
                class="w-full px-4 py-2.5 rounded-xl border border-gray-300 focus:border-noona-rose outline-none">
        </div>

        <div>
            <label class="block text-sm font-medium mb-1.5">Spesialisasi</label>
            <input type="text" name="spesialisasi" value="{{ old('spesialisasi') }}" placeholder="Contoh: Korean Perm & Coloring" required
                class="w-full px-4 py-2.5 rounded-xl border border-gray-300 focus:border-noona-rose outline-none">
        </div>

        <div>
            <label class="block text-sm font-medium mb-1.5">Foto Profil (Opsional)</label>
            <input type="file" name="foto" accept="image/*" class="text-sm">
        </div>

        <div class="flex items-center gap-3 pt-2">
            <button type="submit" class="bg-noona-rose hover:bg-noona-dark text-white text-sm font-semibold px-6 py-2.5 rounded-xl transition">
                Simpan Stylist
            </button>
            <a href="{{ route('admin.stylist.index') }}" class="text-sm text-noona-muted hover:text-noona-dark">Batal</a>
        </div>
    </form>
</div>
@endsection