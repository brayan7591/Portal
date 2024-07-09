<?php

namespace Database\Factories;

use App\Models\programa;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vocero>
 */
class VoceroFactory extends Factory
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
            'NoFicha' => $this->faker->unique()->buildingNumber(),
            'programa_id' => programa::all()->random()->id,
        ];
    }
}
