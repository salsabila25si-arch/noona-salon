@extends('layouts.app')

@section('title', 'Galeri Karya - Noona Salon')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="text-center max-w-2xl mx-auto mb-12">
        <h1 class="font-serif text-4xl font-bold text-noona-dark">Galeri Noona Salon</h1>
        <p class="text-noona-muted mt-2">Inspirasi gaya rambut dan hasil transformasi pelanggan kami.</p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @forelse($galeris as $galeri)
            <div class="bg-white rounded-3xl overflow-hidden shadow-sm border border-noona-blush">
                <div class="aspect-square overflow-hidden">
                    <img src="{{ asset('storage/' . $galeri->foto) }}" alt="{{ $galeri->judul }}" class="w-full h-full object-cover hover:scale-105 transition duration-300">
                </div>
                @if($galeri->judul)
                    <div class="p-4">
                        <p class="font-medium text-sm text-noona-dark">{{ $galeri->judul }}</p>
                    </div>
                @endif
            </div>
        @empty
            <p class="text-center text-noona-muted col-span-4 py-12">Belum ada foto di galeri.</p>
        @endforelse
    </div>
</div>
@endsection