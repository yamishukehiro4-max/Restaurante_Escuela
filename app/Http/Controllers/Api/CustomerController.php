<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        return response()->json(Customer::with('orders')->get(), 200);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'    => 'required|string|max:150',
            'phone'   => 'nullable|string|max:30',
            'email'   => 'nullable|email|max:150',
            'address' => 'nullable|string',
        ]);
        return response()->json(Customer::create($data), 201);
    }

    public function show(Customer $customer)
    {
        return response()->json($customer->load('orders'), 200);
    }

    public function update(Request $request, Customer $customer)
    {
        $data = $request->validate([
            'name'    => 'sometimes|string|max:150',
            'phone'   => 'nullable|string|max:30',
            'email'   => 'nullable|email|max:150',
            'address' => 'nullable|string',
        ]);
        $customer->update($data);
        return response()->json($customer, 200);
    }

    public function destroy(Customer $customer)
    {
        $customer->delete();
        return response()->json(['message' => 'Cliente eliminado'], 200);
    }
}