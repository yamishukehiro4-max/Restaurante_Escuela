<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dish extends Model
{
    protected $fillable = ['category_id', 'name', 'description', 'price', 'is_active'];
    protected $casts    = ['is_active' => 'boolean', 'price' => 'decimal:2'];

    public function category()
    {
        return $this->belongsTo(DishCategory::class, 'category_id');
    }

    public function recipes()
    {
        return $this->hasMany(Recipe::class);
    }

    public function saleDetails()
    {
        return $this->hasMany(SaleDetail::class);
    }
}