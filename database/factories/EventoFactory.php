<?php

namespace Database\Factories;

use App\Models\programa;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Evento>
 */
class EventoFactory extends Factory
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
            'descripción' => $this->faker->text(600),
            'Fecha' => $this->faker->dateTime(),
            'programa_id' => programa::all()->random()->id, 
        ];
    }
}
