<?php

namespace App\Livewire\Principal;

use App\Models\nivele;
use Livewire\Component;

class Curriculum extends Component
{
    public $nivel;
    public $programa;
    public $searchnorma = '';

    public function render(){
        $nivelaso = nivele::where('SlugInterno', $this->nivel)->where('programa_id', $this->programa)->first();

        $competencias = $nivelaso->competencias->filter(function($value){return false !== stripos($value['norma'], $this->searchnorma);});
        if ($competencias->count() == 0) {
            $competencias = $nivelaso->competencias->filter(function($value){return false !== stripos($value['codigo'], $this->searchnorma);});
            if ($competencias->count() == 0) {
                $competencias = $nivelaso->competencias->filter(function($value){return false !== stripos($value['nombre'], $this->searchnorma);});
            }
        }

        return view('livewire.principal.curriculum', compact('competencias'));
    }
}
