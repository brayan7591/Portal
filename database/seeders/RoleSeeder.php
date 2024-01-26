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

        Permission::create(['name' => 'dashboard'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'Users.mirar'])->assignRole($role1);
        Permission::create(['name' => 'Users.create'])->assignRole($role1);
        Permission::create(['name' => 'Users.edit'])->assignRole($role1);
        Permission::create(['name' => 'Users.destroy'])->assignRole($role1);
    
        
    }
}
