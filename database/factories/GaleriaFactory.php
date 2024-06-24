<?php

namespace Database\Factories;

use App\Models\programa;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Galeria>
 */
class GaleriaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'imagen' => "imagenes/galeria/" . $this->faker->image('public/storage/imagenes/galeria', 480, 480, 'galeria', false),
            'programa_id' => programa::all()->random()->id,
        ];
    }
}
