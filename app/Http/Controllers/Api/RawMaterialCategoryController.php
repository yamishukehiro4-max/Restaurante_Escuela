<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\RawMaterialCategory;
use Illuminate\Http\Request;

class RawMaterialCategoryController extends Controller
{
    public function index()
    {
        return response()->json(RawMaterialCategory::with('rawMaterials')->get(), 200);
    }

    public function store(Request $request)
    {
        $data = $request->validate(['name' => 'required|string|max:100']);
        return response()->json(RawMaterialCategory::create($data), 201);
    }

    public function show(RawMaterialCategory $rawMaterialCategory)
    {
        return response()->json($rawMaterialCategory->load('rawMaterials'), 200);
    }

    public function update(Request $request, RawMaterialCategory $rawMaterialCategory)
    {
        $data = $request->validate(['name' => 'sometimes|string|max:100']);
        $rawMaterialCategory->update($data);
        return response()->json($rawMaterialCategory, 200);
    }

    public function destroy(RawMaterialCategory $rawMaterialCategory)
    {
        $rawMaterialCategory->delete();
        return response()->json(['message' => 'Categoría eliminada'], 200);
    }
}