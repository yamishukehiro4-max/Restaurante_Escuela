<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\GasProration;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class GasProrationController extends Controller
{
    public function index()
    {
        return response()->json(GasProration::with(['rawMaterial', 'user'])->get(), 200);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'raw_material_id' => 'required|exists:raw_materials,id',
            'start_date'      => 'required|date',
            'total_cost'      => 'required|numeric|min:0',
            'days'            => 'required|integer|min:1',
            'user_id'         => 'required|exists:users,id',
        ]);

        $start = Carbon::parse($data['start_date']);
        $end = $start->copy()->addDays($data['days']);
        $dailyCost = $data['total_cost'] / $data['days'];

        $proration = GasProration::create([
            'raw_material_id' => $data['raw_material_id'],
            'start_date'      => $start,
            'end_date'        => $end,
            'total_cost'      => $data['total_cost'],
            'daily_cost'      => $dailyCost,
            'user_id'         => $data['user_id'],
        ]);

        return response()->json([
            'proration'  => $proration->load(['rawMaterial', 'user']),
            'daily_cost' => $dailyCost,
            'message'    => "Prorrateo creado: \${$dailyCost} por día durante {$data['days']} días.",
        ], 201);
    }

    public function show(GasProration $gasProration)
    {
        return response()->json($gasProration->load(['rawMaterial', 'user']), 200);
    }

    public function update(Request $request, GasProration $gasProration)
    {
        $data = $request->validate([
            'total_cost' => 'sometimes|numeric|min:0',
        ]);
        $gasProration->update($data);
        return response()->json($gasProration, 200);
    }

    public function destroy(GasProration $gasProration)
    {
        $gasProration->delete();
        return response()->json(['message' => 'Prorrateo eliminado'], 200);
    }
}