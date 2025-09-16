<?php

namespace Database\Seeders;

use App\Models\Sucursales;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SucursalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Sucursales::create([
            'cod_sucursal' => '1',
            'name' => 'matriz',
            'status' => 'Activo',
        ]);
    }
}
