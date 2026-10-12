<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierWebController extends Controller
{
    public function index()
    {
        $suppliers = Supplier::orderBy('name')->paginate(15);
        return view('admin.suppliers.index', compact('suppliers'));
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
        Supplier::create($data);
        return back()->with('success', 'Proveedor creado.');
    }

    public function update(Request $request, Supplier $supplier)
    {
        $data = $request->validate([
            'name'         => 'required|string|max:150',
            'contact_name' => 'nullable|string|max:150',
            'phone'        => 'nullable|string|max:30',
            'email'        => 'nullable|email|max:150',
            'address'      => 'nullable|string',
            'status'       => 'in:Activo,Inactivo',
        ]);
        $supplier->update($data);
        return back()->with('success', 'Proveedor actualizado.');
    }

    public function destroy(Supplier $supplier)
    {
        $supplier->delete();
        return back()->with('success', 'Proveedor eliminado.');
    }
}