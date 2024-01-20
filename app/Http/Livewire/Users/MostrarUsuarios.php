<?php

namespace App\Http\Livewire\Users;

use App\Models\User;
use Livewire\Component;

class MostrarUsuarios extends Component
{
    public $for = "name";
    public $search;
    public $sort = "id";
    public $direction = "asc";

    public $ActName, $ActEmail, $ActPassword;

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

    public function update($id){
        $Usuario = User::find($id);

        $this->ActName = $Usuario->name;
        $this->ActEmail = $Usuario->email;

    }
}
