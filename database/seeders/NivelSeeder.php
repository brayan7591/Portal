<?php

namespace Database\Seeders;

use App\Models\nivele;
use Illuminate\Database\Seeder;

class NivelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $nivelPrueba = nivele::create([
            'nivel' => 'tecnico',
            'FechaInicio' => '2024-03-13',
            'FechaFin' => null,
            'HorasEtapaLectiva' => 2500,
            'HorasEtapaProductiva' => 2200,
            'programa_id' => 1
        ]);

        $nivelPrueba->competencias()->attach(240201064, ['nivel' => 'tecnico', 'programa_id' => 1]);
        $nivelPrueba->competencias()->attach(240201062, ['nivel' => 'tecnico', 'programa_id' => 1]);
        $nivelPrueba->competencias()->attach(210201501, ['nivel' => 'tecnico', 'programa_id' => 1]);
    }
}
