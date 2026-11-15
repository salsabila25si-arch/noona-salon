@extends('layouts.app')

@section('title', 'Noona Salon - Beauty & Hair Studio')

@section('content')
<!-- Hero Section -->
<section class="bg-gradient-to-br from-noona-blush via-noona-cream to-white py-20 border-b border-noona-blush">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
        <div>
            <span class="inline-block bg-white text-noona-rose text-xs font-bold uppercase tracking-widest px-4 py-1.5 rounded-full shadow-sm mb-4">
                Korean & Modern Hair Studio
            </span>
            <h1 class="font-serif text-4xl sm:text-5xl lg:text-6xl font-bold text-noona-dark leading-tight">
                Wujudkan Gaya Rambut <span class="text-noona-rose italic">Impianmu</span> Bersama Kami
            </h1>
            <p class="text-noona-muted text-base sm:text-lg mt-5 leading-relaxed max-w-xl">
                Perawatan rambut, pewarnaan, hingga styling profesional yang disesuaikan khusus dengan karakter dan bentuk wajahmu.
            </p>
            <div class="mt-8 flex flex-wrap gap-4">
                <a href="{{ route('reservasi.create') }}" class="bg-noona-rose hover:bg-noona-dark text-white font-semibold px-7 py-3.5 rounded-full transition shadow-md">
                    Reservasi Jadwal
                </a>
                <a href="{{ route('layanan.index') }}" class="bg-white hover:bg-noona-blush text-noona-dark font-semibold px-7 py-3.5 rounded-full border border-noona-blush transition">
                    Lihat Daftar Layanan
                </a>
            </div>
        </div>

        <div class="bg-white p-6 rounded-3xl shadow-lg border border-noona-blush">
            <div class="aspect-[4/3] rounded-2xl bg-noona-blush/60 flex flex-col items-center justify-center text-center p-8">
                <p class="font-serif text-3xl font-bold text-noona-dark">Noona Salon</p>
                <p class="text-sm text-noona-muted mt-2 max-w-xs">
                    "Because every woman deserves to feel confident, radiant, and effortlessly beautiful."
                </p>
                <div class="mt-6 grid grid-cols-3 gap-4 w-full pt-6 border-t border-noona-rose/20">
                    <div>
                        <p class="font-serif text-2xl font-bold text-noona-rose">{{ $layanans->count() }}+</p>
                        <p class="text-xs text-noona-muted">Layanan</p>
                    </div>
                    <div>
                        <p class="font-serif text-2xl font-bold text-noona-rose">{{ $stylists->count() }}</p>
                        <p class="text-xs text-noona-muted">Pro Stylist</p>
                    </div>
                    <div>
                        <p class="font-serif text-2xl font-bold text-noona-rose">100%</p>
                        <p class="text-xs text-noona-muted">Produk Premium</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Layanan Populer -->
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <div class="flex flex-col sm:flex-row sm:items-end justify-between mb-10">
        <div>
            <p class="text-noona-rose text-xs font-bold uppercase tracking-widest">Treatment & Care</p>
            <h2 class="font-serif text-3xl font-bold text-noona-dark mt-1">Layanan Unggulan Kami</h2>
        </div>
        <a href="{{ route('layanan.index') }}" class="text-sm font-semibold text-noona-rose hover:underline mt-3 sm:mt-0">
            Lihat Semua Layanan →
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($layanans->take(6) as $layanan)
            <div class="bg-white rounded-3xl overflow-hidden shadow-sm border border-noona-blush flex flex-col justify-between hover:shadow-md transition">
                <div>
                    @if($layanan->foto)
                        <img src="{{ asset('storage/' . $layanan->foto) }}" alt="{{ $layanan->nama }}" class="w-full h-48 object-cover">
                    @else
                        <div class="w-full h-48 bg-noona-blush/50 flex items-center justify-center text-noona-rose font-serif text-xl">
                            Noona Treatment
                        </div>
                    @endif

                    <div class="p-6">
                        <span class="text-xs font-semibold bg-noona-blush text-noona-dark px-3 py-1 rounded-full">
                            {{ $layanan->kategori->nama ?? 'Umum' }}
                        </span>
                        <h3 class="font-serif text-xl font-bold mt-3">{{ $layanan->nama }}</h3>
                        <p class="text-sm text-noona-muted mt-2 line-clamp-2">{{ $layanan->deskripsi }}</p>
                    </div>
                </div>

                <div class="px-6 pb-6 pt-3 border-t border-gray-100 flex items-center justify-between">
                    <div>
                        <p class="text-lg font-bold text-noona-rose">Rp {{ number_format($layanan->harga, 0, ',', '.') }}</p>
                        <p class="text-xs text-noona-muted">Estimasi {{ $layanan->durasi_menit }} menit</p>
                    </div>
                    <a href="{{ route('reservasi.create', ['layanan_id' => $layanan->id]) }}" class="bg-noona-dark hover:bg-noona-rose text-white text-xs font-semibold px-4 py-2.5 rounded-full transition">
                        Pilih
                    </a>
                </div>
            </div>
        @empty
            <p class="text-noona-muted col-span-3 text-center py-8">Belum ada data layanan.</p>
        @endforelse
    </div>
</section>

<!-- Tim Stylist -->
<section class="bg-white py-16 border-y border-noona-blush">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-xl mx-auto mb-12">
            <p class="text-noona-rose text-xs font-bold uppercase tracking-widest">Our Experts</p>
            <h2 class="font-serif text-3xl font-bold text-noona-dark mt-1">Stylist Profesional Kami</h2>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @forelse($stylists as $stylist)
                <div class="bg-noona-cream rounded-3xl p-6 text-center border border-noona-blush">
                    @if($stylist->foto)
                        <img src="{{ asset('storage/' . $stylist->foto) }}" alt="{{ $stylist->nama }}" class="w-24 h-24 rounded-full object-cover mx-auto mb-4 border-2 border-noona-rose">
                    @else
                        <div class="w-24 h-24 rounded-full bg-noona-blush text-noona-rose font-serif text-2xl font-bold flex items-center justify-center mx-auto mb-4">
                            {{ strtoupper(substr($stylist->nama, 0, 1)) }}
                        </div>
                    @endif
                    <h3 class="font-serif text-lg font-bold">{{ $stylist->nama }}</h3>
                    <p class="text-xs text-noona-rose font-medium mt-1">{{ $stylist->spesialisasi }}</p>
                </div>
            @empty
                <p class="text-noona-muted col-span-4 text-center">Belum ada data stylist.</p>
            @endforelse
        </div>
    </div>
</section>

<!-- Galeri Singkat -->
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <div class="flex flex-col sm:flex-row sm:items-end justify-between mb-10">
        <div>
            <p class="text-noona-rose text-xs font-bold uppercase tracking-widest">Portfolio</p>
            <h2 class="font-serif text-3xl font-bold text-noona-dark mt-1">Galeri Hasil Karya</h2>
        </div>
        <a href="{{ route('galeri.index') }}" class="text-sm font-semibold text-noona-rose hover:underline mt-3 sm:mt-0">
            Lihat Semua Galeri →
        </a>
    </div>

    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        @forelse($galeris as $galeri)
            <div class="group relative rounded-2xl overflow-hidden aspect-square bg-noona-blush">
                <img src="{{ asset('storage/' . $galeri->foto) }}" alt="{{ $galeri->judul }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                @if($galeri->judul)
                    <div class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-black/70 to-transparent p-4">
                        <p class="text-white text-xs font-medium">{{ $galeri->judul }}</p>
                    </div>
                @endif
            </div>
        @empty
            <p class="text-noona-muted col-span-4 text-center py-6">Belum ada foto galeri.</p>
        @endforelse
    </div>
</section>
@endsection