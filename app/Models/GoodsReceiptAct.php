<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GoodsReceiptAct extends Model
{
    protected $fillable = ['purchase_order_id', 'received_date', 'receiver_id', 'observations'];
    protected $casts    = ['received_date' => 'date'];

    public function purchaseOrder()
    {
        return $this->belongsTo(PurchaseOrder::class);
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }
}