<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    public function run(): void
    {
        Customer::updateOrCreate(['name' => 'Maria Gonzalez'], [
            'phone' => '7777-1111', 'email' => 'maria@example.com', 'address' => 'San Salvador',
        ]);
        Customer::updateOrCreate(['name' => 'Juan Perez'], [
            'phone' => '7777-2222', 'email' => 'juan@example.com', 'address' => 'Santa Tecla',
        ]);
    }
}