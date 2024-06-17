<?php

namespace App\Livewire\Admin;

use App\Models\personajes_destacado;
use Livewire\Component;
use Livewire\WithPagination;

class PersonajesDestacados extends Component
{
    use WithPagination;

    public $personaje = 'todos', $registros = 10, $search;

    public function render(){

        if($this->personaje == 'todos' || $this->personaje != 'egresado' || $this->personaje != 'aprendiz'){
            $destacados = personajes_destacado::paginate($this->registros);
        }

        if ($this->personaje == 'aprendiz') {
            $destacados = personajes_destacado::where('rol', 'Aprendiz')->paginate(3);
        }

        if ($this->personaje == 'egresado') {
            $destacados = personajes_destacado::where('rol', 'Egresado')->paginate(3);
        }

        return view('livewire.admin.personajes-destacados', compact('destacados'));
    }

    public function placeholder(){
        return view('livewire.admin.cargando');
    }
}
