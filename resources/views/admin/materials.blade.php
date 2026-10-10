@extends('layouts.admin')
@section('pageTitle', 'Material & Stok')
@section('content')

<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <p class="text-xs font-bold uppercase tracking-wider text-[#456353]">Inventaris Operasional</p>
            <h1 class="text-2xl sm:text-3xl font-black text-[#191e1b] mt-0.5">Material &amp; Stok Bahan Baku</h1>
        </div>
        <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center gap-1 text-xs font-bold text-[#456353] hover:underline self-start sm:self-auto">
            &larr; Kembali ke Dashboard
        </a>
    </div>

    <div class="grid gap-6 lg:grid-cols-[380px_1fr] items-start">
        
        <!-- Form Tambah Material -->
        <form method="POST" action="{{ route('admin.materials.store') }}" class="bg-white rounded-[24px] p-6 shadow-[0_4px_20px_-2px_rgba(60,75,65,0.05)] border border-[#e2ddd5]/60 space-y-4">
            @csrf
            <h2 class="text-lg font-extrabold text-[#191e1b]">Tambah Material Baru</h2>
            
            <div>
                <label class="text-xs font-bold text-[#49544e]">Nama Material</label>
                <input name="name" placeholder="Contoh: Kulit sintetis hitam" class="mt-1" required>
            </div>

            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="text-xs font-bold text-[#49544e]">Satuan</label>
                    <input name="unit" placeholder="meter / lembar" class="mt-1" required>
                </div>
                <div>
                    <label class="text-xs font-bold text-[#49544e]">Biaya / Unit (Rp)</label>
                    <input name="material_cost" type="number" min="0" placeholder="85000" class="mt-1" required>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="text-xs font-bold text-[#49544e]">Stok Awal</label>
                    <input name="current_stock" type="number" step="0.01" min="0" value="0" class="mt-1" required>
                </div>
                <div>
                    <label class="text-xs font-bold text-[#49544e]">Batas Minimum</label>
                    <input name="minimum_stock" type="number" step="0.01" min="0" value="0" class="mt-1" required>
                </div>
            </div>

            <button type="submit" class="w-full button-sage mt-2">
                Simpan Material
            </button>
        </form>

        <!-- Daftar Material & Penyesuaian -->
        <div class="space-y-4">
            @foreach($materials as $material)
                <div class="bg-white rounded-[24px] p-6 shadow-[0_4px_20px_-2px_rgba(60,75,65,0.05)] border border-[#e2ddd5]/60">
                    <div class="flex items-start justify-between">
                        <div>
                            <h2 class="text-lg font-extrabold text-[#191e1b]">{{ $material->name }}</h2>
                            <p class="text-xs text-[#7d8882] mt-0.5">{{ rupiah($material->material_cost) }} / {{ $material->unit }} &middot; Min: {{ $material->minimum_stock }} {{ $material->unit }}</p>
                        </div>
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold {{ $material->isLowStock() ? 'bg-[#fdf0ed] text-[#b94838]' : 'bg-[#eaf5ee] text-[#286843]' }}">
                            <span class="w-1.5 h-1.5 rounded-full {{ $material->isLowStock() ? 'bg-[#b94838]' : 'bg-[#286843]' }}"></span>
                            {{ $material->current_stock }} {{ $material->unit }}
                        </span>
                    </div>

                    <!-- Form Penyesuaian Stok (Masuk / Keluar) -->
                    <form method="POST" action="{{ route('admin.materials.adjust', $material) }}" class="mt-4 pt-4 border-t border-[#f2ede6] flex flex-wrap items-center gap-2">
                        @csrf
                        <select name="type" class="w-36 text-xs font-semibold">
                            <option value="in">Barang Masuk</option>
                            <option value="out">Barang Keluar</option>
                        </select>
                        <input name="quantity" type="number" step="0.01" min="0.01" placeholder="Jumlah" required class="w-28 text-xs font-semibold">
                        <input name="notes" placeholder="Catatan transaksi..." class="min-w-44 flex-1 text-xs">
                        <button type="submit" class="button small">Catat Transaksi</button>
                    </form>
                </div>
            @endforeach
        </div>

    </div>

    <!-- Riwayat Transaksi Stok -->
    <section class="bg-white rounded-[24px] p-6 shadow-[0_4px_20px_-2px_rgba(60,75,65,0.05)] border border-[#e2ddd5]/60 mt-8">
        <h2 class="text-lg font-extrabold text-[#191e1b] mb-4">Riwayat Mutasi Stok Terkini</h2>
        <div class="overflow-x-auto">
            <table>
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Item</th>
                        <th>Tipe</th>
                        <th>Jumlah</th>
                        <th>Catatan</th>
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
                            <td class="text-xs text-[#7d8882]">{{ $transaction->notes ?: '-' }}</td>
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
