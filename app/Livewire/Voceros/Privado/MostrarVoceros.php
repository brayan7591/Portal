<?php

namespace App\Livewire\Voceros\Privado;

use App\Models\programa;
use App\Models\vocero;
use Livewire\Component;
use Livewire\WithPagination;

class MostrarVoceros extends Component
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
            $voceros = vocero::paginate();
        }else{
            $voceros = vocero::where('programa_id', $this->for)->paginate();
        }

        return view('livewire.voceros.privado.mostrar-voceros', compact('voceros', 'programas'));
    }
}
