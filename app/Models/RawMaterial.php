<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RawMaterial extends Model
{
    protected $fillable = ['category_id', 'name', 'code', 'unit_measure', 'stock_current', 'is_perishable'];
    protected $casts    = ['is_perishable' => 'boolean', 'stock_current' => 'decimal:2'];

    public function category()
    {
        return $this->belongsTo(RawMaterialCategory::class, 'category_id');
    }

    public function movements()
    {
        return $this->hasMany(RawMaterialMovement::class);
    }

    public function recipes()
    {
        return $this->hasMany(Recipe::class);
    }
}