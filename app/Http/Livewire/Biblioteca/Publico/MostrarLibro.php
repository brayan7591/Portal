<?php

namespace App\Http\Livewire\Biblioteca\Publico;

use App\Models\biblioteca;
use Livewire\Component;

class MostrarLibro extends Component
{
    public $search;

    public function render()
    {
        $libros = biblioteca::where('Titulo', 'LIKE', '%' . $this->search . '%')->get();
        return view('livewire.biblioteca.publico.mostrar-libro', compact('libros'));
    }
}
