<?php

namespace App\Http\Livewire\Users;

use App\Models\User;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithPagination;

class MostrarUsuarios extends Component
{
    use WithPagination;

    public $for = "name";
    public $search;
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
        $users = User::where($this->for, 'LIKE', '%' . $this->search . '%')
        ->orderBy($this->sort, $this->direction)->paginate($this->registers);

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

    public function delete(User $user){
        $user->delete();
    }
}
