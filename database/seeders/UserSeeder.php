<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $admin = Role::where('name', 'Administrador')->first();
        $chef  = Role::where('name', 'Chef')->first();
        $comp  = Role::where('name', 'Compras')->first();
        $caja  = Role::where('name', 'Alumno Caja')->first();

        User::updateOrCreate(['email' => 'admin@restaurante.edu.sv'], [
            'nie' => '20240000', 'name' => 'Administrador General',
            'password' => Hash::make('123456'), 'role_id' => $admin->id,
        ]);

        User::updateOrCreate(['email' => 'chef@restaurante.edu.sv'], [
            'nie' => '20240002', 'name' => 'Chef Mario',
            'password' => Hash::make('123456'), 'role_id' => $chef->id,
        ]);

        User::updateOrCreate(['email' => 'lidia@restaurante.edu.sv'], [
            'nie' => '20240001', 'name' => 'Lidia Recio',
            'password' => Hash::make('123456'), 'role_id' => $comp->id,
        ]);

        User::updateOrCreate(['email' => 'caja@restaurante.edu.sv'], [
            'nie' => '20240003', 'name' => 'Alumno Caja',
            'password' => Hash::make('123456'), 'role_id' => $caja->id,
        ]);
    }
}