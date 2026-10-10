<?php

namespace App\Http\Controllers;

use App\Models\Alert;
use App\Models\Order;
use App\Services\OrderService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $orders = $request->user()->orders()->with('payment')->latest()->paginate(10);
        return view('orders.index', compact('orders'));
    }

    public function show(Request $request, Order $order)
    {
        abort_unless($request->user()->isOwner() || $order->user_id === $request->user()->id, 403);
        $order->load(['items.variant.product', 'items.variant.motorcycleType', 'payment']);
        return view('orders.show', compact('order'));
    }

    public function updateStatus(Request $request, Order $order, OrderService $service)
    {
        $data = $request->validate(['status' => ['required', 'in:process,delivery,finish,cancel']]);
        if ($data['status'] === 'delivery') {
            $request->validate(['tracking_number' => ['required', 'string', 'max:100']]);
            $order->tracking_number = $request->tracking_number;
        }
        $order->status = $data['status'];
        $order->save();
        Alert::create(['user_id' => $order->user_id, 'type' => 'order', 'message' => "Status order {$order->order_number} berubah menjadi " . ucfirst($data['status']) . '.']);
        return back()->with('success', 'Status order diperbarui.');
    }

    public function verifyPayment(Request $request, Order $order, OrderService $service)
    {
        $data = $request->validate(['decision' => ['required', 'in:approve,reject'], 'notes' => ['nullable', 'string']]);
        $payment = $order->payment;
        abort_unless($payment && $payment->status === 'submitted', 422, 'Pembayaran belum dikirim customer.');
        if ($data['decision'] === 'reject') {
            $payment->update(['status' => 'rejected', 'verified_by' => $request->user()->id, 'verified_at' => now(), 'notes' => $data['notes'] ?? null]);
            Alert::create(['user_id' => $order->user_id, 'type' => 'payment', 'message' => "Pembayaran order {$order->order_number} ditolak."]);
            return back()->with('success', 'Pembayaran ditolak.');
        }
        $payment->update(['status' => 'verified', 'verified_by' => $request->user()->id, 'verified_at' => now(), 'notes' => $data['notes'] ?? null]);
        try {
            $service->approve($order->fresh(), $request->user()->id);
        } catch (\Throwable $exception) {
            $payment->update(['status' => 'submitted', 'verified_by' => null, 'verified_at' => null]);
            throw $exception;
        }
        return back()->with('success', 'Pembayaran disetujui dan stok diperbarui.');
    }
}
