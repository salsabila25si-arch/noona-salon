@extends('layouts.app')

@section('title', 'Daftar Akun - Noona Salon')

@section('content')
<div class="max-w-md mx-auto my-14 px-4">
    <div class="bg-white p-8 rounded-3xl shadow-sm border border-noona-blush">
        <div class="text-center mb-8">
            <h1 class="font-serif text-3xl font-bold text-noona-dark">Buat Akun Baru</h1>
            <p class="text-sm text-noona-muted mt-2">Nikmati kemudahan memantau riwayat reservasi Anda</p>
        </div>

        @if($errors->any())
            <div class="mb-4 bg-red-50 border border-red-200 text-red-700 text-sm px-4 py-3 rounded-xl">
                <ul class="list-disc list-inside space-y-1">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('register.post') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-medium mb-1.5">Nama Lengkap</label>
                <input type="text" name="nama" value="{{ old('nama') }}" required
                    class="w-full px-4 py-2.5 rounded-xl border border-gray-300 focus:border-noona-rose focus:ring-2 focus:ring-noona-blush outline-none">
            </div>

            <div>
                <label class="block text-sm font-medium mb-1.5">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required
                    class="w-full px-4 py-2.5 rounded-xl border border-gray-300 focus:border-noona-rose focus:ring-2 focus:ring-noona-blush outline-none">
            </div>

            <div>
                <label class="block text-sm font-medium mb-1.5">Nomor HP / WhatsApp</label>
                <input type="text" name="no_hp" value="{{ old('no_hp') }}" placeholder="0812xxxxxxxx" required
                    class="w-full px-4 py-2.5 rounded-xl border border-gray-300 focus:border-noona-rose focus:ring-2 focus:ring-noona-blush outline-none">
            </div>

            <div>
                <label class="block text-sm font-medium mb-1.5">Password</label>
                <input type="password" name="password" required
                    class="w-full px-4 py-2.5 rounded-xl border border-gray-300 focus:border-noona-rose focus:ring-2 focus:ring-noona-blush outline-none">
            </div>

            <div>
                <label class="block text-sm font-medium mb-1.5">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" required
                    class="w-full px-4 py-2.5 rounded-xl border border-gray-300 focus:border-noona-rose focus:ring-2 focus:ring-noona-blush outline-none">
            </div>

            <button type="submit" class="w-full bg-noona-rose hover:bg-noona-dark text-white font-semibold py-3 rounded-xl transition mt-2">
                Daftar Sekarang
            </button>
        </form>

        <p class="text-center text-sm text-noona-muted mt-6">
            Sudah punya akun?
            <a href="{{ route('login') }}" class="text-noona-rose font-semibold hover:underline">Masuk di sini</a>
        </p>
    </div>
</div>
@endsection