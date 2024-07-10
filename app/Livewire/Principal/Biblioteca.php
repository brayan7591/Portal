<?php

namespace App\Livewire\Principal;

use App\Models\biblioteca as ModelsBiblioteca;
use Livewire\Component;

class Biblioteca extends Component
{
    public $programaid;
    public $search;

    public function render()
    {
        $libros = ModelsBiblioteca::where('Titulo', 'LIKE', '%' . $this->search . '%')->where('programa_id', $this->programaid)->get();
        return view('livewire.principal.biblioteca', compact('libros'));
    }
}
