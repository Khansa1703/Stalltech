@extends('layouts.app')
@section('content')

<div class="mx-auto max-w-4xl px-5 py-14 grid gap-10 lg:grid-cols-2 items-center">
    <div>
        <p class="text-xs font-bold uppercase tracking-wider text-[#456353]">Selamat Datang Kembali</p>
        <h1 class="text-4xl sm:text-5xl font-black text-[#191e1b] mt-2 tracking-tight leading-tight">
            Masuk ke akun <span class="text-[#456353]">Stalltech.</span>
        </h1>
        <p class="text-sm text-[#7d8882] mt-4 leading-relaxed max-w-md">
            Masuk untuk memantau status pesanan jok motor Anda atau mengelola operasional bengkel dan stok bahan baku.
        </p>
    </div>

    <!-- Card Form -->
    <div class="bg-white rounded-[28px] p-8 shadow-[0_8px_30px_rgba(60,75,65,0.06)] border border-[#e2ddd5]/70">
        <h2 class="text-xl font-extrabold text-[#191e1b] mb-6">Masuk Akun</h2>

        <form method="POST" action="{{ route('login.store') }}" class="space-y-4">
            @csrf
            <div>
                <label class="text-xs font-bold text-[#49544e]">Email Terdaftar</label>
                <input name="email" type="email" value="{{ old('email') }}" placeholder="nama@email.com" class="mt-1" required autofocus>
            </div>

            <div>
                <label class="text-xs font-bold text-[#49544e]">Kata Sandi</label>
                <input name="password" type="password" placeholder="••••••••" class="mt-1" required>
            </div>

            <div class="flex items-center justify-between text-xs pt-1">
                <label class="flex items-center gap-2 cursor-pointer font-medium text-[#55635c]">
                    <input name="remember" type="checkbox" class="w-4 h-4 rounded text-[#456353]">
                    <span>Ingat saya</span>
                </label>
            </div>

            <button type="submit" class="w-full button mt-3">
                Masuk Sekarang &rarr;
            </button>

            <p class="text-center text-xs font-semibold text-[#838e88] pt-4 border-t border-[#f2ede6]">
                Belum punya akun? 
                <a href="{{ route('register') }}" class="font-extrabold text-[#456353] hover:underline">
                    Daftar customer baru
                </a>
            </p>
        </form>
    </div>
</div>

@endsection
