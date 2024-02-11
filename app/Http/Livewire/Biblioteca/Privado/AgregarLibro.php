<?php

namespace App\Http\Livewire\Biblioteca\Privado;

use App\Models\biblioteca;
use Livewire\Component;
use Livewire\WithFileUploads;

class AgregarLibro extends Component
{
    use WithFileUploads;
    
    public $IdBiblioteca, $Titulo, $FechaEstreno, $Editorial, $Imagen, $Formato, $FechaIngreso, $ProgramaFormacion, $Copias, $Estado;

    public function render(){
        return view('livewire.biblioteca.privado.agregar-libro');
    }

    protected $rules = [
        'IdBiblioteca' => ['required'],
        'Titulo' => ['required', 'string'],
        'FechaEstreno' => ['required', 'date'],
        'Editorial' => ['required', 'string'],
        'Imagen' => ['required', 'image'],
        'Formato' => ['required', 'string'],
        'FechaIngreso' => ['required', 'date'],
        'ProgramaFormacion' => ['required', 'string'],
        'Copias' => ['required'],
        'Estado' => ['required']
    ];

    public function save(){
        $this->validate();
        $imagen = $this->Imagen->store('imagenes');
        
        biblioteca::create([
            'IdBiblioteca' => $this->IdBiblioteca,
            'Titulo' => $this->Titulo,
            'FechaEstreno' => $this->FechaEstreno,
            'Editorial' => $this->Editorial,
            'Imagen' => $imagen,
            'Formato' => $this->Formato,
            'FechaIngreso' => $this->FechaIngreso,
            'ProgramaFormacion' => $this->ProgramaFormacion,
            'Copias' => $this->Copias,
            'Estado' => $this->Estado,
        ]);

        $this->reset(['IdBiblioteca', 'Titulo', 'FechaEstreno', 'Editorial', 'Imagen', 'Formato', 'FechaIngreso', 'ProgramaFormacion', 'Copias', 'Estado']);
        $this->emit('renderLibros');
        $this->emit('alertLibros');
    }
}
