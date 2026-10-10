<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = ['order_id', 'amount', 'proof_path', 'status', 'verified_by', 'verified_at', 'notes'];
    protected $casts = ['amount' => 'integer', 'verified_at' => 'datetime'];
    public function order() { return $this->belongsTo(Order::class); }
    public function verifier() { return $this->belongsTo(User::class, 'verified_by'); }
}
