<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Ejecutar Seeders de Tablas PADRE (sin dependencias)
        $this->call([
            SucursalSeeder::class, // Debe ejecutarse primero para que cod_sucursal exista
            // Si AdminUserSeeder solo crea el Admin, lo podemos eliminar si usamos el Factory (ver paso 2)
            // AdminUserSeeder::class, // <--- ELIMINALO si usas el factory abajo.
            CategorySeeder::class,
        ]);

        // 2. Ejecutar Factory para crear usuarios (dependen de SucursalSeeder)

        // Crear el usuario administrador principal (usa el estado que definimos)
        User::factory()->administrador()->create([
            'name' => 'Admin Global',
        ]);

        // Crear 2 encargados de prueba
        User::factory()->encargado()->count(2)->create();

        // Crear 3 cajeros de prueba
        User::factory()->cajero()->count(3)->create();

    }
}
