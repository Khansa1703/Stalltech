@extends('layouts.app')
@section('content')

<div class="mx-auto max-w-7xl px-5 py-10 lg:px-8">
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-5 pb-8 border-b border-[#ded8ce]">
        <div>
            <p class="text-xs font-bold uppercase tracking-wider text-[#456353]">Koleksi Terlengkap</p>
            <h1 class="text-3xl sm:text-4xl font-black text-[#191e1b] mt-1">Katalog Jok Motor Stalltech</h1>
        </div>

        <!-- Filter Form -->
        <form class="flex flex-wrap items-center gap-3">
            <input name="search" value="{{ request('search') }}" placeholder="Cari tipe motor atau nama produk..." class="w-64 text-xs font-medium">
            <select name="motorcycle_type_id" class="w-56 text-xs font-semibold">
                <option value="">Semua Jenis Motor</option>
                @foreach($types as $type)
                    <option value="{{ $type->id }}" @selected(request('motorcycle_type_id') == $type->id)>
                        {{ $type->name }} ({{ $type->size }})
                    </option>
                @endforeach
            </select>
            <button type="submit" class="button small">Filter</button>
        </form>
    </div>

    <!-- Ukuran Badges -->
    <div class="mt-6 flex flex-wrap gap-2 text-xs font-bold">
        <span class="rounded-full bg-[#eaf5ee] text-[#286843] px-3.5 py-1.5 border border-[#c3dfce]">
            Standar: 46 x 90 cm (Beat, Vario, Bebek, CBR)
        </span>
        <span class="rounded-full bg-white text-[#55635c] px-3.5 py-1.5 border border-[#e2ddd5]">
            Jumbo: 60 x 100 cm (NMAX, PCX, Aerox, ADV, XMAX)
        </span>
    </div>

    <!-- Product Grid -->
    <div class="mt-8 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
        @forelse($variants as $variant)
            <article class="product-card group">
                <div class="product-art">
                    <span>{{ $variant->motorcycleType->name }}</span>
                    <strong>{{ $variant->size === 'Jumbo' ? 'J' : 'S' }}</strong>
                </div>
                <div class="p-6">
                    <div class="flex items-center justify-between">
                        <span class="text-[11px] font-bold uppercase tracking-wider text-[#456353]">
                            {{ $variant->sizeLabel() }}
                        </span>
                        <span class="text-[11px] font-semibold text-[#838e88]">
                            {{ $variant->stock }} unit tersedia
                        </span>
                    </div>

                    <h2 class="text-lg font-extrabold text-[#191e1b] mt-1.5">
                        {{ $variant->product->name }}
                    </h2>
                    <p class="text-xs text-[#7d8882] mt-0.5">{{ $variant->name }}</p>

                    <div class="mt-6 pt-4 border-t border-[#f2ede6] flex items-center justify-between gap-3">
                        <span class="text-lg font-black text-[#191e1b]">{{ rupiah($variant->price) }}</span>
                        <form method="POST" action="{{ route('cart.add', $variant) }}">
                            @csrf
                            <button type="submit" class="button small" @disabled($variant->stock < 1)>
                                {{ $variant->stock < 1 ? 'Habis' : '+ Keranjang' }}
                            </button>
                        </form>
                    </div>
                </div>
            </article>
        @empty
            <div class="col-span-full rounded-[28px] border border-dashed border-[#ded8ce] bg-white p-12 text-center text-xs text-[#838e88]">
                Belum ada produk yang cocok dengan pencarian Anda.
            </div>
        @endforelse
    </div>

    <div class="mt-8">
        {{ $variants->links() }}
    </div>
</div>

@endsection
