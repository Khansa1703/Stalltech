@extends('layouts.app')
@section('content')

<div class="mx-auto max-w-5xl px-5 py-10 lg:px-8">
    <p class="text-xs font-bold uppercase tracking-wider text-[#456353]">Customer Space</p>
    <h1 class="text-3xl sm:text-4xl font-black text-[#191e1b] mt-1">Daftar Pesanan Saya</h1>

    <div class="mt-8 space-y-4">
        @forelse($orders as $order)
            <a href="{{ route('orders.show', $order) }}" class="block bg-white rounded-[24px] p-6 shadow-[0_4px_20px_-2px_rgba(60,75,65,0.05)] border border-[#e2ddd5]/60 hover:border-[#456353] transition-all">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                    <div>
                        <div class="flex items-center gap-3">
                            <h2 class="text-lg font-black text-[#191e1b]">{{ $order->order_number }}</h2>
                            <span class="status status-{{ $order->status }}">{{ $order->statusLabel() }}</span>
                        </div>
                        <p class="text-xs text-[#7d8882] mt-1">
                            {{ $order->created_at->format('d M Y, H:i') }} &middot; {{ $order->items->count() }} item produk
                        </p>
                    </div>

                    <div class="flex items-center gap-6 self-end sm:self-auto">
                        <strong class="text-lg font-black text-[#191e1b]">{{ rupiah($order->total) }}</strong>
                        <span class="text-xs font-bold text-[#456353]">Detail &rarr;</span>
                    </div>
                </div>
            </a>
        @empty
            <div class="bg-white rounded-[24px] p-12 text-center text-xs text-[#838e88] border border-[#e2ddd5]/60">
                Belum ada pesanan yang dibuat.
            </div>
        @endforelse
    </div>

    <div class="mt-8">
        {{ $orders->links() }}
    </div>
</div>

@endsection
