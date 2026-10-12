<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\RawMaterial;
use App\Models\RawMaterialMovement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RawMaterialMovementController extends Controller
{
    public function index()
    {
        return response()->json(RawMaterialMovement::with(['rawMaterial', 'user'])->get(), 200);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'raw_material_id' => 'required|exists:raw_materials,id',
            'type'            => 'required|in:Entrada,Salida,Merma_Clima,Autoconsumo',
            'quantity'        => 'required|numeric|min:0.01',
            'reason'          => 'nullable|string',
            'user_id'         => 'required|exists:users,id',
        ]);

        DB::beginTransaction();
        try {
            $material = RawMaterial::findOrFail($data['raw_material_id']);

            if (in_array($data['type'], ['Salida', 'Merma_Clima', 'Autoconsumo'])) {
                if ($material->stock_current < $data['quantity']) {
                    return response()->json([
                        'error' => 'Stock insuficiente. Disponible: ' . $material->stock_current,
                    ], 422);
                }
                $material->decrement('stock_current', $data['quantity']);
            } else {
                $material->increment('stock_current', $data['quantity']);
            }

            $movement = RawMaterialMovement::create($data);
            DB::commit();

            return response()->json($movement->load(['rawMaterial', 'user']), 201);
        } catch (\Throwable $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function show(RawMaterialMovement $rawMaterialMovement)
    {
        return response()->json($rawMaterialMovement->load(['rawMaterial', 'user']), 200);
    }

    public function update(Request $request, RawMaterialMovement $rawMaterialMovement)
    {
        $data = $request->validate(['reason' => 'nullable|string']);
        $rawMaterialMovement->update($data);
        return response()->json($rawMaterialMovement, 200);
    }

    public function destroy(RawMaterialMovement $rawMaterialMovement)
    {
        $rawMaterialMovement->delete();
        return response()->json(['message' => 'Movimiento eliminado'], 200);
    }

    public function kardex(RawMaterial $rawMaterial)
    {
        $movements = $rawMaterial->movements()->with('user')->orderBy('created_at', 'asc')->get();
        return response()->json([
            'material'     => $rawMaterial,
            'kardex'       => $movements,
            'stock_actual' => $rawMaterial->stock_current,
        ], 200);
    }
}