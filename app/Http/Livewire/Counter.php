<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class Counter extends Component
{
    public $for = "name";
    public $search;
    public $sort = "id";
    public $direction = "asc";

    protected $listeners = ['render' => 'render'];

    public function render()
    {
        $users = User::where($this->for, 'LIKE', '%' . $this->search . '%')
        ->orderBy($this->sort, $this->direction)->get();

        return view('livewire.counter', compact('users'));
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
}
