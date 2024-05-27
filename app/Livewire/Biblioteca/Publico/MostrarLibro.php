<?php

namespace App\Livewire\Biblioteca\Publico;

use App\Models\biblioteca;
use Livewire\Component;

class MostrarLibro extends Component
{
    public $programaid;
    public $search;

    public function render()
    {
        $libros = biblioteca::where('Titulo', 'LIKE', '%' . $this->search . '%')->where('programa_id', $this->programaid)->get();
        return view('livewire.biblioteca.publico.mostrar-libro', compact('libros'));
    }
}
