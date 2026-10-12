<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseInvoice extends Model
{
    protected $fillable = ['purchase_order_id', 'invoice_number', 'invoice_date', 'total', 'payment_status'];
    protected $casts    = ['invoice_date' => 'date', 'total' => 'decimal:2'];

    public function purchaseOrder()
    {
        return $this->belongsTo(PurchaseOrder::class);
    }
}