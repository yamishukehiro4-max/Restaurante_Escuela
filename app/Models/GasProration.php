<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GasProration extends Model
{
    protected $table = 'gas_proration';

    protected $fillable = [
        'raw_material_id',
        'start_date',
        'end_date',
        'total_cost',
        'daily_cost',
        'user_id',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date'   => 'date',
        'total_cost' => 'decimal:2',
        'daily_cost' => 'decimal:2',
    ];

    public function rawMaterial()
    {
        return $this->belongsTo(RawMaterial::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}