<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel - Noona Salon')</title>
    <script src="https://cdn.tailwindcss.com"></script>
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
<body class="bg-gray-50 text-noona-dark font-sans antialiased">

    <div class="min-h-screen flex">
        <!-- Sidebar -->
        <aside class="w-64 bg-noona-dark text-white flex flex-col justify-between shrink-0">
            <div>
                <div class="h-20 flex items-center px-6 border-b border-white/10">
                    <a href="{{ route('admin.dashboard') }}" class="font-serif text-xl font-bold tracking-wide">
                        Noona <span class="text-noona-rose italic">Admin</span>
                    </a>
                </div>

                <nav class="p-4 space-y-1.5 text-sm font-medium">
                    <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2.5 rounded-xl transition {{ request()->routeIs('admin.dashboard') ? 'bg-noona-rose text-white' : 'text-white/75 hover:bg-white/10 hover:text-white' }}">
                        Dashboard
                    </a>
                    <a href="{{ route('admin.reservasi.index') }}" class="block px-4 py-2.5 rounded-xl transition {{ request()->routeIs('admin.reservasi.*') ? 'bg-noona-rose text-white' : 'text-white/75 hover:bg-white/10 hover:text-white' }}">
                        Kelola Reservasi
                    </a>
                    <a href="{{ route('admin.kategori.index') }}" class="block px-4 py-2.5 rounded-xl transition {{ request()->routeIs('admin.kategori.*') ? 'bg-noona-rose text-white' : 'text-white/75 hover:bg-white/10 hover:text-white' }}">
                        Kategori Layanan
                    </a>
                    <a href="{{ route('admin.layanan.index') }}" class="block px-4 py-2.5 rounded-xl transition {{ request()->routeIs('admin.layanan.*') ? 'bg-noona-rose text-white' : 'text-white/75 hover:bg-white/10 hover:text-white' }}">
                        Daftar Layanan
                    </a>
                    <a href="{{ route('admin.stylist.index') }}" class="block px-4 py-2.5 rounded-xl transition {{ request()->routeIs('admin.stylist.*') ? 'bg-noona-rose text-white' : 'text-white/75 hover:bg-white/10 hover:text-white' }}">
                        Data Stylist
                    </a>
                    <a href="{{ route('admin.galeri.index') }}" class="block px-4 py-2.5 rounded-xl transition {{ request()->routeIs('admin.galeri.*') ? 'bg-noona-rose text-white' : 'text-white/75 hover:bg-white/10 hover:text-white' }}">
                        Galeri Karya
                    </a>
                </nav>
            </div>

            <div class="p-4 border-t border-white/10 space-y-2 text-sm">
                <a href="{{ route('home') }}" class="block px-4 py-2 rounded-xl text-white/70 hover:text-white hover:bg-white/10 transition">
                    ← Lihat Website
                </a>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full text-left px-4 py-2 rounded-xl text-red-300 hover:bg-red-500/20 transition">
                        Logout
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col">
            <header class="h-20 bg-white border-b border-gray-200 px-8 flex items-center justify-between">
                <h1 class="text-lg font-bold text-noona-dark">@yield('header', 'Dashboard')</h1>
                <div class="text-sm text-noona-muted">
                    Halo, <span class="font-semibold text-noona-dark">{{ auth()->user()->nama }}</span>
                </div>
            </header>

            <main class="p-8 flex-1">
                @if(session('success'))
                    <div class="mb-6 bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 rounded-xl text-sm flex justify-between items-center">
                        <span>{{ session('success') }}</span>
                        <button onclick="this.parentElement.remove()" class="text-emerald-600 font-bold">×</button>
                    </div>
                @endif

                @if($errors->any())
                    <div class="mb-6 bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-xl text-sm">
                        <ul class="list-disc list-inside space-y-1">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

</body>
</html>