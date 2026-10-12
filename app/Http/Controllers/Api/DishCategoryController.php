<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DishCategory;
use Illuminate\Http\Request;

class DishCategoryController extends Controller
{
    public function index()
    {
        return response()->json(DishCategory::with('dishes')->get(), 200);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'        => 'required|string|max:100',
            'description' => 'nullable|string',
        ]);
        return response()->json(DishCategory::create($data), 201);
    }

    public function show(DishCategory $dishCategory)
    {
        return response()->json($dishCategory->load('dishes'), 200);
    }

    public function update(Request $request, DishCategory $dishCategory)
    {
        $data = $request->validate([
            'name'        => 'sometimes|string|max:100',
            'description' => 'nullable|string',
        ]);
        $dishCategory->update($data);
        return response()->json($dishCategory, 200);
    }

    public function destroy(DishCategory $dishCategory)
    {
        $dishCategory->delete();
        return response()->json(['message' => 'Categoría eliminada'], 200);
    }
}