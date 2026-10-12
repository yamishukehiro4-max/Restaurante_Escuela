<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Sale;
use App\Models\Dish;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SaleController extends Controller
{
    public function index()
    {
        return response()->json(Sale::with(['user', 'details.dish'])->get(), 200);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id'          => 'required|exists:users,id',
            'sale_date'        => 'required|date',
            'payment_method'   => 'nullable|string|max:50',
            'items'            => 'required|array|min:1',
            'items.*.dish_id'  => 'required|exists:dishes,id',
            'items.*.quantity' => 'required|integer|min:1',
        ]);

        DB::beginTransaction();
        try {
            $total = 0;
            $sale = Sale::create([
                'user_id'        => $data['user_id'],
                'sale_date'      => $data['sale_date'],
                'payment_method' => $data['payment_method'] ?? 'Efectivo',
                'total_amount'   => 0,
            ]);

            foreach ($data['items'] as $item) {
                $dish = Dish::findOrFail($item['dish_id']);
                $subtotal = $dish->price * $item['quantity'];
                $total += $subtotal;

                $sale->details()->create([
                    'dish_id'    => $dish->id,
                    'quantity'   => $item['quantity'],
                    'unit_price' => $dish->price,
                    'subtotal'   => $subtotal,
                ]);
            }

            $sale->update(['total_amount' => $total]);
            DB::commit();

            return response()->json($sale->load('details.dish', 'user'), 201);
        } catch (\Throwable $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function show(Sale $sale)
    {
        return response()->json($sale->load(['user', 'details.dish']), 200);
    }

    public function update(Request $request, Sale $sale)
    {
        $data = $request->validate([
            'payment_method' => 'sometimes|string|max:50',
        ]);
        $sale->update($data);
        return response()->json($sale, 200);
    }

    public function destroy(Sale $sale)
    {
        $sale->delete();
        return response()->json(['message' => 'Venta eliminada'], 200);
    }
}