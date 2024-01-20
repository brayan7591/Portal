<?php

namespace App\Http\Livewire\Users;

use App\Models\User;
use Illuminate\Validation\Rule;
use Livewire\Component;

class MostrarUsuarios extends Component
{
    public $for = "name";
    public $search;
    public $sort = "id";
    public $direction = "asc";

    public $name, $email, $password, $ActRegister;

    protected $listeners = ['render' => 'render'];
    
    public function render()
    {
        $users = User::where($this->for, 'LIKE', '%' . $this->search . '%')
        ->orderBy($this->sort, $this->direction)->get();

        return view('livewire.users.mostrar-usuarios', compact('users'));
    }

    public function order($sort){
        if ($this->sort == $sort) {
            if ($this->direction == "desc") {
                $this->direction = "asc";
            }else{
                $this->direction = "desc";
            }
        }else {
            $this->sort = $sort;
            $this->direction = "asc";
        }
    }

    public function update(User $user){

        $this->ActRegister = $user;
        $this->name = $user->name;
        $this->email = $user->email;

    }

    public function Actualizar(User $user){
        $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
        ]);

        $user->name = $this->name;
        $user->email = $this->email;
        if ($this->password) {
            $user->password = $this->password;
        }
        $user->save();
        $this->reset(['name', 'email', 'password']);
        $this->emit('Actualizado');
    }
}
