<?php

namespace Database\Seeders;

use App\Models\biblioteca;
use App\Models\evento;
use App\Models\galeria;
use App\Models\personajes_destacado;
use App\Models\proyecto;
use App\Models\vocero;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Storage::deleteDirectory('public/imagenes/libro');
        Storage::deleteDirectory('public/imagenes/galeria');
        Storage::deleteDirectory('public/imagenes/programas');
        Storage::deleteDirectory('public/imagenes/instructores');
        
        Storage::makeDirectory('public/imagenes/libro');
        Storage::makeDirectory('public/imagenes/galeria');
        Storage::makeDirectory('public/imagenes/programas');
        Storage::makeDirectory('public/imagenes/instructores');
        
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(ProgramaSeeder::class);
        $this->call(CompetenciaSeeder::class);
        $this->call(NivelSeeder::class);
        $this->call(RapSeeder::class);
        $this->call(SaberSeeder::class);
        $this->call(DetalleSabereSeeder::class);
        $this->call(InstructorSeeder::class);

        proyecto::factory(20)->create();
        evento::factory(20)->create();
        galeria::factory(20)->create();
        vocero::factory(10)->create();
        biblioteca::factory(5)->create();
        personajes_destacado::factory(20)->create();
    }
}
