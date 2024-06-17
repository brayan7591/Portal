<?php

namespace App\Livewire\Admin;

use Livewire\Component;

class Eventos extends Component
{
    public function render()
    {
        return view('livewire.admin.eventos');
    }
    
    public function placeholder(){
        return view('livewire.admin.cargando');
    }
}
