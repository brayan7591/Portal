<?php

namespace App\Livewire\Admin;

use App\Models\instructore;
use App\Models\programa;
use Livewire\Component;

class PersonajesInformativos extends Component
{
    //Variables para agregar un instructor
    public $NombreInstructor, $CorreoInstructor, $EspecialidadInstructor, $TelefonoInstructor, $DescripcionInstructor, $ProgramaInstructor, $JornadaInstructor;

    //Variables para actualizar un instructor
    public $ActualizarNombreInstructor, $ActualizarCorreoInstructor, $ActualizarEspecialidadInstructor, $ActualizarTelefonoInstructor, $ActualizarDescripcionInstructor, $ActualizarProgramaInstructor, $ActualizarJornadaInstructor, $ActualizarInstructorId;
    
    protected $listeners = ['delete'];

    public function render(){
        $programas = programa::all();
        $instructores = instructore::all();
        return view('livewire.admin.personajes-informativos', compact('instructores', 'programas'));
    }

    public function obtenerDatos(instructore $instructor){
        $this->ActualizarInstructorId = $instructor->id;
        $this->ActualizarNombreInstructor = $instructor->Nombre;
        $this->ActualizarCorreoInstructor = $instructor->Email;
        $this->ActualizarEspecialidadInstructor = $instructor->Especialidad;
        $this->ActualizarTelefonoInstructor = $instructor->Telefono;
        $this->ActualizarDescripcionInstructor = $instructor->Descripcion;
        $this->ActualizarProgramaInstructor = $instructor->programa_id;
        $this->ActualizarJornadaInstructor = $instructor->jornada;
    }

    public function ActualizarInstructor(){
        $this->validate([
            'ActualizarNombreInstructor' => ['required'],
            'ActualizarCorreoInstructor' => ['required'],
            'ActualizarEspecialidadInstructor' => ['required'],
            'ActualizarTelefonoInstructor' => ['required'],
            'ActualizarDescripcionInstructor' => ['required'],
            'ActualizarProgramaInstructor' => ['required'],
            'ActualizarJornadaInstructor' => ['required'],
        ]);

        $instructor = instructore::find($this->ActualizarInstructorId);
        $instructor->Nombre = $this->ActualizarNombreInstructor;
        $instructor->Email = $this->ActualizarCorreoInstructor;
        $instructor->Especialidad = $this->ActualizarEspecialidadInstructor;
        $instructor->Telefono = $this->ActualizarTelefonoInstructor;
        $instructor->Descripcion = $this->ActualizarDescripcionInstructor;
        $instructor->programa_id = $this->ActualizarProgramaInstructor;
        $instructor->jornada = $this->ActualizarJornadaInstructor;

        $instructor->save();

        $this->reset(['ActualizarNombreInstructor', 'ActualizarCorreoInstructor', 'ActualizarEspecialidadInstructor', 'ActualizarTelefonoInstructor', 'ActualizarDescripcionInstructor', 'ActualizarProgramaInstructor', 'ActualizarJornadaInstructor', 'ActualizarInstructorId']);
        $this->dispatch('InstructorActualizado');
    }
    public function delete(instructore $id){
        $id->delete();
    }

    public function GuardarInstructor(){
        $this->validate([
            'NombreInstructor' => ['required'],
            'CorreoInstructor' => ['required'],
            'EspecialidadInstructor' => ['required'],
            'TelefonoInstructor' => ['required'],
            'DescripcionInstructor' => ['required'],
            'ProgramaInstructor' => ['required'],
            'JornadaInstructor' => ['required'],
        ]);

        instructore::create([
            'Nombre' => $this->NombreInstructor,
            'Email' => $this->CorreoInstructor,
            'Especialidad' => $this->EspecialidadInstructor,
            'Telefono' => $this->TelefonoInstructor,
            'Descripcion' => $this->DescripcionInstructor,
            'programa_id' => $this->ProgramaInstructor,
            'jornada' => $this->JornadaInstructor
        ]);
        $this->reset(['NombreInstructor', 'CorreoInstructor', 'EspecialidadInstructor', 'TelefonoInstructor', 'DescripcionInstructor', 'ProgramaInstructor', 'JornadaInstructor']);
        $this->dispatch('InstructorAgregado');
    }
}
