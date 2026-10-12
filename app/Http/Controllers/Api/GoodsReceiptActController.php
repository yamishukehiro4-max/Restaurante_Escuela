<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\GoodsReceiptAct;
use Illuminate\Http\Request;

class GoodsReceiptActController extends Controller
{
    public function index()
    {
        return response()->json(GoodsReceiptAct::with(['purchaseOrder', 'receiver'])->get(), 200);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'purchase_order_id' => 'required|exists:purchase_orders,id',
            'received_date'     => 'required|date',
            'receiver_id'       => 'required|exists:users,id',
            'observations'      => 'nullable|string',
        ]);
        return response()->json(GoodsReceiptAct::create($data)->load(['purchaseOrder', 'receiver']), 201);
    }

    public function show(GoodsReceiptAct $goodsReceiptAct)
    {
        return response()->json($goodsReceiptAct->load(['purchaseOrder', 'receiver']), 200);
    }

    public function update(Request $request, GoodsReceiptAct $goodsReceiptAct)
    {
        $data = $request->validate(['observations' => 'nullable|string']);
        $goodsReceiptAct->update($data);
        return response()->json($goodsReceiptAct, 200);
    }

    public function destroy(GoodsReceiptAct $goodsReceiptAct)
    {
        $goodsReceiptAct->delete();
        return response()->json(['message' => 'Acta eliminada'], 200);
    }
}