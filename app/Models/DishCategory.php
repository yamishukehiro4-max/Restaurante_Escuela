<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DishCategory extends Model
{
    protected $fillable = ['name', 'description'];

    public function dishes()
    {
        return $this->hasMany(Dish::class, 'category_id');
    }
}