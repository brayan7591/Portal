<?php

namespace App\Livewire\Egresados\Privado;

use App\Models\egresado;
use App\Models\programa;
use Livewire\Component;
use Livewire\WithPagination;

class MostrarEgresados extends Component
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
            $egresados = egresado::paginate();
        }else{
            $egresados = egresado::where('programa_id', $this->for)->paginate();
        }

        return view('livewire.egresados.privado.mostrar-egresados', compact('egresados', 'programas'));
    }
}
