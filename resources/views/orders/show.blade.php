@extends('layouts.app')
@section('content')

<div class="mx-auto max-w-5xl px-5 py-10 lg:px-8">
    <a href="{{ route('orders.index') }}" class="inline-flex items-center gap-1 text-xs font-bold text-[#456353] hover:underline mb-4">
        &larr; Kembali ke Daftar Pesanan
    </a>

    <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 pb-6 border-b border-[#ded8ce]">
        <div>
            <p class="text-xs font-bold uppercase tracking-wider text-[#456353]">Rincian Pesanan</p>
            <h1 class="text-2xl sm:text-3xl font-black text-[#191e1b] mt-0.5">{{ $order->order_number }}</h1>
        </div>
        <span class="status status-{{ $order->status }}">{{ $order->statusLabel() }}</span>
    </div>

    <div class="mt-8 grid gap-6 lg:grid-cols-[1fr_360px] items-start">
        
        <!-- List Item -->
        <section class="bg-white rounded-[24px] p-6 shadow-[0_4px_20px_-2px_rgba(60,75,65,0.05)] border border-[#e2ddd5]/60">
            <h2 class="text-lg font-extrabold text-[#191e1b] mb-4">Item Pesanan</h2>
            <div class="divide-y divide-[#f2ede6]">
                @foreach($order->items as $item)
                    <div class="py-4 flex justify-between items-center gap-4">
                        <div>
                            <p class="font-extrabold text-sm text-[#191e1b]">{{ $item->variant->product->name }}</p>
                            <p class="text-xs text-[#7d8882] mt-0.5">
                                {{ $item->variant->motorcycleType->name }} / {{ $item->variant->sizeLabel() }} &times; {{ $item->quantity }}
                            </p>
                        </div>
                        <strong class="text-sm font-black text-[#191e1b]">{{ rupiah($item->subtotal) }}</strong>
                    </div>
                @endforeach
            </div>

            <div class="mt-6 pt-4 border-t border-[#ded8ce] space-y-2 text-xs">
                <div class="flex justify-between text-[#7d8882]">
                    <span>Subtotal Produk</span>
                    <strong class="text-[#191e1b] font-bold">{{ rupiah($order->subtotal) }}</strong>
                </div>
                <div class="flex justify-between text-[#7d8882]">
                    <span>Ongkos Kirim</span>
                    <strong class="text-[#191e1b] font-bold">{{ rupiah($order->shipping_cost) }}</strong>
                </div>
                <div class="flex justify-between pt-2 border-t border-[#f2ede6] text-base font-black text-[#191e1b]">
                    <span>Total Pembayaran</span>
                    <span class="text-[#456353]">{{ rupiah($order->total) }}</span>
                </div>
            </div>
        </section>

        <!-- Informasi Pengiriman & Pembayaran -->
        <aside class="space-y-5">
            <!-- Pengiriman -->
            <div class="bg-white rounded-[24px] p-6 shadow-[0_4px_20px_-2px_rgba(60,75,65,0.05)] border border-[#e2ddd5]/60">
                <p class="text-xs font-bold uppercase tracking-wider text-[#456353]">Alamat Pengiriman</p>
                <p class="text-xs text-[#191e1b] mt-3 leading-relaxed">
                    {{ $order->shipping_address }}<br>
                    <span class="font-bold text-[#7d8882]">{{ $order->shipping_phone }}</span>
                </p>

                @if($order->tracking_number)
                    <div class="mt-4 p-3 rounded-2xl bg-[#eaf5ee] border border-[#b7dfc6] text-xs">
                        <span class="font-bold text-[#236540] block">Nomor Resi:</span>
                        <strong class="text-sm font-black text-[#191e1b] mt-0.5 block">{{ $order->tracking_number }}</strong>
                    </div>
                @endif
            </div>

            <!-- Pembayaran Manual -->
            @if($order->payment?->status !== 'verified' && !auth()->user()->isOwner())
                <div class="bg-white rounded-[24px] p-6 shadow-[0_4px_20px_-2px_rgba(60,75,65,0.05)] border border-[#e2ddd5]/60">
                    <p class="text-xs font-bold uppercase tracking-wider text-[#456353]">Transfer Manual</p>
                    <div class="mt-3 p-3.5 rounded-2xl bg-[#faf8f5] border border-[#eeebe3] text-xs text-[#7d8882] leading-relaxed">
                        Silakan transfer ke:<br>
                        <strong class="text-[#191e1b] font-black text-sm">BCA 123456789</strong><br>
                        a.n. Stalltech Management
                    </div>

                    <form method="POST" action="{{ route('payments.store', $order) }}" enctype="multipart/form-data" class="mt-4 space-y-3">
                        @csrf
                        <div>
                            <label class="text-xs font-bold text-[#49544e]">Nominal Ditransfer</label>
                            <input name="amount" type="number" value="{{ old('amount', $order->total) }}" class="text-xs mt-1" required>
                        </div>
                        <div>
                            <label class="text-xs font-bold text-[#49544e]">Upload Bukti Transfer</label>
                            <input name="proof" type="file" accept=".jpg,.jpeg,.png,.pdf" class="text-xs mt-1" required>
                        </div>
                        <button type="submit" class="w-full button small mt-2">
                            Kirim Bukti Pembayaran
                        </button>
                    </form>
                </div>
            @elseif($order->payment)
                <div class="bg-white rounded-[24px] p-6 shadow-[0_4px_20px_-2px_rgba(60,75,65,0.05)] border border-[#e2ddd5]/60">
                    <p class="text-xs font-bold uppercase tracking-wider text-[#456353]">Status Pembayaran</p>
                    <p class="text-base font-black text-[#191e1b] mt-2">{{ ucfirst($order->payment->status) }}</p>
                    @if($order->payment->amount)
                        <p class="text-xs text-[#7d8882] mt-0.5">{{ rupiah($order->payment->amount) }}</p>
                    @endif
                </div>
            @endif
        </aside>

    </div>
</div>

@endsection
