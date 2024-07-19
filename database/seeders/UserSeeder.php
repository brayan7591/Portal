<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'administrador',
            'email' => 'admin@admin.com',
            'password' => bcrypt('123456789')
        ])->assignRole('Administrador');

        User::create([
            'name' => 'espectador',
            'email' => 'espectador@espectador.com',
            'password' => bcrypt('espectador')
        ])->assignRole('Espectador');

        User::create([
            'name' => 'creador',
            'email' => 'creador@creador.com',
            'password' => bcrypt('creador')
        ])->assignRole('Creador');

        User::create([
            'name' => 'editor',
            'email' => 'editor@editor.com',
            'password' => bcrypt('editor')
        ])->assignRole('Editor');

        User::create([
            'name' => 'eliminador',
            'email' => 'eliminador@eliminador.com',
            'password' => bcrypt('eliminador')
        ])->assignRole('Eliminador');

        User::factory(10)->create();

        
    }
}
