<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $roles = ['Administrador', 'Chef', 'Compras', 'Alumno Caja', 'Coordinacion'];
        foreach ($roles as $r) {
            Role::updateOrCreate(['name' => $r]);
        }
    }
}