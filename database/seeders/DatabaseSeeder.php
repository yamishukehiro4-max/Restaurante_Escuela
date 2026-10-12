<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            DishCategorySeeder::class,
            DishSeeder::class,
            RawMaterialCategorySeeder::class,
            RawMaterialSeeder::class,
            SupplierSeeder::class,
            CustomerSeeder::class,
        ]);
    }
}