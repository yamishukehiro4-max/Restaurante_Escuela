<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PurchaseOrder;
use Illuminate\Http\Request;

class PurchaseOrderController extends Controller
{
    public function index()
    {
        return response()->json(PurchaseOrder::with(['supplier', 'user'])->get(), 200);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'user_id'     => 'required|exists:users,id',
            'order_date'  => 'required|date',
            'total_cost'  => 'numeric|min:0',
            'status'      => 'in:Emitida,Recibida,Cancelada',
        ]);
        return response()->json(PurchaseOrder::create($data)->load(['supplier', 'user']), 201);
    }

    public function show(PurchaseOrder $purchaseOrder)
    {
        return response()->json($purchaseOrder->load(['supplier', 'user', 'goodsReceipts', 'invoices']), 200);
    }

    public function update(Request $request, PurchaseOrder $purchaseOrder)
    {
        $data = $request->validate([
            'supplier_id' => 'sometimes|exists:suppliers,id',
            'user_id'     => 'sometimes|exists:users,id',
            'order_date'  => 'sometimes|date',
            'total_cost'  => 'numeric|min:0',
            'status'      => 'in:Emitida,Recibida,Cancelada',
        ]);
        $purchaseOrder->update($data);
        return response()->json($purchaseOrder->load(['supplier', 'user']), 200);
    }

    public function destroy(PurchaseOrder $purchaseOrder)
    {
        $purchaseOrder->delete();
        return response()->json(['message' => 'Orden eliminada'], 200);
    }
}