<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Livewire\Component;

class ActualizarUsuario extends Component
{

    protected $listeners = ['deleteCuenta'];

    //variables para actualizar el usuario
    public $nombre, $correo;

    //variables para actualizar la contraseña
    public $nuevaContra, $nuevaContraValidar, $antiguaContra, $contraEliminar;

    //Al iniciar el componente da el "name" a la variable nombre y el "email" a la variable correo del usuario autenticado
    public function mount(){
        $this->nombre = Auth::user()->name;
        $this->correo = Auth::user()->email;
    }

    public function render(){
        return view('livewire.actualizar-usuario');
    }

    public function actualizarusuario(){
        $user = User::find(Auth::user()->id);
        $this->validate([
            'nombre' => ['required', 'string', 'max:255', 'min:3'],
            'correo' => ['required', 'string', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user->id)],
        ]);
        $user->name = $this->nombre;
        $user->email = $this->correo;
        $user->save();
        $this->dispatch('NuevoNombre', $this->nombre);
    }

    public function delete(){
        $this->validate([
            'contraEliminar' => ['required', 'current_password:web']
        ]);
        $this->dispatch('EliminarCuenta');
    }

    public function deleteCuenta(){
        $user = User::find(Auth::user()->id);
        $user->delete();
        redirect()->route('login');
    }

    public function actualizarcontra(){
        $user = User::find(Auth::user()->id);
        $this->validate([
            'nuevaContra' => ['required', 'string', 'max:255', 'min:8'],
            'nuevaContraValidar' => ['required', 'same:nuevaContra'],
            'antiguaContra' => ['required', 'current_password:web']
        ]);
        $user->password = bcrypt($this->nuevaContra);
        $user->save();
        $this->reset(['nuevaContra', 'nuevaContraValidar', 'antiguaContra']);
        $this->dispatch('ContrasenaActualizada');
    }
}
