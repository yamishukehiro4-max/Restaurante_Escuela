<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index()
    {
        return response()->json(Supplier::all(), 200);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'         => 'required|string|max:150',
            'contact_name' => 'nullable|string|max:150',
            'phone'        => 'nullable|string|max:30',
            'email'        => 'nullable|email|max:150',
            'address'      => 'nullable|string',
            'status'       => 'in:Activo,Inactivo',
        ]);
        return response()->json(Supplier::create($data), 201);
    }

    public function show(Supplier $supplier)
    {
        return response()->json($supplier->load('purchaseOrders'), 200);
    }

    public function update(Request $request, Supplier $supplier)
    {
        $data = $request->validate([
            'name'         => 'sometimes|string|max:150',
            'contact_name' => 'nullable|string|max:150',
            'phone'        => 'nullable|string|max:30',
            'email'        => 'nullable|email|max:150',
            'address'      => 'nullable|string',
            'status'       => 'in:Activo,Inactivo',
        ]);
        $supplier->update($data);
        return response()->json($supplier, 200);
    }

    public function destroy(Supplier $supplier)
    {
        $supplier->delete();
        return response()->json(['message' => 'Proveedor eliminado'], 200);
    }
}