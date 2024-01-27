<?php

namespace App\Http\Livewire\Users;

use App\Models\User;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

class MostrarUsuarios extends Component
{
    use WithPagination;

    public $for = "name";
    public $search, $rolesUsuario = [];
    public $registers = '10';
    public $sort = "id";
    public $direction = "asc";

    public $name, $email, $password, $ActRegister;

    protected $paginationTheme = "Bootstrap";
    protected $listeners = ['render', 'delete'];
    
    public function updatingSearch(){
        $this->resetPage();
    }

    protected $queryString = ['registers' => ['except' => '10']];
    
    public function render()
    {
        $roles = Role::all();

        $users = User::where($this->for, 'LIKE', '%' . $this->search . '%')
        ->orderBy($this->sort, $this->direction)->paginate($this->registers);

        return view('livewire.users.mostrar-usuarios', compact('users', 'roles'));
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

        $this->rolesUsuario = $user->roles()->pluck('id');
        $this->ActRegister = $user;
        $this->name = $user->name;
        $this->email = $user->email;
    }

    public function Actualizar(User $user){
        $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'rolesUsuario' => ['required']
        ]);

        $user->name = $this->name;
        $user->email = $this->email;
        if ($this->password) {
            $user->password = $this->password;
        }
        $user->save();
        $user->roles()->sync($this->rolesUsuario);
        $this->reset(['name', 'email', 'password', 'rolesUsuario']);
        $this->emit('Actualizado');
    }

    public function delete(User $user){
        $user->delete();
    }
}
