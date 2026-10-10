<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $fillable = ['code', 'name', 'unit', 'current_stock', 'minimum_stock', 'material_cost'];
    protected $casts = ['current_stock' => 'decimal:2', 'minimum_stock' => 'decimal:2', 'material_cost' => 'integer'];

    public function bomItems() { return $this->hasMany(BomItem::class); }
    public function stockTransactions() { return $this->hasMany(StockTransaction::class); }
    public function isLowStock(): bool { return $this->current_stock <= $this->minimum_stock; }
}
