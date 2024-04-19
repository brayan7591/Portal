<?php

namespace App\Http\Livewire\Curriculum;

use App\Models\nivele;
use Livewire\Component;

class BuscarCurriculum extends Component
{
    public $nivel;
    public $searchnorma = '';
    public $idnivel;
    public $nivelPrograma;

    public function render(){
        if ($this->nivel->nivel) {
            $competencias = $this->nivel->competencias;
            $this->idnivel = $this->nivel->programa_id;
            $this->nivelPrograma = $this->nivel->nivel;
        }else{
            $nivelaso = nivele::where('nivel', $this->nivelPrograma)->where('programa_id', $this->idnivel)->first();
            if ($this->searchnorma == '') {
                $competencias = $nivelaso->competencias;
            }else{
                $competencias = $nivelaso->competencias->filter(function($value){return false !== stripos($value['norma'], $this->searchnorma);});
            }
        }

        return view('livewire.curriculum.buscar-curriculum', compact('competencias'));
    }
}
