@extends('layouts.admin')

@section('title', 'Tambah Layanan - Admin')
@section('header', 'Tambah Layanan Baru')

@section('content')
<div class="bg-white p-6 rounded-2xl border border-gray-200 shadow-sm max-w-2xl">
    <form action="{{ route('admin.layanan.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        <div>
            <label class="block text-sm font-medium mb-1.5">Kategori</label>
            <select name="kategori_id" required class="w-full px-4 py-2.5 rounded-xl border border-gray-300 focus:border-noona-rose outline-none">
                <option value="">-- Pilih Kategori --</option>
                @foreach($kategoris as $kategori)
                    <option value="{{ $kategori->id }}" {{ old('kategori_id') == $kategori->id ? 'selected' : '' }}>
                        {{ $kategori->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block text-sm font-medium mb-1.5">Nama Layanan</label>
            <input type="text" name="nama" value="{{ old('nama') }}" required
                class="w-full px-4 py-2.5 rounded-xl border border-gray-300 focus:border-noona-rose outline-none">
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium mb-1.5">Harga (Rp)</label>
                <input type="number" name="harga" value="{{ old('harga') }}" min="0" required
                    class="w-full px-4 py-2.5 rounded-xl border border-gray-300 focus:border-noona-rose outline-none">
            </div>

            <div>
                <label class="block text-sm font-medium mb-1.5">Durasi (Menit)</label>
                <input type="number" name="durasi_menit" value="{{ old('durasi_menit', 60) }}" min="5" required
                    class="w-full px-4 py-2.5 rounded-xl border border-gray-300 focus:border-noona-rose outline-none">
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium mb-1.5">Deskripsi</label>
            <textarea name="deskripsi" rows="3"
                class="w-full px-4 py-2.5 rounded-xl border border-gray-300 focus:border-noona-rose outline-none">{{ old('deskripsi') }}</textarea>
        </div>

        <div>
            <label class="block text-sm font-medium mb-1.5">Foto Layanan (Opsional)</label>
            <input type="file" name="foto" accept="image/*" class="text-sm">
        </div>

        <div class="flex items-center gap-3 pt-2">
            <button type="submit" class="bg-noona-rose hover:bg-noona-dark text-white text-sm font-semibold px-6 py-2.5 rounded-xl transition">
                Simpan Layanan
            </button>
            <a href="{{ route('admin.layanan.index') }}" class="text-sm text-noona-muted hover:text-noona-dark">Batal</a>
        </div>
    </form>
</div>
@endsection