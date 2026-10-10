@extends('layouts.admin')
@section('pageTitle', 'Bill of Materials')
@section('content')

<div class="space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <a href="{{ route('admin.products') }}" class="inline-flex items-center gap-1 text-xs font-bold text-[#456353] hover:underline mb-2">
                &larr; Kembali ke Daftar Produk
            </a>
            <p class="text-xs font-bold uppercase tracking-wider text-[#456353]">Bill of Materials (BOM)</p>
            <h1 class="text-2xl sm:text-3xl font-black text-[#191e1b] mt-0.5">{{ $variant->product->name }}</h1>
            <p class="text-xs font-semibold text-[#7d8882] mt-1">{{ $variant->name }} / {{ $variant->motorcycleType->name }} / {{ $variant->sizeLabel() }}</p>
        </div>
    </div>

    <div class="grid gap-6 md:grid-cols-[1fr_340px] items-start">
        
        <!-- Komponen Terdaftar -->
        <section class="bg-white rounded-[24px] p-6 shadow-[0_4px_20px_-2px_rgba(60,75,65,0.05)] border border-[#e2ddd5]/60">
            <h2 class="text-lg font-extrabold text-[#191e1b] mb-4">Komponen Material Terdaftar</h2>
            <div class="divide-y divide-[#f2ede6]">
                @forelse($variant->bom?->items ?? [] as $item)
                    <div class="flex justify-between items-center py-4">
                        <div>
                            <p class="font-extrabold text-sm text-[#191e1b]">{{ $item->displayName() }}</p>
                            <small class="text-xs text-[#7d8882] mt-0.5 block">{{ rupiah($item->material_cost) }} / {{ $item->unit }}</small>
                        </div>
                        <strong class="text-sm font-black text-[#456353]">{{ $item->quantity }} {{ $item->unit }}</strong>
                    </div>
                @empty
                    <p class="py-8 text-center text-xs text-[#838e88]">Belum ada komponen BOM untuk variasi ini.</p>
                @endforelse
            </div>
        </section>

        <!-- Tambah Komponen BOM -->
        <form method="POST" action="{{ route('admin.bom.store', $variant) }}" class="bg-white rounded-[24px] p-6 shadow-[0_4px_20px_-2px_rgba(60,75,65,0.05)] border border-[#e2ddd5]/60 space-y-4">
            @csrf
            <h2 class="text-lg font-extrabold text-[#191e1b]">Tambah Komponen</h2>
            
            <div>
                <label class="text-xs font-bold text-[#49544e]">Pilih Material</label>
                <select name="material_id" class="mt-1" required>
                    @foreach($materials as $material)
                        <option value="{{ $material->id }}">{{ $material->name }} ({{ $material->unit }})</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="text-xs font-bold text-[#49544e]">Kebutuhan per Produk</label>
                <input name="quantity" type="number" step="0.01" min="0.01" placeholder="2.5" class="mt-1" required>
            </div>

            <div>
                <label class="text-xs font-bold text-[#49544e]">Satuan</label>
                <input name="unit" placeholder="meter / lembar / roll" class="mt-1" required>
            </div>

            <button type="submit" class="w-full button-sage mt-2">
                Simpan Komponen BOM
            </button>
        </form>

    </div>
</div>

@endsection
