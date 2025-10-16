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
         $sucursales = [
            [
                'cod_sucursal' => '1',
                'name' => 'Matriz Principal',
                'status' => 'Activo',
            ],
            [
                'cod_sucursal' => '002',
                'name' => 'Terminal',
                'status' => 'Activo',
            ],
            [
                'cod_sucursal' => '003',
                'name' => 'Metro',
                'status' => 'Inactivo',
            ],
        ];

        foreach ($sucursales as $sucursal) {
            Sucursales::create($sucursal);
        }

    }
}
