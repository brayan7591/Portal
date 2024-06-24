<?php

namespace Database\Factories;

use App\Models\programa;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Proyecto>
 */
class ProyectoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'Nombre' => $this->faker->name(),
            'Objetivo' => $this->faker->text(600),
            'Justificacion' => $this->faker->text(800),
            'FechaInicio' => $this->faker->date(),
            'FechaFinalizacion' => $this->faker->date(),
            'programa_id' => programa::all()->random()->id,
        ];
    }
}
