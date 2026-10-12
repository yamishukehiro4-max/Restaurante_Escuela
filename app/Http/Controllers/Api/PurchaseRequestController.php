<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PurchaseRequest;
use Illuminate\Http\Request;

class PurchaseRequestController extends Controller
{
    public function index()
    {
        return response()->json(PurchaseRequest::with('chef')->get(), 200);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'chef_id'      => 'required|exists:users,id',
            'request_date' => 'required|date',
            'status'       => 'in:Pendiente,Aprobada,Rechazada',
        ]);
        return response()->json(PurchaseRequest::create($data)->load('chef'), 201);
    }

    public function show(PurchaseRequest $purchaseRequest)
    {
        return response()->json($purchaseRequest->load('chef'), 200);
    }

    public function update(Request $request, PurchaseRequest $purchaseRequest)
    {
        $data = $request->validate([
            'chef_id'      => 'sometimes|exists:users,id',
            'request_date' => 'sometimes|date',
            'status'       => 'sometimes|in:Pendiente,Aprobada,Rechazada',
        ]);
        $purchaseRequest->update($data);
        return response()->json($purchaseRequest, 200);
    }

    public function destroy(PurchaseRequest $purchaseRequest)
    {
        $purchaseRequest->delete();
        return response()->json(['message' => 'Solicitud eliminada'], 200);
    }
}