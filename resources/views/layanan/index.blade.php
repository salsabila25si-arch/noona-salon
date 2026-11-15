@extends('layouts.app')

@section('title', 'Daftar Layanan - Noona Salon')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="text-center max-w-2xl mx-auto mb-10">
        <h1 class="font-serif text-4xl font-bold text-noona-dark">Katalog Layanan</h1>
        <p class="text-noona-muted mt-2">Pilih perawatan terbaik sesuai kebutuhan rambut dan kecantikan Anda.</p>
    </div>

    <!-- Filter Kategori -->
    <div class="flex flex-wrap justify-center gap-2 mb-10">
        <a href="{{ route('layanan.index') }}" class="px-5 py-2 rounded-full text-sm font-medium transition {{ !request('kategori_id') ? 'bg-noona-rose text-white' : 'bg-white text-noona-dark border border-noona-blush hover:bg-noona-blush' }}">
            Semua Kategori
        </a>
        @foreach($kategoris as $kategori)
            <a href="{{ route('layanan.index', ['kategori_id' => $kategori->id]) }}" class="px-5 py-2 rounded-full text-sm font-medium transition {{ request('kategori_id') == $kategori->id ? 'bg-noona-rose text-white' : 'bg-white text-noona-dark border border-noona-blush hover:bg-noona-blush' }}">
                {{ $kategori->nama }}
            </a>
        @endforeach
    </div>

    <!-- Grid Layanan -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($layanans as $layanan)
            <div class="bg-white rounded-3xl overflow-hidden shadow-sm border border-noona-blush flex flex-col justify-between">
                <div>
                    @if($layanan->foto)
                        <img src="{{ asset('storage/' . $layanan->foto) }}" alt="{{ $layanan->nama }}" class="w-full h-52 object-cover">
                    @else
                        <div class="w-full h-52 bg-noona-blush/50 flex items-center justify-center text-noona-rose font-serif text-xl">
                            Noona Salon
                        </div>
                    @endif
                    <div class="p-6">
                        <span class="text-xs font-semibold bg-noona-blush text-noona-dark px-3 py-1 rounded-full">
                            {{ $layanan->kategori->nama ?? '-' }}
                        </span>
                        <h2 class="font-serif text-xl font-bold mt-3">{{ $layanan->nama }}</h2>
                        <p class="text-sm text-noona-muted mt-2">{{ $layanan->deskripsi }}</p>
                    </div>
                </div>

                <div class="px-6 pb-6 pt-4 border-t border-gray-100 flex items-center justify-between">
                    <div>
                        <p class="text-lg font-bold text-noona-rose">Rp {{ number_format($layanan->harga, 0, ',', '.') }}</p>
                        <p class="text-xs text-noona-muted">Durasi: {{ $layanan->durasi_menit }} menit</p>
                    </div>
                    <a href="{{ route('reservasi.create', ['layanan_id' => $layanan->id]) }}" class="bg-noona-rose hover:bg-noona-dark text-white text-xs font-semibold px-5 py-2.5 rounded-full transition">
                        Booking
                    </a>
                </div>
            </div>
        @empty
            <p class="text-center text-noona-muted col-span-3 py-12">Belum ada layanan pada kategori ini.</p>
        @endforelse
    </div>
</div>
@endsection