<?php

namespace Database\Seeders;

use App\Models\competencia;
use Illuminate\Database\Seeder;

class CompetenciaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        competencia::create([
            'norma' => 'Orientar investigación formativa según referentes técnicos',
            'nombre' => 'INVESTIGACIÓN',
            'duracion' => 48,
            'codigo' => 240201064
        ]);
    }
}
