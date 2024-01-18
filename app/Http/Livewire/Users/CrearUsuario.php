<?php

namespace App\Http\Livewire\Users;

use App\Models\User;
use Livewire\Component;

class CrearUsuario extends Component
{
    public $name, $email, $password;

    public function render()
    {
        return view('livewire.users.crear-usuario');
    }

    protected $rules = [
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => ['required', 'string', 'min:8'],
    ];

    public function save(){
        $this->validate();
        $this->password = bcrypt($this->password);
        
        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password
        ]);
        $this->reset(['name', 'email', 'password']);
        $this->emit('render');
        $this->emit('alert');
    }
}
