<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

class Usuarios extends Component
{
    use WithPagination;

    public $for = "name", $search, $registers = '10', $sort = "id", $direction = "asc";

    // Variables para actualizar un usuario
    public $ActualizarNombre, $ActualizarCorreo, $ActualizarPassword, $ActRegister, $ActualizarRol = [];

    //Variables para Agregar un usuario
    public $AgregarNombre, $AgregarCorreo, $AgregarPassword, $AgregarRol = [];

    protected $paginationTheme = "Bootstrap";
    protected $listeners = ['delete'];

    public function updatingSearch(){
        $this->resetPage();
    }

    public function updatingRegisters(){
        $this->resetPage();
    }

    protected $queryString = ['registers' => ['except' => '10']];


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

        if ($user->roles()->count() > 0) {
            $this->ActualizarRol = $user->roles()->first()->id;
        }else{
            $this->ActualizarRol = null;
        }
        $this->ActRegister = $user;
        $this->ActualizarNombre = $user->name;
        $this->ActualizarCorreo = $user->email;
    }

    public function Actualizar(User $user){
        $this->validate([
            'ActualizarNombre' => ['required', 'string', 'max:255'],
            'ActualizarCorreo' => ['required', 'string', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user->id)],
            'ActualizarRol' => ['required', 'exists:roles,id']
        ]);
        $user->name = $this->ActualizarNombre;
        $user->email = $this->ActualizarCorreo;
        if ($this->ActualizarPassword) {
            $user->password = $this->ActualizarPassword;
        }
        $user->save();
        $user->roles()->sync($this->ActualizarRol);
        $this->reset(['ActualizarNombre', 'ActualizarCorreo', 'ActualizarPassword', 'ActualizarRol']);
        $this->dispatch('Actualizado');
    }

    public function delete(User $user){
        if ($user->id == auth()->user()->id) {
            $user->delete();
            redirect()->route('login');
        }else{
            $user->delete();
        }
    }

    public function save(){
        $this->validate([
            'AgregarNombre' => ['required', 'string', 'max:255'],
            'AgregarCorreo' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'AgregarPassword' => ['required', 'string', 'min:8'],
            'AgregarRol' => ['required']
        ]);
        $this->AgregarPassword = bcrypt($this->AgregarPassword);
        User::create([
            'name' => $this->AgregarNombre,
            'email' => $this->AgregarCorreo,
            'password' => $this->AgregarPassword
        ])->roles()->sync($this->AgregarRol);

        $this->reset(['AgregarNombre', 'AgregarCorreo', 'AgregarPassword', 'AgregarRol']);
        $this->dispatch('alert');
    }

    public function render()
    {
        $roles = Role::all();

        $users = User::where($this->for, 'LIKE', '%' . $this->search . '%')
        ->orderBy($this->sort, $this->direction)->paginate($this->registers);

        return view('livewire.admin.usuarios', compact('roles', 'users'));
    }
}
