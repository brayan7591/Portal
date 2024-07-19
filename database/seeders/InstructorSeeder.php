<?php

namespace Database\Seeders;

use App\Models\instructore;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class InstructorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        instructore::create([
            'Nombre' => 'Nombre Apellido',
            'Email' => 'correo@correo.com',
            'Especialidad' => 'Desarrollo Backen de python y javascript',
            'Telefono' => 12345678,
            'Descripcion' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Reprehenderit laudantium sit unde libero asperiores exercitationem expedita earum. Eos totam mollitia laudantium dolor quisquam perspiciatis nostrum rerum laboriosam? Facilis, dicta doloribus. Lorem ipsum dolor sit amet consectetur adipisicing elit. Explicabo, distinctio quidem! Fuga voluptatum facere amet, sint magni, saepe aperiam obcaecati debitis laudantium ex temporibus minus distinctio quos possimus, vitae excepturi!',
            'programa_id' => '1',
            'jornada' => 'mixta',
        ])->imagen()->create(['url' => 'public/imagenes/instructores/' . Faker::create()->image('public/storage/imagenes/instructores', 1000, 1000, null, false)]);

        instructore::create([
            'Nombre' => 'Nombre2 Apellido2',
            'Email' => 'correo2@correo.com',
            'Especialidad' => 'Desarrollo Backen de python, java y django',
            'Telefono' => 12345678,
            'Descripcion' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Reprehenderit laudantium sit unde libero asperiores exercitationem expedita earum. Eos totam mollitia laudantium dolor quisquam perspiciatis nostrum rerum laboriosam? Facilis, dicta doloribus. Lorem ipsum dolor sit amet consectetur adipisicing elit. Explicabo, distinctio quidem! Fuga voluptatum facere amet, sint magni, saepe aperiam obcaecati debitis laudantium ex temporibus minus distinctio quos possimus, vitae excepturi!',
            'programa_id' => '1',
            'jornada' => 'nocturna',
        ]);

        instructore::create([
            'Nombre' => 'Nombre3 Apellido3',
            'Email' => 'correo3@correo.com',
            'Especialidad' => 'Desarrollo Fullstack de js',
            'Telefono' => 12345678,
            'Descripcion' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Reprehenderit laudantium sit unde libero asperiores exercitationem expedita earum. Eos totam mollitia laudantium dolor quisquam perspiciatis nostrum rerum laboriosam? Facilis, dicta doloribus. Lorem ipsum dolor sit amet consectetur adipisicing elit. Explicabo, distinctio quidem! Fuga voluptatum facere amet, sint magni, saepe aperiam obcaecati debitis laudantium ex temporibus minus distinctio quos possimus, vitae excepturi!',
            'programa_id' => '1',
            'jornada' => 'mañana',
        ]);

        instructore::factory(10)->create();
    }
}
