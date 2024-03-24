<?php

namespace App\Http\Livewire\Instructores\Publico;

use App\Models\programa;
use Livewire\Component;

class MostrarInstructor extends Component
{
    public $programa;
    
    public function render(programa $programa)
    {
        return view('livewire.instructores.publico.mostrar-instructor', compact('programa'));
    }
}
