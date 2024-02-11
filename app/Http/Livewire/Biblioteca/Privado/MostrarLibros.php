<?php

namespace App\Http\Livewire\Biblioteca\Privado;

use App\Models\biblioteca;
use Livewire\Component;
use Livewire\WithPagination;

class MostrarLibros extends Component
{
    use WithPagination;

    protected $paginationTheme = "Bootstrap";
    protected $listeners = ['renderLibros' => 'render', 'delete'];

    public $search;
    public $Books = 1;

    public function updatingSearch(){
        $this->resetPage();
    }

    public function updatingBooks(){
        $this->resetPage();
    }

    public function render(){
        $libros = biblioteca::where('Titulo', 'LIKE', '%' . $this->search . '%')->paginate($this->Books);
        return view('livewire.biblioteca.privado.mostrar-libros', compact('libros'));
    }
}
