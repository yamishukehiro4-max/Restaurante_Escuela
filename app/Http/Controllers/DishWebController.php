<?php

namespace App\Http\Controllers;

use App\Models\Dish;
use App\Models\DishCategory;
use Illuminate\Http\Request;

class DishWebController extends Controller
{
    public function index()
    {
        $dishes = Dish::with('category')->orderBy('name')->paginate(10);
        return view('admin.dishes.index', compact('dishes'));
    }

    public function create()
    {
        $categories = DishCategory::orderBy('name')->get();
        return view('admin.dishes.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'category_id' => 'required|exists:dish_categories,id',
            'name'        => 'required|string|max:150',
            'description' => 'nullable|string',
            'price'       => 'required|numeric|min:0',
            'is_active'   => 'boolean',
        ]);
        $data['is_active'] = $request->boolean('is_active');
        Dish::create($data);
        return redirect('/admin/dishes')->with('success', 'Platillo creado.');
    }

    public function edit(Dish $dish)
    {
        $categories = DishCategory::orderBy('name')->get();
        return view('admin.dishes.edit', compact('dish', 'categories'));
    }

    public function update(Request $request, Dish $dish)
    {
        $data = $request->validate([
            'category_id' => 'required|exists:dish_categories,id',
            'name'        => 'required|string|max:150',
            'description' => 'nullable|string',
            'price'       => 'required|numeric|min:0',
            'is_active'   => 'boolean',
        ]);
        $data['is_active'] = $request->boolean('is_active');
        $dish->update($data);
        return redirect('/admin/dishes')->with('success', 'Platillo actualizado.');
    }

    public function destroy(Dish $dish)
    {
        $dish->delete();
        return redirect('/admin/dishes')->with('success', 'Platillo eliminado.');
    }
}