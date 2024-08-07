<?php

namespace App\Livewire\Admin;

use App\Models\biblioteca as ModelsBiblioteca;
use App\Models\programa;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class Biblioteca extends Component
{
    use WithPagination;
    use WithFileUploads;
    
    //Variables para agregar un libro
    public $IdBiblioteca, $Titulo, $FechaEstreno, $Editorial, $Imagen, $Formato, $FechaIngreso, $ProgramaFormacion, $Copias, $Estado;
    
    //Variables para actualizar un libro
    public $ActualizarLibro, $IdBibliotecaActualizar, $TituloActualizar, $FechaEstrenoActualizar, $EditorialActualizar, $ImagenActual, $ImagenActualizar, $FormatoActualizar, $FechaIngresoActualizar, $ProgramaFormacionActualizar, $CopiasActualizar, $EstadoActualizar;

    protected $paginationTheme = "Bootstrap";
    protected $listeners = ['delete'];

    public $search;
    public $Books = 10;

    public function updatingSearch(){
        $this->resetPage();
    }

    public function updatingBooks(){
        $this->resetPage();
    }

    public function save(){
        $this->validate([
            'IdBiblioteca' => ['required', 'numeric', 'max_digits:20', 'unique:bibliotecas,IdBiblioteca'],
            'Titulo' => ['required', 'string','max:255'],
            'FechaEstreno' => ['required', 'date'],
            'Editorial' => ['required', 'string', 'max:255'],
            'Imagen' => ['required', 'image', 'max:255'],
            'Formato' => ['required', 'string', 'max:255'],
            'FechaIngreso' => ['required', 'date'],
            'ProgramaFormacion' => ['required', 'numeric', 'exists:programas,id'],
            'Copias' => ['required', 'numeric', 'max_digits:11'],
            'Estado' => ['required', 'max:255']
        ]);

        $imagen = $this->Imagen->store('public/imagenes/libros');
        
        ModelsBiblioteca::create([
            'IdBiblioteca' => $this->IdBiblioteca,
            'Titulo' => $this->Titulo,
            'FechaEstreno' => $this->FechaEstreno,
            'Editorial' => $this->Editorial,
            'Imagen' => $imagen,
            'Formato' => $this->Formato,
            'FechaIngreso' => $this->FechaIngreso,
            'programa_id' => $this->ProgramaFormacion,
            'Copias' => $this->Copias,
            'Estado' => $this->Estado,
        ]);

        $this->reset(['IdBiblioteca', 'Titulo', 'FechaEstreno', 'Editorial', 'Imagen', 'Formato', 'FechaIngreso', 'ProgramaFormacion', 'Copias', 'Estado']);
        $this->dispatch('alertLibros');
    }
    
    public function placeholder(){
        return view('livewire.admin.cargando');
    }

    public function update(ModelsBiblioteca $libro){

        $this->ActualizarLibro = $libro;
        $this->IdBibliotecaActualizar = $libro->IdBiblioteca;
        $this->TituloActualizar = $libro->Titulo;
        $this->FechaEstrenoActualizar = $libro->FechaEstreno;
        $this->EditorialActualizar = $libro->Editorial;
        $this->ImagenActual = $libro->Imagen;
        $this->FormatoActualizar = $libro->Formato;
        $this->FechaIngresoActualizar = $libro->FechaIngreso;
        $this->ProgramaFormacionActualizar = $libro->programa_id;
        $this->CopiasActualizar = $libro->Copias;
        $this->EstadoActualizar = $libro->Estado;
    }

    public function Actualizar(ModelsBiblioteca $libro){

        $this->validate([
            'IdBibliotecaActualizar' => ['required', 'numeric', 'max_digits:20', Rule::unique('bibliotecas', 'IdBiblioteca')->ignore($libro)],
            'TituloActualizar' => ['required', 'string', 'max:255'],
            'FechaEstrenoActualizar' => ['required', 'date'],
            'EditorialActualizar' => ['required', 'string', 'max:255'],
            'ImagenActualizar' => ['image', 'nullable', 'max:255'],
            'FormatoActualizar' => ['required', 'string', 'max:255'],
            'FechaIngresoActualizar' => ['required', 'date'],
            'ProgramaFormacionActualizar' => ['required', 'numeric', 'exists:programas,id'],
            'CopiasActualizar' => ['required', 'max_digits:11'],
            'EstadoActualizar' => ['required', 'max:255']
        ]);

        if ($this->ImagenActualizar) {
            Storage::delete($this->ImagenActual);
            $imagen = $this->ImagenActualizar->store('public/imagenes/libros');
            $libro->Imagen = $imagen;
        }

        $libro->IdBiblioteca = $this->IdBibliotecaActualizar;
        $libro->Titulo = $this->TituloActualizar;
        $libro->FechaEstreno = $this->FechaEstrenoActualizar;
        $libro->Editorial = $this->EditorialActualizar;
        $libro->Formato = $this->FormatoActualizar;
        $libro->FechaIngreso = $this->FechaIngresoActualizar;
        $libro->programa_id = $this->ProgramaFormacionActualizar;
        $libro->Copias = $this->CopiasActualizar;
        $libro->Estado = $this->EstadoActualizar;
        $libro->save();

        $this->reset(['ActualizarLibro', 'IdBibliotecaActualizar', 'TituloActualizar', 'FechaEstrenoActualizar', 'EditorialActualizar', 'ImagenActual', 'ImagenActualizar', 'FormatoActualizar', 'FechaIngresoActualizar', 'ProgramaFormacionActualizar', 'CopiasActualizar', 'EstadoActualizar']);

        $this->dispatch('ActualizarLibro');
    }

    public function delete(ModelsBiblioteca $libro){
        Storage::delete($libro->Imagen);
        $libro->delete();
    }

    public function render(){
        $programas = programa::all();
        $libros = ModelsBiblioteca::where('Titulo', 'LIKE', '%' . $this->search . '%')->paginate($this->Books);
        return view('livewire.admin.biblioteca', compact('libros', 'programas'));
    }
}
