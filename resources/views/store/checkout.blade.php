@extends('layouts.app')
@section('content')

<div class="mx-auto max-w-5xl px-5 py-10 lg:px-8">
    <p class="text-xs font-bold uppercase tracking-wider text-[#456353]">Langkah Terakhir</p>
    <h1 class="text-3xl sm:text-4xl font-black text-[#191e1b] mt-1">Checkout Pesanan</h1>

    <div class="mt-8 grid gap-6 lg:grid-cols-[1fr_360px] items-start">
        
        <!-- Form Pengiriman -->
        <form method="POST" action="{{ route('checkout.store') }}" class="bg-white rounded-[24px] p-6 shadow-[0_4px_20px_-2px_rgba(60,75,65,0.05)] border border-[#e2ddd5]/60 space-y-4">
            @csrf
            <h2 class="text-lg font-extrabold text-[#191e1b]">Informasi Alamat Pengiriman</h2>
            
            <div>
                <label class="text-xs font-bold text-[#49544e]">Alamat Lengkap Tujuan</label>
                <textarea name="shipping_address" rows="4" placeholder="Jalan, No Rumah, Kelurahan, Kecamatan, Kota/Kabupaten, Kode Pos..." class="mt-1" required>{{ old('shipping_address', auth()->user()->address) }}</textarea>
            </div>

            <div>
                <label class="text-xs font-bold text-[#49544e]">Nomor Telepon / WhatsApp Aktif</label>
                <input name="shipping_phone" value="{{ old('shipping_phone', auth()->user()->phone) }}" placeholder="08xxxxxxxxxx" class="mt-1" required>
            </div>

            <div>
                <label class="text-xs font-bold text-[#49544e]">Estimasi Ongkos Kirim (Rp)</label>
                <input name="shipping_cost" type="number" min="0" value="{{ old('shipping_cost', 15000) }}" class="mt-1" required>
            </div>

            <button type="submit" class="w-full button mt-4">
                Buat Pesanan Sekarang &rarr;
            </button>
        </form>

        <!-- Ringkasan Pesanan -->
        <aside class="bg-white rounded-[24px] p-6 shadow-[0_4px_20px_-2px_rgba(60,75,65,0.05)] border border-[#e2ddd5]/60">
            <h2 class="text-base font-extrabold text-[#191e1b] mb-4">Ringkasan Produk</h2>
            <div class="divide-y divide-[#f2ede6]">
                @foreach($variants as $variant)
                    <div class="py-3 flex justify-between gap-3 text-xs">
                        <div>
                            <p class="font-extrabold text-[#191e1b]">{{ $variant->product->name }}</p>
                            <span class="text-[#7d8882]">{{ $variant->name }} x{{ $cart[$variant->id] }}</span>
                        </div>
                        <strong class="text-[#191e1b] font-bold">{{ rupiah($variant->price * $cart[$variant->id]) }}</strong>
                    </div>
                @endforeach
            </div>

            <div class="mt-6 pt-4 border-t border-[#ded8ce] flex justify-between items-center">
                <span class="text-sm font-semibold text-[#838e88]">Subtotal</span>
                <span class="text-xl font-black text-[#191e1b]">{{ rupiah($subtotal) }}</span>
            </div>

            <div class="mt-4 p-4 rounded-2xl bg-[#faf8f5] border border-[#eeebe3] text-xs text-[#7d8882] leading-relaxed">
                Pembayaran dilakukan via transfer manual ke rekening Stalltech setelah pesanan dibuat, lalu upload bukti transfer untuk diverifikasi.
            </div>
        </aside>

    </div>
</div>

@endsection
