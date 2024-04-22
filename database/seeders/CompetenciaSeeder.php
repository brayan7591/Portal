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

        competencia::create([
            'norma' => 'Esto es una fisica',
            'nombre' => 'FISICA',
            'duracion' => 48,
            'codigo' => 240201062
        ]);

        competencia::create([
            'norma' => 'Ejercer los derechos fundamentales del trabajo de acuerdo al reconocimiento de la dignidad',
            'nombre' => 'Derechos fundamentales del trabajo',
            'duracion' => 48,
            'codigo' => 210201501
        ]);
    }
}
