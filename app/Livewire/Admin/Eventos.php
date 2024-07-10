<?php

namespace App\Livewire\Admin;

use App\Models\evento;
use App\Models\galeria;
use App\Models\programa;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Eventos extends Component
{
    use WithFileUploads;
    use WithPagination;
    
    protected $paginationTheme = "Bootstrap";
    protected $listeners = ['deleteImagenes', 'deleteEventos'];

    public $MostrarMenu = false, $OpcionActual = 'Eventos', $search, $registros = 10;

    //Variables para agregar una imagen a la galeria
    public $ProgramaImagen, $Imagen_agregar;

    //Variable para actualizar una imagen de la galeria
    public $Imagen_actualizar;

    //Variables para agregar un evento
    public $NombreEvento, $DescripcionEvento, $FechaEvento, $ProgramaEvento;

    //Variables para actualizar un evento
    public $ActualizarEventoId, $ActualizarNombreEvento, $ActualizarDescripcionEvento, $ActualizarFechaEvento, $ActualizarProgramaEvento;

    public function updatingSearch(){
        $this->resetPage();
    }

    public function updatingOpcionActual(){
        $this->reset(['search']);
    }

    public function render(){
        $programas = programa::all();

        if ($this->OpcionActual == 'Eventos') {
            $eventos = evento::where('nombre', 'LIKE', '%' . $this->search . '%')->orderBy('updated_at', 'desc')->paginate($this->registros);
            return view('livewire.admin.eventos', compact('eventos', 'programas'));
        }else{
            $galeria = galeria::where('programa_id', $this->search)->paginate($this->registros);
            return view('livewire.admin.eventos', compact('programas', 'galeria'));
        }
    }

    public function obtenerDatosEvento(evento $evento){
        $this->ActualizarEventoId = $evento->id;
        $this->ActualizarNombreEvento = $evento->nombre;
        $this->ActualizarDescripcionEvento = $evento->descripción;
        $this->ActualizarFechaEvento = $evento->Fecha;
        $this->ActualizarProgramaEvento = $evento->programa_id;
    }

    public function GuardarEvento(){
        $this->validate([
            'NombreEvento' => ['required', 'max:255'],
            'DescripcionEvento' => ['required'],
            'FechaEvento' => ['required', 'date'],
            'ProgramaEvento' => ['required', 'numeric', 'exists:programas,id'],
        ]);

        evento::create([
            'nombre' => $this->NombreEvento,
            'descripción' => $this->DescripcionEvento,
            'Fecha' => $this->FechaEvento,
            'programa_id' => $this->ProgramaEvento,
        ]);

        $this->reset(['NombreEvento', 'DescripcionEvento', 'FechaEvento', 'ProgramaEvento']);
        $this->dispatch('EventoAgregado');
    }

    public function ActualizarImagen(galeria $galeria){
        $this->validate([
            'Imagen_actualizar' => ['required', 'image'],
        ]);

        Storage::delete($galeria->imagen);

        $imagen = $this->Imagen_actualizar->store('public/imagenes/galeria');

        $galeria->imagen = $imagen;
        $galeria->save();

        $this->reset(['Imagen_actualizar']);
        $this->dispatch('ImagenActualizada');
    }

    public function ActualizarEvento(){
        $this->validate([
            'ActualizarNombreEvento' => ['required', 'max:255'],
            'ActualizarDescripcionEvento' => ['required'],
            'ActualizarFechaEvento' => ['required', 'date'],
            'ActualizarProgramaEvento' => ['required', 'numeric', 'exists:programas,id'],
        ]);

        $Evento = evento::find($this->ActualizarEventoId);
        $Evento->nombre = $this->ActualizarNombreEvento;
        $Evento->descripción = $this->ActualizarDescripcionEvento;
        $Evento->Fecha = $this->ActualizarFechaEvento;
        $Evento->programa_id = $this->ActualizarProgramaEvento;
        $Evento->save();

        $this->reset(['ActualizarNombreEvento', 'ActualizarDescripcionEvento', 'ActualizarFechaEvento', 'ActualizarProgramaEvento', 'ActualizarEventoId']);
        $this->dispatch('EventoActualizado');
    }

    public function GuardarImagen(){
        $this->validate([
            'ProgramaImagen' => ['required', 'numeric', 'exists:programas,id'],
            'Imagen_agregar' => ['required', 'image'],
        ]);

        $imagen = $this->Imagen_agregar->store('public/imagenes/galeria');
        
        galeria::create([
            'imagen' => $imagen,
            'programa_id' => $this->ProgramaImagen,
        ]);

        $this->reset(['Imagen_agregar', 'programa_id']);
        $this->dispatch('ImagenAgregada');
    }

    public function deleteImagenes(galeria $id){
        $id->delete();
    }

    public function deleteEventos(evento $id){
        $id->delete();
    }

    public function placeholder(){
        return view('livewire.admin.cargando');
    }
}
