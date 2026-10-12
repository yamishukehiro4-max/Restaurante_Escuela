<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Dish;
use Illuminate\Http\Request;

class DishController extends Controller
{
    public function index()
    {
        return response()->json(Dish::with('category')->get(), 200);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'category_id' => 'required|exists:dish_categories,id',
            'name'        => 'required|string|max:150',
            'description' => 'nullable|string',
            'price'       => 'required|numeric|min:0',
            'is_active'   => 'boolean',
        ]);
        return response()->json(Dish::create($data)->load('category'), 201);
    }

    public function show(Dish $dish)
    {
        return response()->json($dish->load(['category', 'recipes.rawMaterial']), 200);
    }

    public function update(Request $request, Dish $dish)
    {
        $data = $request->validate([
            'category_id' => 'sometimes|exists:dish_categories,id',
            'name'        => 'sometimes|string|max:150',
            'description' => 'nullable|string',
            'price'       => 'sometimes|numeric|min:0',
            'is_active'   => 'boolean',
        ]);
        $dish->update($data);
        return response()->json($dish->load('category'), 200);
    }

    public function destroy(Dish $dish)
    {
        $dish->delete();
        return response()->json(['message' => 'Platillo eliminado'], 200);
    }
}