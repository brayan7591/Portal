<?php

namespace Database\Factories;

use App\Models\programa;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Instructore>
 */
class InstructoreFactory extends Factory
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
            'Email' => $this->faker->unique()->safeEmail(),
            'Especialidad' => $this->faker->text(100),
            'Telefono' => $this->faker->buildingNumber(),
            'Descripcion' => $this->faker->text(),
            'programa_id' => programa::all()->random()->id,
            'jornada' => $this->faker->randomElement(['mañana', 'tarde', 'mixta', 'nocturna']),
        ];
    }
}
