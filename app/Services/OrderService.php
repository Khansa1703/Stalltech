<?php

namespace App\Services;

use App\Models\Alert;
use App\Models\Order;
use App\Models\StockTransaction;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class OrderService
{
    public function approve(Order $order, int $ownerId): void
    {
        DB::transaction(function () use ($order, $ownerId) {
            $order->loadMissing('items.variant.bom.items.material', 'user');

            if ($order->status !== 'pending' || $order->payment?->status !== 'verified') {
                throw ValidationException::withMessages(['order' => 'Order harus pending dan pembayarannya sudah diverifikasi.']);
            }

            foreach ($order->items as $item) {
                if ($item->variant->stock < $item->quantity) {
                    throw ValidationException::withMessages(['stock' => "Stok {$item->variant->name} tidak mencukupi."]);
                }
            }

            $materialNeeds = [];
            foreach ($order->items as $item) {
                $item->variant->decrement('stock', $item->quantity);
                StockTransaction::create([
                    'product_variant_id' => $item->variant->id,
                    'type' => 'out',
                    'quantity' => $item->quantity,
                    'reference_type' => 'order',
                    'reference_id' => $order->id,
                    'notes' => "Order {$order->order_number}",
                ]);

                foreach ($item->variant->bom?->items->where('item_type', 'material') ?? [] as $bomItem) {
                    $materialNeeds[$bomItem->material_id] = ($materialNeeds[$bomItem->material_id] ?? 0) + ($bomItem->quantity * $item->quantity);
                }
            }

            foreach ($materialNeeds as $materialId => $quantity) {
                $material = \App\Models\Material::query()->lockForUpdate()->findOrFail($materialId);
                if ($material->current_stock < $quantity) {
                    throw ValidationException::withMessages(['stock' => "Stok material {$material->name} tidak mencukupi."]);
                }
                $material->decrement('current_stock', $quantity);
                StockTransaction::create([
                    'material_id' => $material->id,
                    'type' => 'out',
                    'quantity' => $quantity,
                    'reference_type' => 'order',
                    'reference_id' => $order->id,
                    'notes' => "BOM order {$order->order_number}",
                ]);
                if ($material->fresh()->isLowStock()) {
                    Alert::create(['user_id' => $ownerId, 'type' => 'low_stock', 'message' => "Stok material {$material->name} mencapai batas minimum."]);
                }
            }

            $order->update(['status' => 'approve', 'approved_at' => now()]);
            Alert::create(['user_id' => $order->user_id, 'type' => 'order', 'message' => "Pembayaran order {$order->order_number} diterima."]);
        });
    }
}
