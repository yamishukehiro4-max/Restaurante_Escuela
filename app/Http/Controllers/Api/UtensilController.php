<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Utensil;
use Illuminate\Http\Request;

class UtensilController extends Controller
{
    public function index()
    {
        return response()->json(Utensil::all(), 200);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'               => 'required|string|max:150',
            'category'           => 'required|string|max:100',
            'quantity_total'     => 'integer|min:0',
            'quantity_available' => 'integer|min:0',
            'quantity_damaged'   => 'integer|min:0',
            'unit_measure'       => 'string|max:50',
        ]);
        return response()->json(Utensil::create($data), 201);
    }

    public function show(Utensil $utensil)
    {
        return response()->json($utensil, 200);
    }

    public function update(Request $request, Utensil $utensil)
    {
        $data = $request->validate([
            'name'               => 'sometimes|string|max:150',
            'category'           => 'sometimes|string|max:100',
            'quantity_total'     => 'integer|min:0',
            'quantity_available' => 'integer|min:0',
            'quantity_damaged'   => 'integer|min:0',
            'unit_measure'       => 'string|max:50',
        ]);
        $utensil->update($data);
        return response()->json($utensil, 200);
    }

    public function destroy(Utensil $utensil)
    {
        $utensil->delete();
        return response()->json(['message' => 'Utensilio eliminado'], 200);
    }
}