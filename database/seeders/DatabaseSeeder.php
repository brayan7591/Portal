<?php

namespace Database\Seeders;

use App\Models\biblioteca;
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
        Storage::deleteDirectory('public/imagenes/programas');
        Storage::makeDirectory('public/imagenes/libro');
        Storage::makeDirectory('public/imagenes/programas');

        
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(ProgramaSeeder::class);
        $this->call(CompetenciaSeeder::class);
        $this->call(NivelSeeder::class);
        $this->call(RapSeeder::class);
        $this->call(SaberSeeder::class);
        $this->call(DetalleSabereSeeder::class);
        $this->call(InstructorSeeder::class);
        
        biblioteca::factory(5)->create();

    }
}
