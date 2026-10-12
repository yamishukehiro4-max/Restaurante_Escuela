<?php

namespace Database\Seeders;

use App\Models\Supplier;
use Illuminate\Database\Seeder;

class SupplierSeeder extends Seeder
{
    public function run(): void
    {
        Supplier::updateOrCreate(['name' => 'Distribuidora La Ceiba'], [
            'contact_name' => 'Carlos Perez', 'phone' => '2222-3333',
            'email' => 'ventas@laceiba.com', 'address' => 'San Salvador', 'status' => 'Activo',
        ]);
        Supplier::updateOrCreate(['name' => 'Mercado Central'], [
            'contact_name' => 'Ana Lopez', 'phone' => '2222-4444',
            'email' => 'ventas@mercadocentral.com', 'address' => 'San Salvador', 'status' => 'Activo',
        ]);
    }
}