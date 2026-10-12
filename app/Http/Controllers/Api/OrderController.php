<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        return response()->json(Order::with(['customer', 'user'])->get(), 200);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'customer_id' => 'nullable|exists:customers,id',
            'user_id'     => 'required|exists:users,id',
            'order_date'  => 'required|date',
            'status'      => 'in:Pendiente,EnPreparacion,Listo,Entregado,Cancelado',
            'total'       => 'numeric|min:0',
            'notes'       => 'nullable|string',
        ]);
        return response()->json(Order::create($data)->load(['customer', 'user']), 201);
    }

    public function show(Order $order)
    {
        return response()->json($order->load(['customer', 'user']), 200);
    }

    public function update(Request $request, Order $order)
    {
        $data = $request->validate([
            'status' => 'sometimes|in:Pendiente,EnPreparacion,Listo,Entregado,Cancelado',
            'notes'  => 'nullable|string',
            'total'  => 'sometimes|numeric|min:0',
        ]);
        $order->update($data);
        return response()->json($order, 200);
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return response()->json(['message' => 'Pedido eliminado'], 200);
    }
}