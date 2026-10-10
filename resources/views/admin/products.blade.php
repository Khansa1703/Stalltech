@extends('layouts.admin')
@section('pageTitle', 'Produk & Variasi')
@section('content')

<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <p class="text-xs font-bold uppercase tracking-wider text-[#456353]">Katalog Stalltech</p>
            <h1 class="text-2xl sm:text-3xl font-black text-[#191e1b] mt-0.5">Produk &amp; Variasi Jok Motor</h1>
        </div>
        <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center gap-1 text-xs font-bold text-[#456353] hover:underline self-start sm:self-auto">
            &larr; Kembali ke Dashboard
        </a>
    </div>

    <div class="grid gap-6 lg:grid-cols-[380px_1fr] items-start">
        
        <!-- Form Tambah Produk -->
        <form method="POST" action="{{ route('admin.products.store') }}" class="bg-white rounded-[24px] p-6 shadow-[0_4px_20px_-2px_rgba(60,75,65,0.05)] border border-[#e2ddd5]/60 space-y-4">
            @csrf
            <h2 class="text-lg font-extrabold text-[#191e1b]">Tambah Produk Baru</h2>
            
            <div>
                <label class="text-xs font-bold text-[#49544e]">Nama Produk</label>
                <input name="product_name" placeholder="Contoh: Urban Grip" class="mt-1" required>
            </div>

            <div>
                <label class="text-xs font-bold text-[#49544e]">Nama Variasi</label>
                <input name="variant_name" placeholder="Contoh: Comfort Series" class="mt-1" required>
            </div>

            <div>
                <label class="text-xs font-bold text-[#49544e]">Jenis Motor</label>
                <select name="motorcycle_type_id" class="mt-1" required>
                    @foreach($types as $type)
                        <option value="{{ $type->id }}">{{ $type->name }} ({{ $type->size }})</option>
                    @endforeach
                </select>
            </div>

            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="text-xs font-bold text-[#49544e]">Ukuran</label>
                    <select name="size" class="mt-1">
                        <option value="Standar">Standar</option>
                        <option value="Jumbo">Jumbo</option>
                    </select>
                </div>
                <div>
                    <label class="text-xs font-bold text-[#49544e]">Stok Awal</label>
                    <input name="stock" type="number" min="0" value="0" class="mt-1" required>
                </div>
            </div>

            <div>
                <label class="text-xs font-bold text-[#49544e]">Harga Satuan (Rp)</label>
                <input name="price" type="number" min="0" placeholder="450000" class="mt-1" required>
            </div>

            <div>
                <label class="text-xs font-bold text-[#49544e]">Deskripsi Produk</label>
                <textarea name="description" rows="3" placeholder="Deskripsi kenyamanan, busa, dan material..." class="mt-1"></textarea>
            </div>

            <button type="submit" class="w-full button-sage mt-2">
                Simpan Produk
            </button>
        </form>

        <!-- Daftar Produk & Variasi -->
        <div class="space-y-4">
            @foreach($products as $product)
                <div class="bg-white rounded-[24px] p-6 shadow-[0_4px_20px_-2px_rgba(60,75,65,0.05)] border border-[#e2ddd5]/60">
                    <div class="flex items-start justify-between gap-4 pb-4 border-b border-[#f2ede6]">
                        <div>
                            <h2 class="text-xl font-extrabold text-[#191e1b]">{{ $product->name }}</h2>
                            <p class="text-xs text-[#7d8882] mt-1">{{ $product->description ?: 'Tanpa deskripsi' }}</p>
                        </div>
                        <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full bg-[#eaf5ee] text-[#286843] text-xs font-bold">
                            <span class="w-1.5 h-1.5 rounded-full bg-[#286843]"></span>
                            Aktif
                        </span>
                    </div>

                    <div class="mt-4 space-y-3">
                        @foreach($product->variants as $variant)
                            <form method="POST" action="{{ route('admin.variants.update', $variant) }}" class="grid items-end gap-3 rounded-2xl bg-[#faf8f5] p-4 sm:grid-cols-[1fr_110px_90px_110px_auto] border border-[#eeebe3]">
                                @csrf 
                                @method('PATCH')
                                <div>
                                    <small class="block text-[11px] font-semibold text-[#838e88] mb-1">
                                        {{ $variant->motorcycleType->name }} / {{ $variant->sizeLabel() }}
                                    </small>
                                    <input name="name" value="{{ $variant->name }}" class="text-xs font-semibold" required>
                                </div>
                                <div>
                                    <label class="text-[11px] font-bold text-[#49544e]">Harga</label>
                                    <input name="price" type="number" value="{{ $variant->price }}" class="text-xs">
                                </div>
                                <div>
                                    <label class="text-[11px] font-bold text-[#49544e]">Stok</label>
                                    <input name="stock" type="number" value="{{ $variant->stock }}" class="text-xs">
                                </div>
                                <div>
                                    <label class="text-[11px] font-bold text-[#49544e]">Ukuran</label>
                                    <select name="size" class="text-xs">
                                        <option @selected($variant->size === 'Standar')>Standar</option>
                                        <option @selected($variant->size === 'Jumbo')>Jumbo</option>
                                    </select>
                                </div>
                                <div class="flex gap-2">
                                    <button class="button small">Simpan</button>
                                    <a href="{{ route('admin.bom', $variant) }}" class="button small secondary">BOM</a>
                                </div>
                            </form>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>

    </div>
</div>

@endsection
