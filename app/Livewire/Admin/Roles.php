<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class Roles extends Component
{
    //Variables para agregar un rol
    public $AgregarRol, $AgregarPermisos = [];

    //Variables para actualizar un rol
    public $ActualizarRol, $Actualizando, $ActualizarPermisos = [];

    protected $listeners = ['deleteRol'];

    public function render()
    {
        $roles = Role::paginate(10);
        $permisos = Permission::all();

        return view('livewire.admin.roles', compact('roles', 'permisos'));
    }

    public function deleteRol(Role $rol){
        $rol->delete();
    }

    public function save(){
        $this->validate([
            'AgregarRol' => ['required'],
            'AgregarPermisos' => ['required', 'exists:permissions,id']
        ]);

        array_push($this->AgregarPermisos, '1');

        Role::create([
            'name' => $this->AgregarRol,
        ])->permissions()->sync($this->AgregarPermisos);

        $this->reset(['AgregarRol', 'AgregarPermisos']);
        $this->dispatch('RolAgregado');
    }

    public function ActualizandoVariables(Role $rol){
        $this->Actualizando = $rol->id;
        $this->ActualizarRol = $rol->name;
        $this->ActualizarPermisos = $rol->permissions()->pluck('id');
    }

    public function Actualizar(Role $rol){
        $this->validate([
            'ActualizarRol' => ['required'],
            'ActualizarPermisos' => ['required', 'exists:permissions,id']
        ]);

        $rol->name = $this->ActualizarRol;
        $rol->save();
        $rol->permissions()->sync($this->ActualizarPermisos);
        $this->reset(['ActualizarRol', 'ActualizarPermisos']);
        $this->dispatch('RolActualizado');
    }
}
