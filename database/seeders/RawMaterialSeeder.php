<?php

namespace Database\Seeders;

use App\Models\RawMaterial;
use App\Models\RawMaterialCategory;
use Illuminate\Database\Seeder;

class RawMaterialSeeder extends Seeder
{
    public function run(): void
    {
        $per = RawMaterialCategory::where('name', 'Perecederos')->first();
        $nop = RawMaterialCategory::where('name', 'No Perecederos')->first();

        RawMaterial::updateOrCreate(['code' => 'MP-001'], [
            'category_id' => $per->id, 'name' => 'Tomate',
            'unit_measure' => 'Libras', 'stock_current' => 25, 'is_perishable' => true,
        ]);
        RawMaterial::updateOrCreate(['code' => 'MP-002'], [
            'category_id' => $nop->id, 'name' => 'Frijol rojo',
            'unit_measure' => 'Libras', 'stock_current' => 50, 'is_perishable' => false,
        ]);
        RawMaterial::updateOrCreate(['code' => 'MP-003'], [
            'category_id' => $per->id, 'name' => 'Lechuga',
            'unit_measure' => 'Unidades', 'stock_current' => 15, 'is_perishable' => true,
        ]);
    }
}