<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExternalEvent extends Model
{
    protected $fillable = ['name', 'client_name', 'client_phone', 'event_date', 'guest_count', 'quoted_price', 'status', 'approved_by', 'notes'];
    protected $casts    = ['event_date' => 'datetime', 'quoted_price' => 'decimal:2'];

    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
}