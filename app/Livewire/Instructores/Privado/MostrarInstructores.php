<?php

namespace App\Livewire\Instructores\Privado;

use App\Models\instructore;
use App\Models\programa;
use Livewire\Component;
use Livewire\WithPagination;

class MostrarInstructores extends Component
{
    use WithPagination;
    
    public $for = "todos";
    public $search;

    public $nombre, $programa;

    protected $paginationTheme = "Bootstrap";
    
    public function updatingSearch(){
        $this->resetPage();
    }

    public function render()
    {
        $programas = programa::all();

        if ($this->for == 'todos') {
            $instructores = instructore::paginate();
        }else{
            $instructores = instructore::where('programa_id', $this->for)->paginate();
        }

        return view('livewire.instructores.privado.mostrar-instructores', compact('instructores', 'programas'));
    }
}
