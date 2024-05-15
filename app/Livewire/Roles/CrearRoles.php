<?php

namespace App\Livewire\Roles;

use Livewire\Component;
use Spatie\Permission\Models\Permission;

class CrearRoles extends Component
{
    public function render()
    {
        $permisos = Permission::all();
        
        return view('livewire.roles.crear-roles', compact('permisos'));
    }
}
