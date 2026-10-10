@extends('layouts.admin')
@section('pageTitle', 'Laporan Bisnis')
@section('content')

<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <p class="text-xs font-bold uppercase tracking-wider text-[#456353]">Analisis &amp; Kinerja</p>
            <h1 class="text-2xl sm:text-3xl font-black text-[#191e1b] mt-0.5">Laporan Bisnis &amp; Keuntungan</h1>
        </div>
        <div class="flex gap-2">
            <a href="{{ route('admin.reports.excel') }}" class="button small secondary">Ekspor Excel</a>
            <a href="{{ route('admin.reports.export') }}" class="button small">Ekspor CSV</a>
        </div>
    </div>

    <!-- Filter Form -->
    <form class="bg-white rounded-[24px] p-5 shadow-[0_4px_20px_-2px_rgba(60,75,65,0.05)] border border-[#e2ddd5]/60 flex flex-wrap items-end gap-4">
        <div>
            <label class="text-xs font-bold text-[#49544e]">Tanggal Mulai</label>
            <input name="from" type="date" value="{{ request('from') }}" class="text-xs mt-1">
        </div>
        <div>
            <label class="text-xs font-bold text-[#49544e]">Tanggal Selesai</label>
            <input name="to" type="date" value="{{ request('to') }}" class="text-xs mt-1">
        </div>
        <button type="submit" class="button small secondary">Terapkan Filter</button>
    </form>

    <!-- Stat Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
        <div class="bg-white rounded-[24px] p-5 shadow-[0_4px_20px_-2px_rgba(60,75,65,0.05)] border border-[#e2ddd5]/60">
            <span class="text-xs font-semibold text-[#838e88] block">Total Pendapatan</span>
            <strong class="text-2xl font-black text-[#191e1b] block mt-1">
                {{ rupiah($orders->whereIn('status', ['approve', 'process', 'delivery', 'finish'])->sum('subtotal')) }}
            </strong>
            <small class="text-[11px] text-[#7d8882] block mt-1">Subtotal order tervalidasi</small>
        </div>

        <div class="bg-white rounded-[24px] p-5 shadow-[0_4px_20px_-2px_rgba(60,75,65,0.05)] border border-[#e2ddd5]/60">
            <span class="text-xs font-semibold text-[#838e88] block">Modal Material (BOM)</span>
            <strong class="text-2xl font-black text-[#191e1b] block mt-1">{{ rupiah($materialCost) }}</strong>
            <small class="text-[11px] text-[#7d8882] block mt-1">Berdasarkan pemakaian komponen</small>
        </div>

        <div class="bg-[#456353] rounded-[24px] p-5 shadow-[0_4px_20px_-2px_rgba(69,99,83,0.35)] text-white">
            <span class="text-xs font-semibold text-white/80 block">Estimasi Keuntungan Bersih</span>
            <strong class="text-2xl font-black text-white block mt-1">{{ rupiah($profit) }}</strong>
            <small class="text-[11px] text-white/70 block mt-1">Pendapatan dikurangi modal BOM</small>
        </div>
    </div>

    <!-- Tabel Penjualan -->
    <section class="bg-white rounded-[24px] p-6 shadow-[0_4px_20px_-2px_rgba(60,75,65,0.05)] border border-[#e2ddd5]/60">
        <h2 class="text-lg font-extrabold text-[#191e1b] mb-4">Rincian Penjualan per Pesanan</h2>
        <div class="overflow-x-auto">
            <table>
                <thead>
                    <tr>
                        <th>Order</th>
                        <th>Customer</th>
                        <th>Produk</th>
                        <th>Qty</th>
                        <th>Harga</th>
                        <th>Status</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                        @foreach($order->items as $item)
                            <tr>
                                <td class="font-bold text-xs text-[#191e1b]">{{ $order->order_number }}</td>
                                <td class="text-xs text-[#191e1b]">{{ $order->user->name }}</td>
                                <td class="text-xs text-[#191e1b]">{{ $item->variant->name }}</td>
                                <td class="text-xs text-[#191e1b] font-bold">{{ $item->quantity }}</td>
                                <td class="text-xs text-[#191e1b]">{{ rupiah($item->unit_price) }}</td>
                                <td><span class="status status-{{ $order->status }}">{{ $order->statusLabel() }}</span></td>
                                <td class="text-xs font-black text-[#191e1b]">{{ rupiah($order->total) }}</td>
                            </tr>
                        @endforeach
                    @empty
                        <tr>
                            <td colspan="7" class="py-6 text-center text-xs text-[#838e88]">Belum ada data penjualan pada rentang waktu ini.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>

    <!-- Tabel Mutasi Inventory -->
    <section class="bg-white rounded-[24px] p-6 shadow-[0_4px_20px_-2px_rgba(60,75,65,0.05)] border border-[#e2ddd5]/60">
        <h2 class="text-lg font-extrabold text-[#191e1b] mb-4">Laporan Arus Stok &amp; Material</h2>
        <div class="overflow-x-auto">
            <table>
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Item</th>
                        <th>Tipe</th>
                        <th>Jumlah</th>
                        <th>Referensi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($transactions as $transaction)
                        <tr>
                            <td class="text-xs text-[#7d8882]">{{ $transaction->created_at->format('d/m/Y H:i') }}</td>
                            <td class="font-bold text-xs text-[#191e1b]">{{ $transaction->material?->name ?: $transaction->variant?->name }}</td>
                            <td>
                                <span class="px-2 py-0.5 rounded-full text-[10px] font-bold {{ $transaction->type === 'in' ? 'bg-[#eaf5ee] text-[#286843]' : 'bg-[#fdf0ed] text-[#b94838]' }}">
                                    {{ strtoupper($transaction->type) }}
                                </span>
                            </td>
                            <td class="font-bold text-xs text-[#191e1b]">{{ $transaction->quantity }}</td>
                            <td class="text-xs text-[#7d8882]">{{ $transaction->reference_type ?: 'manual' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-6 text-center text-xs text-[#838e88]">Belum ada mutasi stok.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
</div>

@endsection
