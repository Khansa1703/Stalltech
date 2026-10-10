@extends('layouts.app')
@section('content')

<div class="mx-auto max-w-4xl px-5 py-10 lg:px-8">
    <p class="text-xs font-bold uppercase tracking-wider text-[#456353]">Keranjang Belanja</p>
    <h1 class="text-3xl sm:text-4xl font-black text-[#191e1b] mt-1">Daftar Pilihan Anda</h1>

    @if($variants->isEmpty())
        <div class="bg-white rounded-[24px] p-12 text-center shadow-[0_4px_20px_-2px_rgba(60,75,65,0.05)] border border-[#e2ddd5]/60 mt-8">
            <p class="text-xs font-semibold text-[#838e88]">Keranjang belanja masih kosong.</p>
            <a href="{{ route('catalog') }}" class="button mt-5 inline-flex">
                Mulai Belanja &rarr;
            </a>
        </div>
    @else
        <form method="POST" action="{{ route('cart.update') }}" class="mt-8">
            @csrf 
            @method('PUT')
            <div class="space-y-4">
                @foreach($variants as $variant)
                    <div class="bg-white rounded-[24px] p-5 shadow-[0_4px_20px_-2px_rgba(60,75,65,0.05)] border border-[#e2ddd5]/60 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                        <div>
                            <p class="text-base font-extrabold text-[#191e1b]">{{ $variant->product->name }}</p>
                            <p class="text-xs text-[#7d8882] mt-0.5">
                                {{ $variant->motorcycleType->name }} / {{ $variant->sizeLabel() }} &middot; {{ rupiah($variant->price) }}
                            </p>
                        </div>
                        <div class="flex items-center gap-4">
                            <label class="text-xs font-bold text-[#49544e] flex items-center gap-2">
                                <span>Qty:</span>
                                <input class="w-20 text-xs font-bold" type="number" min="0" max="{{ $variant->stock }}" name="quantity[{{ $variant->id }}]" value="{{ $cart[$variant->id] }}">
                            </label>
                            <strong class="text-sm font-black text-[#191e1b] min-w-28 text-right">
                                {{ rupiah($variant->price * $cart[$variant->id]) }}
                            </strong>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-8 flex flex-col sm:flex-row sm:items-center justify-between gap-5 bg-white rounded-[24px] p-6 shadow-[0_4px_20px_-2px_rgba(60,75,65,0.05)] border border-[#e2ddd5]/60">
                <div>
                    <p class="text-xs font-semibold text-[#838e88]">Total Tagihan</p>
                    <p class="text-2xl sm:text-3xl font-black text-[#191e1b] mt-0.5">{{ rupiah($subtotal) }}</p>
                </div>
                <div class="flex items-center gap-3">
                    <button type="submit" class="button secondary">Perbarui Keranjang</button>
                    <a href="{{ route('checkout') }}" class="button">Lanjut ke Checkout &rarr;</a>
                </div>
            </div>
        </form>
    @endif
</div>

@endsection
