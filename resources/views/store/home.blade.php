@extends('layouts.app')
@section('content')

<!-- HERO SECTION -->
<section class="mx-auto max-w-7xl px-5 py-12 lg:px-8">
    <div class="relative overflow-hidden rounded-[32px] bg-gradient-to-br from-[#3d5c4e] to-[#263a31] text-white p-8 sm:p-14 lg:p-20 shadow-[0_16px_50px_rgba(40,65,55,0.25)]">
        
        <!-- Decorative Glow / Shape -->
        <div class="absolute -right-20 -bottom-20 w-96 h-96 rounded-full bg-[#5d8573]/20 blur-3xl pointer-events-none"></div>

        <div class="relative z-10 max-w-2xl">
            <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/10 backdrop-blur-md text-white/90 text-xs font-bold tracking-wider uppercase mb-6">
                <span class="w-2 h-2 rounded-full bg-[#83e0b0]"></span>
                IKM Stalltech Original
            </span>

            <h1 class="text-4xl sm:text-6xl font-black tracking-tight leading-[1.05] text-white">
                Jok motor siap jalan untuk perjalanan yang <span class="text-[#a6dfbb]">lebih nyaman.</span>
            </h1>

            <p class="mt-6 text-sm sm:text-base text-white/80 leading-relaxed max-w-xl">
                Stalltech menghadirkan jok motor jadi dengan perhatian pada bentuk ergonomis, material busa presisi, dan daya tahan jahitan prima.
            </p>

            <div class="mt-8 flex flex-wrap items-center gap-4">
                <a href="{{ route('catalog') }}" class="button bg-white text-[#191e1b] hover:bg-[#f2ede6] shadow-lg font-extrabold">
                    Lihat Koleksi Katalog &rarr;
                </a>
                @auth
                    <a href="{{ route('orders.index') }}" class="inline-flex items-center justify-center rounded-full border border-white/30 px-5 py-2.5 text-xs font-bold text-white hover:bg-white/10 transition-colors">
                        Pesanan Saya
                    </a>
                @else
                    <a href="{{ route('login') }}" class="inline-flex items-center justify-center rounded-full border border-white/30 px-5 py-2.5 text-xs font-bold text-white hover:bg-white/10 transition-colors">
                        Masuk Akun
                    </a>
                @endauth
            </div>

            <!-- Features Pill List -->
            <div class="mt-12 pt-8 border-t border-white/15 flex flex-wrap gap-8 text-xs text-white/70">
                <div>
                    <strong class="block text-2xl font-black text-white">01</strong>
                    Jok Jadi Siap Pasang
                </div>
                <div>
                    <strong class="block text-2xl font-black text-white">02</strong>
                    Standar &amp; Jumbo Size
                </div>
                <div>
                    <strong class="block text-2xl font-black text-white">03</strong>
                    Pesan Langsung ke Rumah
                </div>
            </div>
        </div>

    </div>
</section>

<!-- VALUES SECTION -->
<section class="mx-auto max-w-7xl px-5 py-12 lg:px-8">
    <div class="max-w-xl mb-10">
        <p class="text-xs font-bold uppercase tracking-wider text-[#456353]">Keunggulan Kami</p>
        <h2 class="text-3xl font-black text-[#191e1b] mt-1">Dibuat dekat dengan kenyamanan pengendara.</h2>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white rounded-[24px] p-6 shadow-[0_4px_20px_-2px_rgba(60,75,65,0.05)] border border-[#e2ddd5]/60">
            <span class="text-xl font-black text-[#456353]">01</span>
            <h3 class="text-lg font-extrabold text-[#191e1b] mt-4">Material Terpilih</h3>
            <p class="text-xs text-[#7d8882] mt-2 leading-relaxed">
                Kulit sintetis tebal bertekstur anti-selip dan busa cetak densitas tinggi yang empuk tanpa cepat kempes.
            </p>
        </div>

        <div class="bg-white rounded-[24px] p-6 shadow-[0_4px_20px_-2px_rgba(60,75,65,0.05)] border border-[#e2ddd5]/60">
            <span class="text-xl font-black text-[#456353]">02</span>
            <h3 class="text-lg font-extrabold text-[#191e1b] mt-4">Presisi Jenis Motor</h3>
            <p class="text-xs text-[#7d8882] mt-2 leading-relaxed">
                Didesain mengikuti lekuk bodi Honda, Yamaha, dan motor matic/bebek agar terpasang rapi dan plug-and-play.
            </p>
        </div>

        <div class="bg-white rounded-[24px] p-6 shadow-[0_4px_20px_-2px_rgba(60,75,65,0.05)] border border-[#e2ddd5]/60">
            <span class="text-xl font-black text-[#456353]">03</span>
            <h3 class="text-lg font-extrabold text-[#191e1b] mt-4">Pemantauan Terbuka</h3>
            <p class="text-xs text-[#7d8882] mt-2 leading-relaxed">
                Status pesanan, verifikasi bukti transfer, proses pengerjaan hingga nomor resi pengiriman dapat dipantau langsung.
            </p>
        </div>
    </div>
</section>

<!-- FEATURED PRODUCTS -->
<section class="mx-auto max-w-7xl px-5 py-12 lg:px-8">
    <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 mb-8">
        <div>
            <p class="text-xs font-bold uppercase tracking-wider text-[#456353]">Produk Pilihan</p>
            <h2 class="text-3xl font-black text-[#191e1b] mt-1">Koleksi Jok Siap Menemani</h2>
        </div>
        <a href="{{ route('catalog') }}" class="text-xs font-bold text-[#456353] hover:underline">
            Buka Katalog Lengkap &rarr;
        </a>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($featured as $variant)
            <article class="product-card group">
                <div class="product-art">
                    <span>{{ $variant->sizeLabel() }}</span>
                    <strong>ST</strong>
                </div>
                <div class="p-6">
                    <p class="text-[11px] font-bold uppercase tracking-wider text-[#456353]">
                        {{ $variant->motorcycleType->name }}
                    </p>
                    <h3 class="text-lg font-extrabold text-[#191e1b] mt-1">
                        {{ $variant->product->name }}
                    </h3>
                    <div class="mt-6 flex items-center justify-between">
                        <span class="text-base font-black text-[#191e1b]">{{ rupiah($variant->price) }}</span>
                        <a href="{{ route('catalog') }}" class="text-xs font-bold text-[#456353] group-hover:underline">
                            Lihat di katalog &rarr;
                        </a>
                    </div>
                </div>
            </article>
        @endforeach
    </div>
</section>

<!-- CALL TO ACTION -->
<section class="mx-auto max-w-7xl px-5 pb-16 lg:px-8">
    <div class="rounded-[32px] bg-[#191e1b] text-white p-8 sm:p-12 flex flex-col md:flex-row items-center justify-between gap-6">
        <div>
            <p class="text-xs font-bold uppercase tracking-wider text-[#a6dfbb]">Ready When You Are</p>
            <h2 class="text-2xl sm:text-3xl font-black text-white mt-1">Mulai perjalanan yang lebih nyaman bersama Stalltech.</h2>
        </div>
        <div class="flex items-center gap-3 shrink-0">
            <a href="{{ route('catalog') }}" class="button bg-[#456353] hover:bg-[#365042] text-white">Belanja Sekarang</a>
            @guest
                <a href="{{ route('register') }}" class="button secondary">Daftar Akun</a>
            @endguest
        </div>
    </div>
</section>

@endsection
