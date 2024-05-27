<?php

namespace Database\Factories;

use App\Models\programa;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Biblioteca>
 */
class BibliotecaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'IdBiblioteca' => $this->faker->unique()->randomNumber(4),
            'Titulo' => $this->faker->word(10),
            'FechaEstreno' => $this->faker->date(),
            'Editorial' => $this->faker->word(20),
            'Imagen' => 'imagenes/libro/' . $this->faker->image('public/storage/imagenes/libro', 480, 640, 'Libro', false),
            'Formato' => $this->faker->randomElement(['pdf', 'papel']),
            'FechaIngreso' => $this->faker->date(),
            'programa_id' => programa::all()->random()->id,
            'Copias' => $this->faker->randomNumber(1),
            'Estado' => $this->faker->randomElement(['nuevo', 'antiguo']),
        ];
    }
}
