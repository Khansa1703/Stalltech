<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    protected $fillable = ['product_id', 'motorcycle_type_id', 'name', 'size', 'photo', 'price', 'stock'];
    protected $casts = ['price' => 'integer', 'stock' => 'integer'];

    public function product() { return $this->belongsTo(Product::class); }
    public function motorcycleType() { return $this->belongsTo(MotorcycleType::class); }
    public function bom() { return $this->hasOne(Bom::class); }
    public function orderItems() { return $this->hasMany(OrderItem::class); }

    public function dimension(): string
    {
        return $this->size === 'Jumbo' ? '60 x 100 cm' : '46 x 90 cm';
    }

    public function sizeLabel(): string
    {
        return $this->size . ' (' . $this->dimension() . ')';
    }
}
