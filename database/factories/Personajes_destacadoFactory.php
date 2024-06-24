<?php

namespace Database\Factories;

use App\Models\programa;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Personajes_destacado>
 */
class Personajes_destacadoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre' => $this->faker->name(),
            'correo' => $this->faker->unique()->safeEmail(),
            'numero_ficha' => $this->faker->unique()->buildingNumber(),
            'motivo' => $this->faker->text(),
            'programa_id' => programa::all()->random()->id,
            'rol' => $this->faker->randomElement(['Aprendiz', 'Egresado']),
        ];
    }
}
