<?php

namespace App\Http\Livewire\Aprendices\Privado;

use App\Models\aprendice;
use App\Models\programa;
use Livewire\Component;
use Livewire\WithPagination;

class MostrarAprendices extends Component
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
            $aprendices = aprendice::paginate();
        }else{
            $aprendices = aprendice::where('programa_id', $this->for)->paginate();
        }

        return view('livewire.aprendices.privado.mostrar-aprendices', compact('aprendices', 'programas'));
    }
}
