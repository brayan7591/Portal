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
            'descripcion' => 'ARGUMENTAR ASPECTOS TEÓRICOS DEL PROYECTO SEGÚN REFERENTES NACIONALES E INTERNACIONALES',
            'codigo_competencia' => 240201064
        ]);

        rap::create([
            'descripcion' => 'PROPONER SOLUCIONES A LAS NECESIDADES DEL CONTEXTO SEGÚN RESULTADOS DE LA INVESTIGACION',
            'codigo_competencia' => 240201064
        ]);

        rap::create([
            'descripcion' => 'Valorar la importancia de la ciudadanía laboral con base en elestudio de los derechos humanos y fundamentales del trabajo.',
            'codigo_competencia' => 210201501
        ]);

        rap::create([
            'descripcion' => 'Practicar los derechos fundamentales del trabajo de acuerdo conla Constitución Política y los convenios Internacionales.',
            'codigo_competencia' => 210201501
        ]);

        rap::create([
            'descripcion' => 'Reconocer el trabajo como uno de los elementos primordialespara la movilidad social y la transformación vital.',
            'codigo_competencia' => 210201501
        ]);

        rap::create([
            'descripcion' => 'Participar en acciones solidarias orientadas al ejercicio de los derechos humanos, de los pueblos y de la naturaleza',
            'codigo_competencia' => 210201501
        ]);
        
    }
}
