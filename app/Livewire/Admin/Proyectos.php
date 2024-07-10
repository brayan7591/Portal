<?php

namespace App\Livewire\Admin;

use App\Models\programa;
use App\Models\proyecto;
use Livewire\Component;
use Livewire\WithPagination;

class Proyectos extends Component
{
    use WithPagination;

    //Variables para agregar un proyecto
    public $NombreProyecto, $ObjetivoProyecto, $JustificacionProyecto, $FechaInicialProyecto, $FechaFinalProyecto, $ProgramaProyecto;

    //Variables para actualizar un proyecto
    public $ActualizarNombreProyecto, $ActualizarObjetivoProyecto, $ActualizarJustificacionProyecto, $ActualizarFechaInicialProyecto, $ActualizarFechaFinalProyecto, $ActualizarProgramaProyecto, $ActualizarProgramaId;

    public function updatingSearch(){
        $this->resetPage();
    }

    protected $listeners = ['deleteproyectos'];
    protected $paginationTheme = "Bootstrap";

    public $search, $registros = 10;

    public function render(){
        $programas = programa::all();
        $proyectos = proyecto::where('Nombre', 'LIKE', '%' . $this->search . '%')->orWhere('FechaInicio', 'LIKE', '%' . $this->search . '%')->orWhere('FechaFinalizacion', 'LIKE', '%' . $this->search . '%')->paginate($this->registros);
        return view('livewire.admin.proyectos', compact('proyectos', 'programas'));
    }

    public function GuardarProyecto(){
        $this->validate([
            'NombreProyecto' => ['required', 'max:255'],
            'ObjetivoProyecto' => ['required'],
            'JustificacionProyecto' => ['required'],
            'FechaInicialProyecto' => ['required', 'date'],
            'FechaFinalProyecto' => ['required', 'date'],
            'ProgramaProyecto' => ['required', 'numeric', 'exists:programas,id'],
        ]);

        proyecto::create([
            'Nombre' => $this->NombreProyecto,
            'Objetivo' => $this->ObjetivoProyecto,
            'Justificacion' => $this->JustificacionProyecto,
            'FechaInicio' => $this->FechaInicialProyecto,
            'FechaFinalizacion' => $this->FechaFinalProyecto,
            'programa_id' => $this->ProgramaProyecto,
        ]);

        $this->reset(['NombreProyecto', 'ObjetivoProyecto', 'JustificacionProyecto', 'FechaInicialProyecto', 'FechaFinalProyecto', 'ProgramaProyecto']);
        $this->dispatch('ProyectoAgregado');
    }

    public function obtenerDatosProyecto(proyecto $proyecto){
        $this->ActualizarProgramaId = $proyecto->id;
        $this->ActualizarNombreProyecto = $proyecto->Nombre;
        $this->ActualizarObjetivoProyecto = $proyecto->Objetivo;
        $this->ActualizarJustificacionProyecto = $proyecto->Justificacion;
        $this->ActualizarFechaInicialProyecto = $proyecto->FechaInicio;
        $this->ActualizarFechaFinalProyecto = $proyecto->FechaFinalizacion;
        $this->ActualizarProgramaProyecto = $proyecto->programa_id;
    }
    public function ActualizarProyecto(){
        $this->validate([
            'ActualizarNombreProyecto' => ['required', 'max:255'],
            'ActualizarObjetivoProyecto' => ['required'],
            'ActualizarJustificacionProyecto' => ['required'],
            'ActualizarFechaInicialProyecto' => ['required', 'date'],
            'ActualizarFechaFinalProyecto' => ['required', 'date'],
            'ActualizarProgramaProyecto' => ['required', 'numeric', 'exists:programas,id'],
        ]);

        $proyecto = proyecto::find($this->ActualizarProgramaId);
        $proyecto->Nombre = $this->ActualizarNombreProyecto;
        $proyecto->Objetivo = $this->ActualizarObjetivoProyecto;
        $proyecto->Justificacion = $this->ActualizarJustificacionProyecto;
        $proyecto->FechaInicio = $this->ActualizarFechaInicialProyecto;
        $proyecto->FechaFinalizacion = $this->ActualizarFechaFinalProyecto;
        $proyecto->programa_id = $this->ActualizarProgramaProyecto;

        $proyecto->save();

        $this->reset(['ActualizarProgramaId', 'ActualizarNombreProyecto', 'ActualizarObjetivoProyecto', 'ActualizarJustificacionProyecto', 'ActualizarFechaInicialProyecto', 'ActualizarFechaFinalProyecto', 'ActualizarProgramaProyecto']);
        $this->dispatch('ProyectoActualizado');
    }
    public function deleteproyectos(proyecto $proyecto){
        $proyecto->delete();
    }

    public function placeholder(){
        return view('livewire.admin.cargando');
    }
    
}
