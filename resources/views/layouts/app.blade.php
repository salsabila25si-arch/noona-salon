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
                            cream: '#FDF6F8',   // Latar dasar halaman
                            blush: '#F4D5DF',   // Soft pink untuk kartu/badge
                            rose: '#9E2A4B',    // Maroon-rose tegas (aksen & kata "Impianmu")
                            sage: '#7A1C37',    // Deep maroon (border)
                            mint: '#591127',    // Maroon gelap untuk Navbar
                            dark: '#3D0B1A',    // Ultra deep maroon (teks utama & footer)
                            muted: '#784A57',   // Muted maroon-grey (teks deskripsi)
                        }
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gradient-to-b from-[#F5D6E0] via-[#FDF6F8] to-[#F7E1E8] text-noona-dark font-sans antialiased flex flex-col min-h-screen">

    <!-- Navbar Maroon Gelap -->
    <nav class="bg-[#4D0F22]/95 backdrop-blur-md border-b border-noona-rose/30 sticky top-0 z-50 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20 items-center">
                <!-- Logo -->
                <a href="{{ route('home') }}" class="flex items-center gap-2">
                    <span class="font-serif text-2xl font-bold tracking-wide text-white">
                        Noona <span class="text-[#F49BB4] italic">Salon</span>
                    </span>
                </a>

                <!-- Menu Tengah -->
                <div class="hidden md:flex items-center space-x-8 text-sm font-medium text-white/85">
                    <a href="{{ route('home') }}" class="hover:text-[#F49BB4] transition {{ request()->routeIs('home') ? 'text-[#F49BB4] font-semibold' : '' }}">Beranda</a>
                    <a href="{{ route('layanan.index') }}" class="hover:text-[#F49BB4] transition {{ request()->routeIs('layanan.*') ? 'text-[#F49BB4] font-semibold' : '' }}">Layanan</a>
                    <a href="{{ route('galeri.index') }}" class="hover:text-[#F49BB4] transition {{ request()->routeIs('galeri.*') ? 'text-[#F49BB4] font-semibold' : '' }}">Galeri</a>
                    <a href="{{ route('reservasi.cek') }}" class="hover:text-[#F49BB4] transition {{ request()->routeIs('reservasi.cek') ? 'text-[#F49BB4] font-semibold' : '' }}">Cek Booking</a>
                    @auth
                        @if(auth()->user()->role === 'pelanggan')
                            <a href="{{ route('reservasi.riwayat') }}" class="hover:text-[#F49BB4] transition {{ request()->routeIs('reservasi.riwayat') ? 'text-[#F49BB4] font-semibold' : '' }}">Riwayat Saya</a>
                        @endif
                    @endauth
                </div>

                <!-- Aksi Kanan -->
                <div class="flex items-center gap-3">
                    <a href="{{ route('reservasi.create') }}" class="bg-gradient-to-r from-[#E87A9A] to-[#C94A6E] hover:from-[#F28FA9] hover:to-[#D95B7E] text-white text-sm font-semibold px-4 py-2.5 rounded-full transition shadow-sm">
                        Booking Sekarang
                    </a>

                    @guest
                        <a href="{{ route('login') }}" class="text-sm font-medium text-white/90 hover:text-[#F49BB4] px-3 py-2">
                            Masuk
                        </a>
                    @else
                        @if(auth()->user()->role === 'admin')
                            <a href="{{ route('admin.dashboard') }}" class="text-sm font-semibold bg-[#F49BB4] text-[#3D0B1A] px-3.5 py-2 rounded-full hover:bg-white transition">
                                Admin Panel
                            </a>
                        @endif
                        <form action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="text-sm font-medium text-white/75 hover:text-[#F49BB4] px-2 py-2 transition">
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
            <div class="bg-noona-blush border border-noona-rose/40 text-noona-dark px-4 py-3 rounded-xl text-sm flex justify-between items-center">
                <span>{{ session('success') }}</span>
                <button onclick="this.parentElement.remove()" class="text-noona-rose font-bold">×</button>
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-50 border border-red-300 text-red-900 px-4 py-3 rounded-xl text-sm flex justify-between items-center">
                <span>{{ session('error') }}</span>
                <button onclick="this.parentElement.remove()" class="text-red-700 font-bold">×</button>
            </div>
        @endif
    </div>

    <!-- Main Content -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Footer Maroon Gelap -->
    <footer class="bg-gradient-to-r from-[#3D0B1A] to-[#591127] text-white/85 mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 grid grid-cols-1 md:grid-cols-3 gap-8">
            <div>
                <h3 class="font-serif text-2xl font-bold text-white mb-3">Noona <span class="text-[#F49BB4] italic">Salon</span></h3>
                <p class="text-sm leading-relaxed text-white/75">
                    Studio perawatan rambut dan kecantikan modern dengan sentuhan personal dari stylist profesional kami.
                </p>
            </div>
            <div>
                <h4 class="font-semibold text-white mb-3">Jam Operasional</h4>
                <ul class="text-sm space-y-1.5 text-white/75">
                    <li>Senin – Jumat: 09.00 – 20.00 WIB</li>
                    <li>Sabtu – Minggu: 09.00 – 21.00 WIB</li>
                </ul>
            </div>
            <div>
                <h4 class="font-semibold text-white mb-3">Navigasi Cepat</h4>
                <ul class="text-sm space-y-1.5 text-white/75">
                    <li><a href="{{ route('layanan.index') }}" class="hover:text-[#F49BB4]">Daftar Layanan</a></li>
                    <li><a href="{{ route('reservasi.create') }}" class="hover:text-[#F49BB4]">Buat Reservasi</a></li>
                    <li><a href="{{ route('reservasi.cek') }}" class="hover:text-[#F49BB4]">Cek Status Booking</a></li>
                </ul>
            </div>
        </div>
        <div class="border-t border-white/10 py-4 text-center text-xs text-white/60">
            © {{ date('Y') }} Noona Salon. All rights reserved.
        </div>
    </footer>

</body>
</html>
