<?php

namespace App\Http\Controllers;

use App\Models\MotorcycleType;
use App\Models\ProductVariant;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function home()
    {
        return view('store.home', ['featured' => ProductVariant::with(['product', 'motorcycleType'])->whereHas('product', fn ($q) => $q->where('is_active', true))->latest()->take(6)->get()]);
    }

    public function catalog(Request $request)
    {
        $types = MotorcycleType::orderBy('name')->get();
        $variants = ProductVariant::with(['product', 'motorcycleType'])->whereHas('product', fn ($q) => $q->where('is_active', true))
            ->when($request->motorcycle_type_id, fn ($q, $id) => $q->where('motorcycle_type_id', $id))
            ->when($request->search, fn ($q, $search) => $q->where(function ($query) use ($search) { $query->where('name', 'like', "%{$search}%")->orWhereHas('product', fn ($p) => $p->where('name', 'like', "%{$search}%")); }))
            ->latest()->paginate(12)->withQueryString();
        return view('store.catalog', compact('types', 'variants'));
    }

    public function addToCart(Request $request, ProductVariant $variant)
    {
        $quantity = max(1, (int) $request->input('quantity', 1));
        abort_if($variant->stock < $quantity, 422, 'Stok produk tidak mencukupi.');
        $cart = $request->session()->get('cart', []);
        $cart[$variant->id] = min($variant->stock, ($cart[$variant->id] ?? 0) + $quantity);
        $request->session()->put('cart', $cart);
        return back()->with('success', 'Produk ditambahkan ke keranjang.');
    }

    public function cart(Request $request)
    {
        $cart = $request->session()->get('cart', []);
        $variants = ProductVariant::with(['product', 'motorcycleType'])->whereIn('id', array_keys($cart))->get()->keyBy('id');
        $subtotal = collect($cart)->map(fn ($quantity, $id) => ($variants[$id]->price ?? 0) * $quantity)->sum();
        return view('store.cart', compact('cart', 'variants', 'subtotal'));
    }

    public function updateCart(Request $request)
    {
        $cart = [];
        foreach ($request->input('quantity', []) as $id => $quantity) {
            $variant = ProductVariant::find($id);
            if ($variant && $quantity > 0) $cart[$id] = min((int) $quantity, $variant->stock);
        }
        $request->session()->put('cart', $cart);
        return back()->with('success', 'Keranjang diperbarui.');
    }
}
