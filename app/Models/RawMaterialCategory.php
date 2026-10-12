<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RawMaterialCategory extends Model
{
    protected $fillable = ['name'];

    public function rawMaterials()
    {
        return $this->hasMany(RawMaterial::class, 'category_id');
    }
}