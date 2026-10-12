<?php

namespace App\Http\Controllers;

use App\Models\Dish;
use App\Models\Sale;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SaleWebController extends Controller
{
    public function index()
    {
        $sales = Sale::with(['user', 'details.dish'])->orderBy('sale_date', 'desc')->paginate(15);
        $dishes = Dish::where('is_active', true)->orderBy('name')->get();
        $users = User::orderBy('name')->get();
        return view('admin.sales.index', compact('sales', 'dishes', 'users'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required|exists:users,id',
            'sale_date' => 'required|date',
            'payment_method' => 'required|string',
            'items' => 'required|array|min:1',
            'items.*.dish_id' => 'required|exists:dishes,id',
            'items.*.quantity' => 'required|integer|min:1',
        ]);

        DB::beginTransaction();
        try {
            $total = 0;
            $sale = Sale::create([
                'user_id' => $data['user_id'],
                'sale_date' => $data['sale_date'],
                'payment_method' => $data['payment_method'],
                'total_amount' => 0,
            ]);

            foreach ($data['items'] as $item) {
                $dish = Dish::with('recipes.rawMaterial')->findOrFail($item['dish_id']);
                $subtotal = $dish->price * $item['quantity'];
                $total += $subtotal;

                $sale->details()->create([
                    'dish_id' => $dish->id,
                    'quantity' => $item['quantity'],
                    'unit_price' => $dish->price,
                    'subtotal' => $subtotal,
                ]);

                // Descontar stock según receta
                foreach ($dish->recipes as $recipe) {
                    if ($recipe->rawMaterial) {
                        $recipe->rawMaterial->decrement('stock_current', $recipe->quantity_required * $item['quantity']);
                    }
                }
            }

            $sale->update(['total_amount' => $total]);
            DB::commit();
            return back()->with('success', "Venta #{$sale->id} registrada. Total: \${$total}");
        } catch (\Throwable $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }

    public function destroy(Sale $sale)
    {
        $sale->delete();
        return back()->with('success', 'Venta eliminada.');
    }
}