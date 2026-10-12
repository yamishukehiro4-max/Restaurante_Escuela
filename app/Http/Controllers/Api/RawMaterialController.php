<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\RawMaterial;
use Illuminate\Http\Request;

class RawMaterialController extends Controller
{
    public function index()
    {
        return response()->json(RawMaterial::with('category')->get(), 200);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'category_id'   => 'required|exists:raw_material_categories,id',
            'name'          => 'required|string|max:150',
            'code'          => 'required|string|unique:raw_materials,code',
            'unit_measure'  => 'required|string|max:50',
            'stock_current' => 'numeric|min:0',
            'is_perishable' => 'boolean',
        ]);
        return response()->json(RawMaterial::create($data)->load('category'), 201);
    }

    public function show(RawMaterial $rawMaterial)
    {
        return response()->json($rawMaterial->load(['category', 'movements']), 200);
    }

    public function update(Request $request, RawMaterial $rawMaterial)
    {
        $data = $request->validate([
            'category_id'   => 'sometimes|exists:raw_material_categories,id',
            'name'          => 'sometimes|string|max:150',
            'code'          => 'sometimes|string|unique:raw_materials,code,' . $rawMaterial->id,
            'unit_measure'  => 'sometimes|string|max:50',
            'stock_current' => 'numeric|min:0',
            'is_perishable' => 'boolean',
        ]);
        $rawMaterial->update($data);
        return response()->json($rawMaterial->load('category'), 200);
    }

    public function destroy(RawMaterial $rawMaterial)
    {
        $rawMaterial->delete();
        return response()->json(['message' => 'Materia prima eliminada'], 200);
    }
}