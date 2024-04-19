<?php

namespace Database\Seeders;

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
        Storage::deleteDirectory('public/imagenes');
        Storage::makeDirectory('public/imagenes');
        
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(ProgramaSeeder::class);
        $this->call(CompetenciaSeeder::class);
        $this->call(NivelSeeder::class);
        $this->call(RapSeeder::class);
    }
}
