<?php

namespace Database\Seeders;

use App\Models\RawMaterialCategory;
use Illuminate\Database\Seeder;

class RawMaterialCategorySeeder extends Seeder
{
    public function run(): void
    {
        foreach (['Perecederos', 'No Perecederos', 'Aseo', 'Gas'] as $c) {
            RawMaterialCategory::updateOrCreate(['name' => $c]);
        }
    }
}