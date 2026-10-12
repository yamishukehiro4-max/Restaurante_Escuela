<?php

namespace Database\Seeders;

use App\Models\DishCategory;
use Illuminate\Database\Seeder;

class DishCategorySeeder extends Seeder
{
    public function run(): void
    {
        $cats = [
            ['name' => 'Entradas', 'description' => 'Entradas y sopas'],
            ['name' => 'Platos Fuertes', 'description' => 'Almuerzos del dia'],
            ['name' => 'Bebidas', 'description' => 'Refrescos y cafes'],
            ['name' => 'Postres', 'description' => 'Postres caseros'],
        ];
        foreach ($cats as $c) DishCategory::updateOrCreate(['name' => $c['name']], $c);
    }
}