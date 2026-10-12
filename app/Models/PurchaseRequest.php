<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseRequest extends Model
{
    protected $fillable = ['chef_id', 'request_date', 'status'];
    protected $casts    = ['request_date' => 'date'];

    public function chef()
    {
        return $this->belongsTo(User::class, 'chef_id');
    }
}