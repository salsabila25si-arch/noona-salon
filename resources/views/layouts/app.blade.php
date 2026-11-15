<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Noona Salon - Beauty & Hair Studio')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;0,700;1,600&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        serif: ['"Playfair Display"', 'serif'],
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                    },
                    colors: {
                        noona: {
                            cream: '#FDF8F5',
                            blush: '#F7E6E1',
                            rose: '#C97A7E',
                            dark: '#2D2424',
                            muted: '#6E5D5D',
                        }
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-noona-cream text-noona-dark font-sans antialiased flex flex-col min-h-screen">

    <!-- Navbar -->
    <nav class="bg-white/90 backdrop-blur-md border-b border-noona-blush sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20 items-center">
                <!-- Logo -->
                <a href="{{ route('home') }}" class="flex items-center gap-2">
                    <span class="font-serif text-2xl font-bold tracking-wide text-noona-dark">
                        Noona <span class="text-noona-rose italic">Salon</span>
                    </span>
                </a>

                <!-- Menu Tengah -->
                <div class="hidden md:flex items-center space-x-8 text-sm font-medium">
                    <a href="{{ route('home') }}" class="hover:text-noona-rose transition {{ request()->routeIs('home') ? 'text-noona-rose font-semibold' : '' }}">Beranda</a>
                    <a href="{{ route('layanan.index') }}" class="hover:text-noona-rose transition {{ request()->routeIs('layanan.*') ? 'text-noona-rose font-semibold' : '' }}">Layanan</a>
                    <a href="{{ route('galeri.index') }}" class="hover:text-noona-rose transition {{ request()->routeIs('galeri.*') ? 'text-noona-rose font-semibold' : '' }}">Galeri</a>
                    <a href="{{ route('reservasi.cek') }}" class="hover:text-noona-rose transition {{ request()->routeIs('reservasi.cek') ? 'text-noona-rose font-semibold' : '' }}">Cek Booking</a>
                    @auth
                        @if(auth()->user()->role === 'pelanggan')
                            <a href="{{ route('reservasi.riwayat') }}" class="hover:text-noona-rose transition {{ request()->routeIs('reservasi.riwayat') ? 'text-noona-rose font-semibold' : '' }}">Riwayat Saya</a>
                        @endif
                    @endauth
                </div>

                <!-- Aksi Kanan -->
                <div class="flex items-center gap-3">
                    <a href="{{ route('reservasi.create') }}" class="bg-noona-rose hover:bg-noona-dark text-white text-sm font-semibold px-4 py-2.5 rounded-full transition shadow-sm">
                        Booking Sekarang
                    </a>

                    @guest
                        <a href="{{ route('login') }}" class="text-sm font-medium text-noona-dark hover:text-noona-rose px-3 py-2">
                            Masuk
                        </a>
                    @else
                        @if(auth()->user()->role === 'admin')
                            <a href="{{ route('admin.dashboard') }}" class="text-sm font-semibold bg-noona-blush text-noona-dark px-3.5 py-2 rounded-full hover:bg-noona-rose hover:text-white transition">
                                Admin Panel
                            </a>
                        @endif
                        <form action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="text-sm font-medium text-noona-muted hover:text-red-600 px-2 py-2 transition">
                                Keluar
                            </button>
                        </form>
                    @endguest
                </div>
            </div>
        </div>
    </nav>

    <!-- Flash Alerts -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full mt-4">
        @if(session('success'))
            <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 rounded-xl text-sm flex justify-between items-center">
                <span>{{ session('success') }}</span>
                <button onclick="this.parentElement.remove()" class="text-emerald-600 font-bold">×</button>
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-xl text-sm flex justify-between items-center">
                <span>{{ session('error') }}</span>
                <button onclick="this.parentElement.remove()" class="text-red-600 font-bold">×</button>
            </div>
        @endif
    </div>

    <!-- Main Content -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-noona-dark text-white/80 mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 grid grid-cols-1 md:grid-cols-3 gap-8">
            <div>
                <h3 class="font-serif text-2xl font-bold text-white mb-3">Noona <span class="text-noona-rose italic">Salon</span></h3>
                <p class="text-sm leading-relaxed text-white/70">
                    Studio perawatan rambut dan kecantikan modern dengan sentuhan personal dari stylist profesional kami.
                </p>
            </div>
            <div>
                <h4 class="font-semibold text-white mb-3">Jam Operasional</h4>
                <ul class="text-sm space-y-1.5 text-white/70">
                    <li>Senin – Jumat: 09.00 – 20.00 WIB</li>
                    <li>Sabtu – Minggu: 09.00 – 21.00 WIB</li>
                </ul>
            </div>
            <div>
                <h4 class="font-semibold text-white mb-3">Navigasi Cepat</h4>
                <ul class="text-sm space-y-1.5 text-white/70">
                    <li><a href="{{ route('layanan.index') }}" class="hover:text-noona-rose">Daftar Layanan</a></li>
                    <li><a href="{{ route('reservasi.create') }}" class="hover:text-noona-rose">Buat Reservasi</a></li>
                    <li><a href="{{ route('reservasi.cek') }}" class="hover:text-noona-rose">Cek Status Booking</a></li>
                </ul>
            </div>
        </div>
        <div class="border-t border-white/10 py-4 text-center text-xs text-white/50">
            © {{ date('Y') }} Noona Salon. All rights reserved.
        </div>
    </footer>

</body>
</html>