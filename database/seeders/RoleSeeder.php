<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role1 = Role::create(['name' => 'Administrador']);
        $role2 = Role::create(['name' => 'Espectador']);
        $role3 = Role::create(['name' => 'Creador']);
        $role4 = Role::create(['name' => 'Editor']);
        $role5 = Role::create(['name' => 'Eliminador']);

        Permission::create(['name' => 'Dashboard', 'description' => 'Ver la dashboard'])->syncRoles($role1, $role2, $role3, $role4, $role5);
        
        Permission::create(['name' => 'Usuarios.mirar', 'description' => 'Ver los usuarios'])->syncRoles($role1, $role2, $role3, $role4, $role5);
        Permission::create(['name' => 'Usuarios.crear', 'description' => 'Crear Usuarios'])->syncRoles($role1, $role3);
        Permission::create(['name' => 'Usuarios.editar', 'description' => 'Actualizar usuarios'])->syncRoles($role1, $role4);
        Permission::create(['name' => 'Usuarios.destruir', 'description' => 'Eliminar Usuarios'])->syncRoles($role1, $role5);
        
        Permission::create(['name' => 'Roles.mirar', 'description' => 'Ver los roles'])->syncRoles($role1, $role2, $role3, $role4, $role5);
        Permission::create(['name' => 'Roles.crear', 'description' => 'Crear roles'])->syncRoles($role1, $role3);
        Permission::create(['name' => 'Roles.editar', 'description' => 'Actualizar roles'])->syncRoles($role1, $role4);
        Permission::create(['name' => 'Roles.destruir', 'description' => 'Eliminar roles'])->syncRoles($role1, $role5);
    
        Permission::create(['name' => 'Curriculum.mirar', 'description' => 'Ver los curriculums y las competencias'])->syncRoles($role1, $role2, $role3, $role4, $role5);
        Permission::create(['name' => 'Curriculum.crear', 'description' => 'Crear curriculums y competencias'])->syncRoles($role1, $role3);
        Permission::create(['name' => 'Curriculum.editar', 'description' => 'Actualizar curriculums y competencias'])->syncRoles($role1, $role4);
        Permission::create(['name' => 'Curriculum.destruir', 'description' => 'Eliminar curriculums y competencias'])->syncRoles($role1, $role5);

        Permission::create(['name' => 'Eventos.mirar', 'description' => 'Ver los eventos'])->syncRoles($role1, $role2, $role3, $role4, $role5);
        Permission::create(['name' => 'Eventos.crear', 'description' => 'Crear eventos'])->syncRoles($role1, $role3);
        Permission::create(['name' => 'Eventos.editar', 'description' => 'Actualizar eventos'])->syncRoles($role1, $role4);
        Permission::create(['name' => 'Eventos.destruir', 'description' => 'Eliminar eventos'])->syncRoles($role1, $role5);

        Permission::create(['name' => 'Proyectos.mirar', 'description' => 'Ver los proyectos'])->syncRoles($role1, $role2, $role3, $role4, $role5);
        Permission::create(['name' => 'Proyectos.crear', 'description' => 'Crear proyectos'])->syncRoles($role1, $role3);
        Permission::create(['name' => 'Proyectos.editar', 'description' => 'Actualizar proyectos'])->syncRoles($role1, $role4);
        Permission::create(['name' => 'Proyectos.destruir', 'description' => 'Eliminar proyectos'])->syncRoles($role1, $role5);
    
        Permission::create(['name' => 'Biblioteca.mirar', 'description' => 'Ver los libros de la biblioteca'])->syncRoles($role1, $role2, $role3, $role4, $role5);
        Permission::create(['name' => 'Biblioteca.crear', 'description' => 'Agregar libros'])->syncRoles($role1, $role3);
        Permission::create(['name' => 'Biblioteca.editar', 'description' => 'Actualizar libros'])->syncRoles($role1, $role4);
        Permission::create(['name' => 'Biblioteca.destruir', 'description' => 'Eliminar libros'])->syncRoles($role1, $role5);
    
        Permission::create(['name' => 'Informativos.mirar', 'description' => 'Ver los voceros e instructores'])->syncRoles($role1, $role2, $role3, $role4, $role5);
        Permission::create(['name' => 'Informativos.crear', 'description' => 'Agregar voceros o instructores'])->syncRoles($role1, $role3);
        Permission::create(['name' => 'Informativos.editar', 'description' => 'Actualizar informacion de voceros o instructores'])->syncRoles($role1, $role4);
        Permission::create(['name' => 'Informativos.destruir', 'description' => 'Eliminar informacion de voceros o instructores'])->syncRoles($role1, $role5);

        Permission::create(['name' => 'Destacados.mirar', 'description' => 'Ver los aprendices y egresados destacados'])->syncRoles($role1, $role2, $role3, $role4, $role5);
        Permission::create(['name' => 'Destacados.crear', 'description' => 'Agregar aprendices o egresados destacados'])->syncRoles($role1, $role3);
        Permission::create(['name' => 'Destacados.editar', 'description' => 'Actualizar informacion de aprendices o egresados'])->syncRoles($role1, $role4);
        Permission::create(['name' => 'Destacados.destruir', 'description' => 'Eliminar informacion de aprendices o egresados'])->syncRoles($role1, $role5);
    }
}
