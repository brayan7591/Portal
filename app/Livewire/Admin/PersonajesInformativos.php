<?php

namespace App\Livewire\Admin;

use App\Models\instructore;
use App\Models\programa;
use App\Models\vocero;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Illuminate\Validation\Rule;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class PersonajesInformativos extends Component
{
    use WithPagination;
    use WithFileUploads;

    //Variables para agregar un vocero
    public $imagenVocero, $NombreVocero, $CorreoVocero, $FichaVocero, $ProgramaVocero;

    //Variables para agregar un instructor
    public $imagenInstructor, $NombreInstructor, $CorreoInstructor, $EspecialidadInstructor, $TelefonoInstructor, $DescripcionInstructor, $ProgramaInstructor, $JornadaInstructor;

    //Variables para actualizar un vocero
    public $ActualizarImagenVoceroActual, $ActualizarVoceroId, $ActualizarImagenVocero, $ActualizarNombreVocero, $ActualizarCorreoVocero, $ActualizarFichaVocero, $ActualizarProgramaVocero;

    //Variables para actualizar un instructor
    public $ActualizarImagenInstructorActual, $ActualizarImagenInstructor, $ActualizarNombreInstructor, $ActualizarCorreoInstructor, $ActualizarEspecialidadInstructor, $ActualizarTelefonoInstructor, $ActualizarDescripcionInstructor, $ActualizarProgramaInstructor, $ActualizarJornadaInstructor, $ActualizarInstructorId;
    
    protected $paginationTheme = "Bootstrap";
    protected $listeners = ['delete', 'deletevoceros'];

    public function updatedImagenInstructor(){
        if (!$this->imagenInstructor == null) {
            $image_info = @getimagesize($this->imagenInstructor->getRealPath());

            if ($image_info === false) {
                $this->reset(['imagenInstructor']);
                $this->addError('imagenInstructor', 'Esta no es una imagen');
            }            
        }
    }

    public function updatedImagenVocero(){
        if (!$this->imagenVocero == null) {
            $image_info = @getimagesize($this->imagenVocero->getRealPath());

            if ($image_info === false) {
                $this->reset(['imagenVocero']);
                $this->addError('imagenVocero', 'Esto no es una imagen');
            }else{
                $this->resetErrorBag('imagenVocero');
            }
        }
    }

    public function updatedActualizarImagenVocero(){
        if (!$this->ActualizarImagenVocero == null) {
            $image_info = @getimagesize($this->ActualizarImagenVocero->getRealPath());

            if ($image_info === false) {
                $this->reset(['ActualizarImagenVocero']);
                $this->addError('ActualizarImagenVocero', 'Esto no es una imagen');
            }else{
                $this->resetErrorBag('ActualizarImagenVocero');
            }

            $this->ActualizarImagenVoceroActual = null;

        }
    }

    public function updatedActualizarImagenInstructor(){
        if (!$this->ActualizarImagenInstructor == null) {
            $image_info = @getimagesize($this->ActualizarImagenInstructor->getRealPath());

            if ($image_info === false) {
                $this->reset(['ActualizarImagenInstructor']);
                $this->addError('ActualizarImagenInstructor', 'Esto no es una imagen');
            }else{
                $this->resetErrorBag('ActualizarImagenInstructor');
            }

            $this->ActualizarImagenInstructorActual = null;

        }
    }

    public function render(){
        $voceros = vocero::paginate(10);
        $programas = programa::all();
        $instructores = instructore::paginate(10);
        return view('livewire.admin.personajes-informativos', compact('instructores', 'programas', 'voceros'));
    }

    public function placeholder(){
        return view('livewire.admin.cargando');
    }

    public function obtenerDatosVoceros(vocero $vocero){
        $this->reset('ActualizarImagenVoceroActual');
        $this->reset('ActualizarImagenVocero');
        $this->ActualizarVoceroId = $vocero->id;
        $this->ActualizarNombreVocero = $vocero->Nombre;
        $this->ActualizarCorreoVocero = $vocero->Email;
        $this->ActualizarFichaVocero = $vocero->NoFicha;
        $this->ActualizarProgramaVocero = $vocero->programa_id;
        $this->ActualizarImagenVoceroActual = $vocero->imagen()->count() > 0 ? $vocero->imagen->url : '';

    }
    public function obtenerDatos(instructore $instructor){
        $this->reset('ActualizarImagenInstructorActual');
        $this->reset('ActualizarImagenInstructor');
        $this->ActualizarInstructorId = $instructor->id;
        $this->ActualizarNombreInstructor = $instructor->Nombre;
        $this->ActualizarCorreoInstructor = $instructor->Email;
        $this->ActualizarEspecialidadInstructor = $instructor->Especialidad;
        $this->ActualizarTelefonoInstructor = $instructor->Telefono;
        $this->ActualizarDescripcionInstructor = $instructor->Descripcion;
        $this->ActualizarProgramaInstructor = $instructor->programa_id;
        $this->ActualizarJornadaInstructor = $instructor->jornada;
        $this->ActualizarImagenInstructorActual = $instructor->imagen()->count() > 0 ? $instructor->imagen->url : '';
    }

    public function ActualizarVocero(){
        $this->validate([
            'ActualizarNombreVocero' => ['required'],
            'ActualizarCorreoVocero' => ['required', 'email', 'max:255', Rule::unique('voceros', 'Email')->ignore($this->ActualizarVoceroId)],
            'ActualizarFichaVocero' => ['required', 'max:10', Rule::unique('voceros', 'NoFicha')->ignore($this->ActualizarVoceroId)],
            'ActualizarProgramaVocero' => ['required', 'numeric', 'exists:programas,id'],
            'ActualizarImagenVocero' => ['nullable', 'image'],
        ]);

        $vocero = vocero::find($this->ActualizarVoceroId);
        $vocero->Nombre = $this->ActualizarNombreVocero;
        $vocero->Email = $this->ActualizarCorreoVocero;
        $vocero->NoFicha = $this->ActualizarFichaVocero;
        $vocero->programa_id = $this->ActualizarProgramaVocero;
        $vocero->save();

        if ($this->ActualizarImagenVoceroActual == null) {
            if ($this->ActualizarImagenVocero) {
                if ($vocero->imagen()->count() > 0) {
                    Storage::delete($vocero->imagen->url);
                    $vocero->imagen()->delete();
                }
                $imagen = $this->ActualizarImagenVocero->store('public/imagenes/Voceros');
                $vocero->imagen()->create(['url' => $imagen]);
            }else{
                if ($vocero->imagen()->count() > 0) {
                    Storage::delete($vocero->imagen->url);
                    $vocero->imagen()->delete();
                }
            }
        }

        $this->reset(['ActualizarNombreVocero', 'ActualizarCorreoVocero', 'ActualizarFichaVocero', 'ActualizarProgramaVocero', 'ActualizarImagenVocero', 'ActualizarImagenVoceroActual']);
        $this->dispatch('VoceroActualizado');
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
            'ActualizarImagenInstructor' => ['nullable', 'image']
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

        if ($this->ActualizarImagenInstructorActual == null) {
            if ($this->ActualizarImagenInstructor) {
                if ($instructor->imagen()->count() > 0) {
                    Storage::delete($instructor->imagen->url);
                    $instructor->imagen()->delete();
                }
                $imagen = $this->ActualizarImagenInstructor->store('public/imagenes/Voceros');
                $instructor->imagen()->create(['url' => $imagen]);
            }else{
                if ($instructor->imagen()->count() > 0) {
                    Storage::delete($instructor->imagen->url);
                    $instructor->imagen()->delete();
                }
            }
        }

        $this->reset(['ActualizarImagenInstructorActual', 'ActualizarNombreInstructor', 'ActualizarCorreoInstructor', 'ActualizarEspecialidadInstructor', 'ActualizarTelefonoInstructor', 'ActualizarDescripcionInstructor', 'ActualizarProgramaInstructor', 'ActualizarJornadaInstructor', 'ActualizarInstructorId']);
        $this->dispatch('InstructorActualizado');
    }

    public function deletevoceros(vocero $id){
        $id->delete();
    }

    public function delete(instructore $id){
        $id->delete();
    }

    public function GuardarVocero(){
        $this->validate([
            'NombreVocero' => ['required'],
            'CorreoVocero' => ['required', 'email', 'max:255', 'unique:voceros,Email'],
            'FichaVocero' => ['required', 'max:10', 'unique:voceros,NoFicha'],
            'ProgramaVocero' => ['required', 'numeric', 'exists:programas,id'],
            'imagenVocero' => ['nullable', 'image'],
        ]);
        if ($this->imagenVocero == null || $this->imagenVocero == "") {
            vocero::create([
                'Nombre' => $this->NombreVocero,
                'Email' => $this->CorreoVocero,
                'NoFicha' => $this->FichaVocero,
                'programa_id' => $this->ProgramaVocero,
            ]);
        }else{
            $imagen = $this->imagenVocero->store('public/imagenes/Voceros');
            
            vocero::create([
                'Nombre' => $this->NombreVocero,
                'Email' => $this->CorreoVocero,
                'NoFicha' => $this->FichaVocero,
                'programa_id' => $this->ProgramaVocero,
            ])->imagen()->create(['url' => $imagen]);
        }
        $this->reset(['imagenVocero', 'ProgramaVocero', 'CorreoVocero', 'NombreVocero', 'FichaVocero']);
        $this->dispatch('VoceroAgregado');
    }

    public function GuardarInstructor(){
        $this->validate([
            'NombreInstructor' => ['required'],
            'CorreoInstructor' => ['required', 'email', 'max:255', 'unique:instructores,Email'],
            'EspecialidadInstructor' => ['required'],
            'TelefonoInstructor' => ['required', 'max:10'],
            'DescripcionInstructor' => ['required'],
            'ProgramaInstructor' => ['required', 'numeric', 'exists:programas,id'],
            'JornadaInstructor' => ['required', 'in:mañana,tarde,mixta,nocturna'],
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
