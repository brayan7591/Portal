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
            'Descripcion' => 'Los flujos de nuevas tecnologías llegan al país a un ritmo sin precedentes, haciendo que la demanda interna y las expectativas por nuevos productos y servicios se transformen con similar rapidez. De esta forma, la prospectiva de la industria TIC de los países menos desarrollados debe partir de la ubicación de la oferta nacional en el eje definido por las tensiones entre el mercado global y el mercado local, que operan como dos polos frente al tema. Esto significa identificar los focos tecnológicos prioritarios tanto a escala nacional como internacional, a partir de las fortalezas y debilidades del sector, con el fin de establecer el mercado objetivo. Teniendo en cuenta que estos evolucionan y se transforman continua y rápidamente, el talento humano en Colombia, formado en áreas de TI, se convierte en el determinante para afrontar los retos propuestos para el corto, mediano y largo plazo [1].
            
            En el plano internacional, el interés por los servicios de las Industrias 4.0 de Colombia (BPO, Software, Salud, Audiovisuales y contenidos digitales, Comunicación Gráfica y Editorial) continúa ampliándose con ritmo acelerado. En 2018, estas exportaciones registraron US$407,5 millones, con un incremento de 33%. Al desagregar por sector, se destaca el liderazgo de las ventas de Software, que aportaron US$159,7 millones, seguido por BPO con US$103,9 millones, Audiovisuales y contenidos digitales con US$82,8 millones, Salud con US$57,4 millones y Comunicación Gráfica y Editorial con US$3,5 millones [2].
            
            El número de profesionales de tecnología que demandan las empresas colombianas, es mucho mayor que el de profesionales disponibles en el país, según datos del Ministerio de Tecnologías de la Información y las Comunicaciones (MinTIC). El déficit de profesionales en esa área será de casi 70 mil cerrando el 2019 [3]. Dadas las proyecciones, después de 2019 el problema de la escasez de talento humano formado en áreas de TI, seguirá creciendo y no puede resolverse fácilmente, por lo tanto, el Gobierno de Colombia debe adoptar medidas para superar este déficit.
            ',
            'codigoPrograma' => '228118',
            'DescripcionCorta' => 'En ADSO podras encontrar la capacidad de crear,editar y reorganizar sitios web podras aprender a crear aplicaciones y poder convertirte en un buen programador es todo gracias a adso dandote unas bases fundamentales para la vida laboral en el entorno de la programación.'
        ]);
    }
}
