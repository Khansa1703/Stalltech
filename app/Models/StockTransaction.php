<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StockTransaction extends Model
{
    protected $fillable = ['material_id', 'product_variant_id', 'type', 'quantity', 'reference_type', 'reference_id', 'notes'];
    protected $casts = ['quantity' => 'decimal:2'];
    public function material() { return $this->belongsTo(Material::class); }
    public function variant() { return $this->belongsTo(ProductVariant::class, 'product_variant_id'); }
}
