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
        $role1 = Role::create(['name' => 'Admin']);
        $role2 = Role::create(['name' => 'Usuario']);
        $role3 = Role::create(['name' => 'Editor']);
        $role4 = Role::create(['name' => 'Eliminador']);

        Permission::create(['name' => 'dashboard', 'description' => 'Ver la dashboard'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'Users.mirar', 'description' => 'Ver los usuarios'])->syncRoles($role1, $role3, $role4);
        Permission::create(['name' => 'Users.create', 'description' => 'Crear Usuarios'])->assignRole($role1);
        Permission::create(['name' => 'Users.edit', 'description' => 'Actualizar usuarios'])->syncRoles($role1, $role3);
        Permission::create(['name' => 'Users.destroy', 'description' => 'Eliminar Usuarios'])->syncRoles($role1, $role4);
    
        
    }
}
