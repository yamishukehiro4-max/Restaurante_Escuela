<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    protected $fillable = ['dish_id', 'raw_material_id', 'quantity_required'];
    protected $casts    = ['quantity_required' => 'decimal:2'];

    public function dish()
    {
        return $this->belongsTo(Dish::class);
    }

    public function rawMaterial()
    {
        return $this->belongsTo(RawMaterial::class);
    }
}