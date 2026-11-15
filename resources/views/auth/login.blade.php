@extends('layouts.app')

@section('title', 'Masuk - Noona Salon')

@section('content')
<div class="max-w-md mx-auto my-16 px-4">
    <div class="bg-white p-8 rounded-3xl shadow-sm border border-noona-blush">
        <div class="text-center mb-8">
            <h1 class="font-serif text-3xl font-bold text-noona-dark">Selamat Datang</h1>
            <p class="text-sm text-noona-muted mt-2">Masuk ke akun Noona Salon Anda</p>
        </div>

        @if($errors->any())
            <div class="mb-4 bg-red-50 border border-red-200 text-red-700 text-sm px-4 py-3 rounded-xl">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('login.post') }}" method="POST" class="space-y-5">
            @csrf
            <div>
                <label class="block text-sm font-medium mb-1.5">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required autofocus
                    class="w-full px-4 py-2.5 rounded-xl border border-gray-300 focus:border-noona-rose focus:ring-2 focus:ring-noona-blush outline-none">
            </div>

            <div>
                <label class="block text-sm font-medium mb-1.5">Password</label>
                <input type="password" name="password" required
                    class="w-full px-4 py-2.5 rounded-xl border border-gray-300 focus:border-noona-rose focus:ring-2 focus:ring-noona-blush outline-none">
            </div>

            <div class="flex items-center justify-between text-sm">
                <label class="flex items-center gap-2 text-noona-muted">
                    <input type="checkbox" name="remember" class="rounded text-noona-rose">
                    Ingat saya
                </label>
            </div>

            <button type="submit" class="w-full bg-noona-rose hover:bg-noona-dark text-white font-semibold py-3 rounded-xl transition">
                Masuk
            </button>
        </form>

        <p class="text-center text-sm text-noona-muted mt-6">
            Belum punya akun?
            <a href="{{ route('register') }}" class="text-noona-rose font-semibold hover:underline">Daftar sekarang</a>
        </p>
    </div>
</div>
@endsection