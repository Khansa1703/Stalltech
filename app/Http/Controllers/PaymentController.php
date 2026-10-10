<?php

namespace App\Http\Controllers;

use App\Models\Alert;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function store(Request $request, Order $order)
    {
        abort_unless($order->user_id === $request->user()->id, 403);
        $data = $request->validate(['amount' => ['required', 'integer', 'min:1'], 'proof' => ['required', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:5120']]);
        $path = $request->file('proof')->store('payment-proofs', 'public');
        $order->payment()->update(['amount' => $data['amount'], 'proof_path' => $path, 'status' => 'submitted']);
        Alert::create(['user_id' => UserOwnerId(), 'type' => 'payment', 'message' => "Bukti pembayaran {$order->order_number} siap diverifikasi."]);
        return back()->with('success', 'Bukti pembayaran berhasil diunggah.');
    }
}
