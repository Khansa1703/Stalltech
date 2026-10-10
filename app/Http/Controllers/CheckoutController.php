<?php

namespace App\Http\Controllers;

use App\Models\Alert;
use App\Models\Order;
use App\Models\ProductVariant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function create(Request $request)
    {
        $cart = $request->session()->get('cart', []);
        abort_if(empty($cart), 422, 'Keranjang masih kosong.');
        $variants = ProductVariant::with(['product', 'motorcycleType'])->whereIn('id', array_keys($cart))->get()->keyBy('id');
        $subtotal = collect($cart)->map(fn ($quantity, $id) => ($variants[$id]->price ?? 0) * $quantity)->sum();
        return view('store.checkout', compact('cart', 'variants', 'subtotal'));
    }

    public function store(Request $request)
    {
        $data = $request->validate(['shipping_address' => ['required', 'string'], 'shipping_phone' => ['required', 'string', 'max:30'], 'shipping_cost' => ['required', 'integer', 'min:0']]);
        $cart = $request->session()->get('cart', []);
        abort_if(empty($cart), 422, 'Keranjang masih kosong.');
        $order = DB::transaction(function () use ($request, $data, $cart) {
            $variants = ProductVariant::whereIn('id', array_keys($cart))->lockForUpdate()->get()->keyBy('id');
            $subtotal = 0;
            foreach ($cart as $id => $quantity) {
                abort_if(! isset($variants[$id]) || $variants[$id]->stock < $quantity, 422, 'Stok produk berubah. Silakan periksa kembali keranjang.');
                $subtotal += $variants[$id]->price * $quantity;
            }
            $order = Order::create([
                'user_id' => $request->user()->id,
                'order_number' => 'STL-' . now()->format('ymdHis') . '-' . random_int(100, 999),
                'shipping_address' => $data['shipping_address'],
                'shipping_phone' => $data['shipping_phone'],
                'subtotal' => $subtotal,
                'shipping_cost' => $data['shipping_cost'],
                'total' => $subtotal + $data['shipping_cost'],
                'status' => 'pending',
            ]);
            foreach ($cart as $id => $quantity) {
                $order->items()->create(['product_variant_id' => $id, 'quantity' => $quantity, 'unit_price' => $variants[$id]->price, 'subtotal' => $variants[$id]->price * $quantity]);
            }
            $order->payment()->create(['status' => 'unpaid']);
            Alert::create(['user_id' => UserOwnerId(), 'type' => 'payment', 'message' => "Order baru {$order->order_number} menunggu pembayaran."]);
            return $order;
        });
        $request->session()->forget('cart');
        return redirect()->route('orders.show', $order)->with('success', 'Order berhasil dibuat. Silakan transfer dan unggah bukti pembayaran.');
    }
}
