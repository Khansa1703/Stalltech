@extends('layouts.app')
@section('content')

<div class="mx-auto max-w-xl px-5 py-12">
    <div class="bg-white rounded-[28px] p-8 shadow-[0_8px_30px_rgba(60,75,65,0.06)] border border-[#e2ddd5]/70">
        <p class="text-xs font-bold uppercase tracking-wider text-[#456353]">Akun Customer Baru</p>
        <h1 class="text-2xl sm:text-3xl font-black text-[#191e1b] mt-1">Daftar Akun Stalltech</h1>
        <p class="text-xs text-[#7d8882] mt-1 mb-6">Lengkapi data untuk memudahkan pemesanan dan pengiriman produk jok motor.</p>

        <form method="POST" action="{{ route('register.store') }}" class="space-y-4">
            @csrf
            <div>
                <label class="text-xs font-bold text-[#49544e]">Nama Lengkap</label>
                <input name="name" value="{{ old('name') }}" placeholder="Contoh: Budi Santoso" class="mt-1" required>
            </div>

            <div>
                <label class="text-xs font-bold text-[#49544e]">Email</label>
                <input name="email" type="email" value="{{ old('email') }}" placeholder="budi@example.com" class="mt-1" required>
            </div>

            <div>
                <label class="text-xs font-bold text-[#49544e]">Nomor WhatsApp / HP</label>
                <input name="phone" value="{{ old('phone') }}" placeholder="08xxxxxxxxxx" class="mt-1" required>
            </div>

            <div>
                <label class="text-xs font-bold text-[#49544e]">Alamat Lengkap</label>
                <textarea name="address" rows="3" placeholder="Alamat pengiriman pesanan..." class="mt-1" required>{{ old('address') }}</textarea>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="text-xs font-bold text-[#49544e]">Kata Sandi</label>
                    <input name="password" type="password" placeholder="••••••••" class="mt-1" required>
                </div>
                <div>
                    <label class="text-xs font-bold text-[#49544e]">Ulangi Kata Sandi</label>
                    <input name="password_confirmation" type="password" placeholder="••••••••" class="mt-1" required>
                </div>
            </div>

            <button type="submit" class="w-full button mt-4">
                Daftar Sekarang &rarr;
            </button>

            <p class="text-center text-xs font-semibold text-[#838e88] pt-4 border-t border-[#f2ede6]">
                Sudah punya akun? 
                <a href="{{ route('login') }}" class="font-extrabold text-[#456353] hover:underline">
                    Masuk ke sini
                </a>
            </p>
        </form>
    </div>
</div>

@endsection
