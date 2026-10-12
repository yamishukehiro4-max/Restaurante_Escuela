<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    protected $fillable = ['supplier_id', 'user_id', 'order_date', 'total_cost', 'status'];
    protected $casts    = ['order_date' => 'date', 'total_cost' => 'decimal:2'];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function goodsReceipts()
    {
        return $this->hasMany(GoodsReceiptAct::class, 'purchase_order_id');
    }

    public function invoices()
    {
        return $this->hasMany(PurchaseInvoice::class, 'purchase_order_id');
    }
}