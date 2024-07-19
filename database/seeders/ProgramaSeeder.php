<?php

namespace Database\Seeders;

use App\Models\programa;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ProgramaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        programa::create([
            'NombrePrograma' => 'ADSO',
            'slug' => 'Analisis-Y-Desarrollo-De-Software',
            'imagen' => "imagenes/programas/ADSO.jpg" ,
            'Descripcion' => 'Adso se encarga de desarrolla competencias en: 
            Habilidades de comunicación oral y escrita. Conocimiento y manejo de tecnologías que soportan el desarrollo de software. Habilidades para el análisis,
             diseño y desarrollo de aplicativos de software, especialmente web y dispositivos móviles.',
            'codigoPrograma' => '228118',
            'DescripcionCorta' => 'En ADSO podras encontrar la capacidad de crear,editar y reorganizar sitios web podras aprender a crear aplicaciones y poder convertirte en un buen programador es todo gracias a adso dandote unas bases fundamentales para la vida laboral en el entorno de la programación.'
        ]);
    }
}
