<?php

namespace App\Http\Livewire\Roles;

use Livewire\Component;
use Spatie\Permission\Models\Role;

class MostrarRoles extends Component
{
    public function render()
    {
        $roles = Role::paginate(10);
        return view('livewire.roles.mostrar-roles', compact('roles'));
    }
}
