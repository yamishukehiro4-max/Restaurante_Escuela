<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SaleDetail extends Model
{
    protected $fillable = ['sale_id', 'dish_id', 'quantity', 'unit_price', 'subtotal'];
    protected $casts    = ['unit_price' => 'decimal:2', 'subtotal' => 'decimal:2'];

    public function sale()
    {
        return $this->belongsTo(Sale::class);
    }

    public function dish()
    {
        return $this->belongsTo(Dish::class);
    }
}