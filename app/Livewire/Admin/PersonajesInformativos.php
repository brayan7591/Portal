<?php

namespace App\Livewire\Admin;

use App\Models\instructore;
use App\Models\programa;
use Livewire\Component;
use Illuminate\Validation\Rule;
use Livewire\WithFileUploads;

class PersonajesInformativos extends Component
{
    use WithFileUploads;

    //Variables para agregar un instructor
    public $imagenInstructor, $NombreInstructor, $CorreoInstructor, $EspecialidadInstructor, $TelefonoInstructor, $DescripcionInstructor, $ProgramaInstructor, $JornadaInstructor;

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
            'ActualizarCorreoInstructor' => ['required', 'string', 'email', 'max:255', Rule::unique('instructores', 'Email')->ignore($this->ActualizarInstructorId)],
            'ActualizarEspecialidadInstructor' => ['required'],
            'ActualizarTelefonoInstructor' => ['required', 'max:10'],
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
            'CorreoInstructor' => ['required', 'email', 'max:255', 'unique:instructores,Email'],
            'EspecialidadInstructor' => ['required'],
            'TelefonoInstructor' => ['required', 'max:10'],
            'DescripcionInstructor' => ['required'],
            'ProgramaInstructor' => ['required'],
            'JornadaInstructor' => ['required'],
            'imagenInstructor' => ['nullable', 'image'],
        ]);
        if ($this->imagenInstructor == null || $this->imagenInstructor == "") {
            instructore::create([
                'Nombre' => $this->NombreInstructor,
                'Email' => $this->CorreoInstructor,
                'Especialidad' => $this->EspecialidadInstructor,
                'Telefono' => $this->TelefonoInstructor,
                'Descripcion' => $this->DescripcionInstructor,
                'programa_id' => $this->ProgramaInstructor,
                'jornada' => $this->JornadaInstructor
            ]);
        }else{
            $imagen = $this->imagenInstructor->store('public/imagenes/Instructores');
            
            instructore::create([
                'Nombre' => $this->NombreInstructor,
                'Email' => $this->CorreoInstructor,
                'Especialidad' => $this->EspecialidadInstructor,
                'Telefono' => $this->TelefonoInstructor,
                'Descripcion' => $this->DescripcionInstructor,
                'programa_id' => $this->ProgramaInstructor,
                'jornada' => $this->JornadaInstructor
            ])->imagen()->create(['url' => $imagen]);
        }
        
        $this->reset(['imagenInstructor', 'NombreInstructor', 'CorreoInstructor', 'EspecialidadInstructor', 'TelefonoInstructor', 'DescripcionInstructor', 'ProgramaInstructor', 'JornadaInstructor']);
        $this->dispatch('InstructorAgregado');
    }
}
