@extends('layouts.admin')
@section('pageTitle', 'Order Masuk')
@section('content')

<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <p class="text-xs font-bold uppercase tracking-wider text-[#456353]">Pengelolaan Pesanan</p>
            <h1 class="text-2xl sm:text-3xl font-black text-[#191e1b] mt-0.5">Order &amp; Verifikasi Pembayaran</h1>
        </div>
        <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center gap-1 text-xs font-bold text-[#456353] hover:underline self-start sm:self-auto">
            &larr; Kembali ke Dashboard
        </a>
    </div>

    <div class="space-y-4">
        @forelse($orders as $order)
            <div class="bg-white rounded-[24px] p-6 shadow-[0_4px_20px_-2px_rgba(60,75,65,0.05)] border border-[#e2ddd5]/60">
                <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4 pb-4 border-b border-[#f2ede6]">
                    <div>
                        <div class="flex flex-wrap items-center gap-3">
                            <h2 class="text-lg font-black text-[#191e1b]">{{ $order->order_number }}</h2>
                            <span class="status status-{{ $order->status }}">{{ $order->statusLabel() }}</span>
                        </div>
                        <p class="text-xs text-[#7d8882] mt-1">
                            {{ $order->user->name }} &middot; {{ $order->user->email }} &middot; <strong class="text-[#191e1b]">{{ rupiah($order->total) }}</strong> &middot; {{ $order->created_at->format('d M Y, H:i') }}
                        </p>
                    </div>
                    <a href="{{ route('orders.show', $order) }}" class="inline-flex items-center gap-1 text-xs font-bold text-[#456353] hover:underline">
                        Lihat Detail Pesanan &rarr;
                    </a>
                </div>

                <!-- Verifikasi Bukti Transfer jika ada -->
                @if($order->payment?->status === 'submitted')
                    <div class="mt-4 flex flex-col sm:flex-row sm:items-center justify-between gap-4 rounded-2xl bg-[#faf8f5] p-4 border border-[#e8e2d8]">
                        <div>
                            <p class="text-xs font-extrabold text-[#191e1b]">Bukti Transfer Menunggu Verifikasi</p>
                            <p class="text-xs text-[#7d8882] mt-0.5">
                                Nominal: <strong>{{ rupiah($order->payment->amount) }}</strong> 
                                @if($order->payment->proof_path)
                                    &middot; <a class="underline text-[#456353] font-bold" href="{{ asset('storage/'.$order->payment->proof_path) }}" target="_blank">Lihat Bukti Foto</a>
                                @endif
                            </p>
                        </div>
                        <div class="flex gap-2">
                            <form method="POST" action="{{ route('admin.orders.verify', $order) }}">
                                @csrf
                                <input type="hidden" name="decision" value="reject">
                                <button type="submit" class="button small secondary">Tolak</button>
                            </form>
                            <form method="POST" action="{{ route('admin.orders.verify', $order) }}">
                                @csrf
                                <input type="hidden" name="decision" value="approve">
                                <button type="submit" class="button small">Setujui &amp; Kurangi Stok</button>
                            </form>
                        </div>
                    </div>
                @endif

                <!-- Update Status Order jika sedang aktif -->
                @if(in_array($order->status, ['approve', 'process', 'delivery']))
                    <form method="POST" action="{{ route('admin.orders.status', $order) }}" class="mt-4 flex flex-wrap items-center gap-2">
                        @csrf 
                        @method('PATCH')
                        <span class="text-xs font-bold text-[#49544e]">Update Status:</span>
                        <select name="status" class="w-36 text-xs font-semibold">
                            <option value="process" @selected($order->status === 'process')>Process</option>
                            <option value="delivery" @selected($order->status === 'delivery')>Delivery</option>
                            <option value="finish" @selected($order->status === 'finish')>Finish</option>
                            <option value="cancel">Cancel</option>
                        </select>
                        <input name="tracking_number" value="{{ $order->tracking_number }}" placeholder="Nomor Resi (wajib jika Delivery)" class="min-w-56 flex-1 text-xs">
                        <button type="submit" class="button small secondary">Perbarui Status</button>
                    </form>
                @endif
            </div>
        @empty
            <div class="bg-white rounded-[24px] p-12 text-center text-xs text-[#838e88] border border-[#e2ddd5]/60">
                Belum ada pesanan masuk.
            </div>
        @endforelse
    </div>

    <div class="mt-6">
        {{ $orders->links() }}
    </div>
</div>

@endsection
