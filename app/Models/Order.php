<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['user_id', 'order_number', 'shipping_address', 'shipping_phone', 'subtotal', 'shipping_cost', 'total', 'status', 'tracking_number', 'approved_at'];
    protected $casts = ['subtotal' => 'integer', 'shipping_cost' => 'integer', 'total' => 'integer', 'approved_at' => 'datetime'];
    public function user() { return $this->belongsTo(User::class); }
    public function items() { return $this->hasMany(OrderItem::class); }
    public function payment() { return $this->hasOne(Payment::class); }
    public function statusLabel(): string { return ucfirst($this->status); }
}
