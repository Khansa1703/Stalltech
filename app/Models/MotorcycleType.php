<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MotorcycleType extends Model
{
    protected $fillable = ['name', 'size'];

    public function variants() { return $this->hasMany(ProductVariant::class); }
}
