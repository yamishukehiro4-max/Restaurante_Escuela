<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CashRegisterClosing;
use App\Models\Sale;
use Illuminate\Http\Request;

class CashRegisterClosingController extends Controller
{
    public function index()
    {
        return response()->json(CashRegisterClosing::with('user')->get(), 200);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id'      => 'required|exists:users,id',
            'closing_date' => 'required|date',
            'initial_cash' => 'required|numeric|min:0',
            'actual_total' => 'required|numeric|min:0',
        ]);

        $salesTotal = Sale::whereDate('sale_date', $data['closing_date'])->sum('total_amount');
        $expected = $data['initial_cash'] + $salesTotal;
        $discrepancy = $data['actual_total'] - $expected;

        $closing = CashRegisterClosing::create([
            'user_id'        => $data['user_id'],
            'closing_date'   => $data['closing_date'],
            'initial_cash'   => $data['initial_cash'],
            'expected_total' => $expected,
            'actual_total'   => $data['actual_total'],
            'discrepancy'    => $discrepancy,
        ]);

        return response()->json([
            'closing'     => $closing->load('user'),
            'sales_total' => $salesTotal,
            'status'      => $discrepancy >= 0 ? 'CUADRADO' : 'FALTANTE_REGISTRADO_COMO_AUTOCONSUMO',
        ], 201);
    }

    public function show(CashRegisterClosing $cashRegisterClosing)
    {
        return response()->json($cashRegisterClosing->load('user'), 200);
    }

    public function update(Request $request, CashRegisterClosing $cashRegisterClosing)
    {
        $data = $request->validate([
            'actual_total' => 'sometimes|numeric|min:0',
        ]);

        if (isset($data['actual_total'])) {
            $data['discrepancy'] = $data['actual_total'] - $cashRegisterClosing->expected_total;
        }

        $cashRegisterClosing->update($data);
        return response()->json($cashRegisterClosing, 200);
    }

    public function destroy(CashRegisterClosing $cashRegisterClosing)
    {
        $cashRegisterClosing->delete();
        return response()->json(['message' => 'Cierre eliminado'], 200);
    }
}