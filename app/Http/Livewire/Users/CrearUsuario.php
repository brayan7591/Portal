<?php

namespace App\Http\Livewire\Users;

use App\Models\User;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class CrearUsuario extends Component
{
    public $name, $email, $password, $rolesUsuario = [];

    public function render()
    {
        $roles = Role::all();
        return view('livewire.users.crear-usuario', compact('roles'));
    }

    protected $rules = [
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => ['required', 'string', 'min:8'],
        'rolesUsuario' => ['required']
    ];

    public function save(){
        $this->validate();
        $this->password = bcrypt($this->password);
        
        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password
        ])->roles()->sync($this->rolesUsuario);

        $this->reset(['name', 'email', 'password', 'rolesUsuario']);
        $this->emit('render');
        $this->emit('alert');
    }
    
}
