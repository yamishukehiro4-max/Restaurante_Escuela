<?php

namespace Database\Seeders;

use App\Models\Dish;
use App\Models\DishCategory;
use Illuminate\Database\Seeder;

class DishSeeder extends Seeder
{
    public function run(): void
    {
        $fuertes = DishCategory::where('name', 'Platos Fuertes')->first();
        $bebidas = DishCategory::where('name', 'Bebidas')->first();
        $postres = DishCategory::where('name', 'Postres')->first();

        Dish::updateOrCreate(['name' => 'Almuerzo Ejecutivo'], [
            'category_id' => $fuertes->id, 'description' => 'Casamiento con carne asada',
            'price' => 2.25, 'is_active' => true,
        ]);
        Dish::updateOrCreate(['name' => 'Cafe Americano'], [
            'category_id' => $bebidas->id, 'description' => 'Cafe negro',
            'price' => 0.75, 'is_active' => true,
        ]);
        Dish::updateOrCreate(['name' => 'Flan de coco'], [
            'category_id' => $postres->id, 'description' => 'Postre tradicional',
            'price' => 1.00, 'is_active' => true,
        ]);
    }
}