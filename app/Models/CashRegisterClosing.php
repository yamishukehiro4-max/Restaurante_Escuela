<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CashRegisterClosing extends Model
{
    protected $fillable = ['user_id', 'closing_date', 'initial_cash', 'expected_total', 'actual_total', 'discrepancy'];
    protected $casts    = ['closing_date' => 'date'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}