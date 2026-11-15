@extends('layouts.admin')

@section('title', 'Galeri Karya - Admin')
@section('header', 'Galeri Karya Salon')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <p class="text-sm text-noona-muted">Unggah dan kelola portofolio hasil perawatan salon.</p>
    <a href="{{ route('admin.galeri.create') }}" class="bg-noona-rose hover:bg-noona-dark text-white text-sm font-semibold px-5 py-2.5 rounded-xl transition">
        + Upload Foto
    </a>
</div>

<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
    @forelse($galeris as $galeri)
        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden flex flex-col justify-between">
            <div>
                <img src="{{ asset('storage/' . $galeri->foto) }}" alt="{{ $galeri->judul }}" class="w-full aspect-square object-cover">
                <div class="p-4">
                    <p class="text-sm font-medium text-noona-dark">{{ $galeri->judul ?: 'Tanpa Judul' }}</p>
                </div>
            </div>
            <div class="px-4 pb-4">
                <form action="{{ route('admin.galeri.destroy', $galeri) }}" method="POST" onsubmit="return confirm('Hapus foto ini dari galeri?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="w-full text-xs font-semibold text-red-600 bg-red-50 hover:bg-red-100 py-2 rounded-xl transition">
                        Hapus Foto
                    </button>
                </form>
            </div>
        </div>
    @empty
        <div class="col-span-4 bg-white rounded-2xl border border-gray-200 p-10 text-center text-noona-muted">
            Belum ada foto di galeri.
        </div>
    @endforelse
</div>
@endsection