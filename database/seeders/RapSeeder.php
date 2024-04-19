<?php

namespace Database\Seeders;

use App\Models\rap;
use Illuminate\Database\Seeder;

class RapSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        rap::create([
            'descripcion' => 'ANALIZAR EL CONTEXTO PRODUCTIVO SEGÚN SUS CARACTERÍSTICAS Y NECESIDADES',
            'codigo_competencia' => 240201064
        ]);

        rap::create([
            'descripcion' => 'ESTRUCTURAR EL PROYECTO DE ACUERDO A CRITERIOS DE LA INVESTIGACIÓN.',
            'codigo_competencia' => 240201064
        ]);

        rap::create([
            'descripcion' => 'ARGUMENTAR ASPECTOS TEÓRICOS DEL PROYECTO SEGÚN REFERENTES NACIONALES',
            'codigo_competencia' => 240201064
        ]);

        rap::create([
            'descripcion' => 'PROPONER SOLUCIONES A LAS NECESIDADES DEL CONTEXTO SEGÚN RESULTADOS',
            'codigo_competencia' => 240201064
        ]);
    }
}
