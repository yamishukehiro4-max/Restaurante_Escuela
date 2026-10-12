<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Recipe;
use Illuminate\Http\Request;

class RecipeController extends Controller
{
    public function index()
    {
        return response()->json(Recipe::with(['dish', 'rawMaterial'])->get(), 200);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'dish_id'           => 'required|exists:dishes,id',
            'raw_material_id'   => 'required|exists:raw_materials,id',
            'quantity_required' => 'required|numeric|min:0.01',
        ]);
        return response()->json(Recipe::create($data)->load(['dish', 'rawMaterial']), 201);
    }

    public function show(Recipe $recipe)
    {
        return response()->json($recipe->load(['dish', 'rawMaterial']), 200);
    }

    public function update(Request $request, Recipe $recipe)
    {
        $data = $request->validate([
            'dish_id'           => 'sometimes|exists:dishes,id',
            'raw_material_id'   => 'sometimes|exists:raw_materials,id',
            'quantity_required' => 'sometimes|numeric|min:0.01',
        ]);
        $recipe->update($data);
        return response()->json($recipe->load(['dish', 'rawMaterial']), 200);
    }

    public function destroy(Recipe $recipe)
    {
        $recipe->delete();
        return response()->json(['message' => 'Receta eliminada'], 200);
    }
}