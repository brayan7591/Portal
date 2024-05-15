<?php

namespace App\Livewire\Biblioteca\Privado;

use App\Models\biblioteca;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class MostrarLibros extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $ActualizarLibro, $IdBibliotecaActualizar, $TituloActualizar, $FechaEstrenoActualizar, $EditorialActualizar, $ImagenActual, $ImagenActualizar, $FormatoActualizar, $FechaIngresoActualizar, $ProgramaFormacionActualizar, $CopiasActualizar, $EstadoActualizar;

    protected $paginationTheme = "Bootstrap";
    protected $listeners = ['renderLibros' => 'render', 'delete' => 'delete'];

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

    protected $rules = [
        'IdBibliotecaActualizar' => ['required'],
        'TituloActualizar' => ['required', 'string'],
        'FechaEstrenoActualizar' => ['required', 'date'],
        'EditorialActualizar' => ['required', 'string'],
        'ImagenActualizar' => ['image', 'nullable'],
        'FormatoActualizar' => ['required', 'string'],
        'FechaIngresoActualizar' => ['required', 'date'],
        'ProgramaFormacionActualizar' => ['required', 'string'],
        'CopiasActualizar' => ['required'],
        'EstadoActualizar' => ['required']
    ];

    public function update(biblioteca $libro){

        $this->ActualizarLibro = $libro;
        $this->IdBibliotecaActualizar = $libro->IdBiblioteca;
        $this->TituloActualizar = $libro->Titulo;
        $this->FechaEstrenoActualizar = $libro->FechaEstreno;
        $this->EditorialActualizar = $libro->Editorial;
        $this->ImagenActual = $libro->Imagen;
        $this->FormatoActualizar = $libro->Formato;
        $this->FechaIngresoActualizar = $libro->FechaIngreso;
        $this->ProgramaFormacionActualizar = $libro->ProgramaFormacion;
        $this->CopiasActualizar = $libro->Copias;
        $this->EstadoActualizar = $libro->Estado;
    }

    public function Actualizar(biblioteca $libro){
        $this->validate();
        if ($this->ImagenActualizar) {
            Storage::delete($this->ImagenActual);
            $imagen = $this->ImagenActualizar->store('imagenes');
            $libro->Imagen = $imagen;
        }

        $libro->IdBiblioteca = $this->IdBibliotecaActualizar;
        $libro->Titulo = $this->TituloActualizar;
        $libro->FechaEstreno = $this->FechaEstrenoActualizar;
        $libro->Editorial = $this->EditorialActualizar;
        $libro->Formato = $this->FormatoActualizar;
        $libro->FechaIngreso = $this->FechaIngresoActualizar;
        $libro->ProgramaFormacion = $this->ProgramaFormacionActualizar;
        $libro->Copias = $this->CopiasActualizar;
        $libro->Estado = $this->EstadoActualizar;
        $libro->save();

        $this->reset(['ActualizarLibro', 'IdBibliotecaActualizar', 'TituloActualizar', 'FechaEstrenoActualizar', 'EditorialActualizar', 'ImagenActual', 'ImagenActualizar', 'FormatoActualizar', 'FechaIngresoActualizar', 'ProgramaFormacionActualizar', 'CopiasActualizar', 'EstadoActualizar']);

        $this->dispatch('ActualizarLibro');
    }

    public function delete(biblioteca $libro){
        Storage::delete($libro->Imagen);
        $libro->delete();
    }
}
