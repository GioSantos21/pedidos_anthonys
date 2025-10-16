<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
            'foto' => fake()->imageUrl(),
            'ultimo_login' => now(),
            'status' => fake()->randomElement(['Activo', 'Inactivo']),
            'rol' => fake()->randomElement(['Administrador', 'Encargado', 'Cajero']),
            'cod_sucursal' => fake()->randomElement(['1','002','003']),


        ];
    }

        public function administrador(): static
        {
            return $this->state(fn (array $attributes) => [
                'name' => 'Admin Global',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('123'),
                'status' => 'Activo',
                'rol' => 'Administrador',
                'cod_sucursal' => '1',
            ]);
        }

        // Nuevo estado para Encargado
        public function encargado(): static
        {
            return $this->state(fn (array $attributes) => [
                'rol' => 'Encargado',
                // Asegura que los encargados obtengan un correo único
                'email' => fake()->unique()->safeEmail(),
            ]);
        }

        // Nuevo estado para Cajero
        public function cajero(): static
        {
            return $this->state(fn (array $attributes) => [
                'rol' => 'Cajero',
                // Asegura que los cajeros obtengan un correo único
                'email' => fake()->unique()->safeEmail(),
            ]);
        }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
