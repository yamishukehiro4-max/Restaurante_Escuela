<?php

namespace App\Http\Controllers;

use App\Models\RawMaterial;
use App\Models\RawMaterialCategory;
use Illuminate\Http\Request;

class RawMaterialWebController extends Controller
{
    public function index()
    {
        $materials = RawMaterial::with('category')->orderBy('name')->paginate(15);
        $categories = RawMaterialCategory::orderBy('name')->get();
        return view('admin.raw-materials.index', compact('materials', 'categories'));
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
        $data['is_perishable'] = $request->boolean('is_perishable');
        RawMaterial::create($data);
        return back()->with('success', 'Materia prima creada.');
    }

    public function update(Request $request, RawMaterial $rawMaterial)
    {
        $data = $request->validate([
            'category_id'   => 'required|exists:raw_material_categories,id',
            'name'          => 'required|string|max:150',
            'code'          => 'required|string|unique:raw_materials,code,' . $rawMaterial->id,
            'unit_measure'  => 'required|string|max:50',
            'stock_current' => 'numeric|min:0',
            'is_perishable' => 'boolean',
        ]);
        $data['is_perishable'] = $request->boolean('is_perishable');
        $rawMaterial->update($data);
        return back()->with('success', 'Materia prima actualizada.');
    }

    public function destroy(RawMaterial $rawMaterial)
    {
        $rawMaterial->delete();
        return back()->with('success', 'Materia prima eliminada.');
    }
}