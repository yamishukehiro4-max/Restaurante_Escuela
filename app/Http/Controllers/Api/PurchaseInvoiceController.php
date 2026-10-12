<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PurchaseInvoice;
use Illuminate\Http\Request;

class PurchaseInvoiceController extends Controller
{
    public function index()
    {
        return response()->json(PurchaseInvoice::with('purchaseOrder')->get(), 200);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'purchase_order_id' => 'required|exists:purchase_orders,id',
            'invoice_number'    => 'required|string|max:100',
            'invoice_date'      => 'required|date',
            'total'             => 'required|numeric|min:0',
            'payment_status'    => 'in:Pendiente,Pagado',
        ]);
        return response()->json(PurchaseInvoice::create($data)->load('purchaseOrder'), 201);
    }

    public function show(PurchaseInvoice $purchaseInvoice)
    {
        return response()->json($purchaseInvoice->load('purchaseOrder'), 200);
    }

    public function update(Request $request, PurchaseInvoice $purchaseInvoice)
    {
        $data = $request->validate([
            'invoice_number' => 'sometimes|string|max:100',
            'invoice_date'   => 'sometimes|date',
            'total'          => 'sometimes|numeric|min:0',
            'payment_status' => 'sometimes|in:Pendiente,Pagado',
        ]);
        $purchaseInvoice->update($data);
        return response()->json($purchaseInvoice, 200);
    }

    public function destroy(PurchaseInvoice $purchaseInvoice)
    {
        $purchaseInvoice->delete();
        return response()->json(['message' => 'Factura eliminada'], 200);
    }

    public function markAsPaid(PurchaseInvoice $purchaseInvoice)
    {
        $purchaseInvoice->update(['payment_status' => 'Pagado']);
        return response()->json($purchaseInvoice, 200);
    }
}