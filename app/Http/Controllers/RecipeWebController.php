<?php

namespace App\Http\Controllers;

use App\Models\Dish;
use App\Models\RawMaterial;
use App\Models\Recipe;
use Illuminate\Http\Request;

class RecipeWebController extends Controller
{
    public function index()
    {
        $recipes = Recipe::with(['dish', 'rawMaterial'])->paginate(15);
        $dishes = Dish::orderBy('name')->get();
        $materials = RawMaterial::orderBy('name')->get();
        return view('admin.recipes.index', compact('recipes', 'dishes', 'materials'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'dish_id' => 'required|exists:dishes,id',
            'raw_material_id' => 'required|exists:raw_materials,id',
            'quantity_required' => 'required|numeric|min:0.01',
        ]);
        Recipe::create($data);
        return back()->with('success', 'Receta agregada.');
    }

    public function destroy(Recipe $recipe)
    {
        $recipe->delete();
        return back()->with('success', 'Receta eliminada.');
    }
}