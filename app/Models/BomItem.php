<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BomItem extends Model
{
    protected $fillable = ['bom_id', 'item_type', 'material_id', 'item_name', 'quantity', 'unit', 'material_cost'];
    protected $casts = ['quantity' => 'decimal:2', 'material_cost' => 'integer'];
    public function bom() { return $this->belongsTo(Bom::class); }
    public function material() { return $this->belongsTo(Material::class); }
    public function isService(): bool { return $this->item_type === 'service'; }
    public function displayName(): string { return $this->material?->name ?: ($this->item_name ?: 'Komponen BOM'); }
}
