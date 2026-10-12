<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RawMaterialMovement extends Model
{
    protected $fillable = ['raw_material_id', 'type', 'quantity', 'reason', 'user_id'];
    protected $casts    = ['quantity' => 'decimal:2'];

    public function rawMaterial()
    {
        return $this->belongsTo(RawMaterial::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}