@extends('layouts.admin')

@section('title', 'Upload Foto Galeri - Admin')
@section('header', 'Upload Foto Galeri')

@section('content')
<div class="bg-white p-6 rounded-2xl border border-gray-200 shadow-sm max-w-lg">
    <form action="{{ route('admin.galeri.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        <div>
            <label class="block text-sm font-medium mb-1.5">Judul / Keterangan Foto (Opsional)</label>
            <input type="text" name="judul" value="{{ old('judul') }}" placeholder="Contoh: Ash Balayage by Stylist Hana"
                class="w-full px-4 py-2.5 rounded-xl border border-gray-300 focus:border-noona-rose outline-none">
        </div>

        <div>
            <label class="block text-sm font-medium mb-1.5">Pilih File Foto</label>
            <input type="file" name="foto" accept="image/*" required class="text-sm">
        </div>

        <div class="flex items-center gap-3 pt-2">
            <button type="submit" class="bg-noona-rose hover:bg-noona-dark text-white text-sm font-semibold px-6 py-2.5 rounded-xl transition">
                Upload Foto
            </button>
            <a href="{{ route('admin.galeri.index') }}" class="text-sm text-noona-muted hover:text-noona-dark">Batal</a>
        </div>
    </form>
</div>
@endsection