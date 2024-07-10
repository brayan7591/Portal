<?php

namespace App\Livewire\Admin;

use App\Models\personajes_destacado;
use App\Models\programa;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class PersonajesDestacados extends Component
{
    use WithFileUploads;
    use WithPagination;
    
    protected $paginationTheme = "Bootstrap";
    protected $listeners = ['deletePersonaje'];

    //Variables para agregar un personaje destacado (Egresado o Aprendiz)
    public $NombrePersonajeDestacado, $CorreoPersonajeDestacado, $FichaPersonajeDestacado, $MotivoPersonajeDestacado, $ProgramaPersonajeDestacado, $RolPersonajeDestacado, $imagenPersonajeDestacado;

    //Variables para actualizar un personaje destacado
    public $ActualizarNombrePersonajeDestacado, $ActualizarCorreoPersonajeDestacado, $ActualizarFichaPersonajeDestacado, $ActualizarMotivoPersonajeDestacado, $ActualizarProgramaPersonajeDestacado, $ActualizarRolPersonajeDestacado, $ActualizarimagenPersonajeDestacado, $ActualizarImagenPersonajeDestacadoActual, $ActualizarPersonajeDestacadoId;

    public $personaje = 'todos', $registros = 10, $search, $buscar;

    public function render(){
        
        if ($this->buscar == null || $this->buscar == '') {
            $this->buscar = 'nombre';
        }else{
            if (!($this->buscar == 'nombre' || $this->buscar == 'correo' || $this->buscar == 'numero_ficha')) {
                if(!($this->buscar == 'programa')){
                    $this->buscar = 'nombre';
                }
            }
        }

        if($this->personaje == 'todos' || $this->personaje != 'egresado' || $this->personaje != 'aprendiz'){
            if ($this->buscar == 'programa') {
                if ($this->search == '') {
                    $destacados = personajes_destacado::paginate($this->registros);
                }else{
                    $destacados = personajes_destacado::where('programa_id', $this->search)->paginate($this->registros);
                }
            }else{
                $destacados = personajes_destacado::where($this->buscar, 'LIKE', '%' . $this->search . '%')->paginate($this->registros);
            }
        }

        if ($this->personaje == 'aprendiz') {
            if ($this->buscar == 'programa') {
                if ($this->search == '') {
                    $destacados = personajes_destacado::where('rol', 'Aprendiz')->paginate($this->registros);
                }else{
                    $destacados = personajes_destacado::where('rol', 'Aprendiz')->where('programa_id', $this->search)->paginate($this->registros);
                }
            }else{
                $destacados = personajes_destacado::where('rol', 'Aprendiz')->where($this->buscar, 'LIKE', '%' . $this->search . '%')->paginate($this->registros);
            }
        }

        if ($this->personaje == 'egresado') {
            if ($this->buscar == 'programa') {
                if ($this->search == '') {
                    $destacados = personajes_destacado::where('rol', 'Egresado')->paginate($this->registros);
                }else{
                    $destacados = personajes_destacado::where('rol', 'Egresado')->where('programa_id', $this->search)->paginate($this->registros);
                }
            }else{
                $destacados = personajes_destacado::where('rol', 'Egresado')->where($this->buscar, 'LIKE', '%' . $this->search . '%')->paginate($this->registros);
            }
        }

        $programas = programa::all();

        return view('livewire.admin.personajes-destacados', compact('destacados', 'programas'));
    }

    public function deletePersonaje(personajes_destacado $personaje){
        $personaje->delete();
    }

    public function GuardarPersonajeDestacado(){
        $this->validate([
            'NombrePersonajeDestacado' => ['required', 'max:255'],
            'CorreoPersonajeDestacado' => ['required', 'email', 'max:255', 'unique:personajes_destacados,correo'],
            'FichaPersonajeDestacado' => ['nullable', 'max_digits:10'],
            'MotivoPersonajeDestacado' => ['required'],
            'ProgramaPersonajeDestacado' => ['required', 'numeric', 'exists:programas,id'],
            'RolPersonajeDestacado' => ['required', 'in:Aprendiz,Egresado'],
            'imagenPersonajeDestacado' => ['nullable', 'image'],
        ]);

        if ($this->imagenPersonajeDestacado == null || $this->imagenPersonajeDestacado == "") {
            personajes_destacado::create([
                'nombre' => $this->NombrePersonajeDestacado,
                'correo' => $this->CorreoPersonajeDestacado,
                'numero_ficha' => $this->FichaPersonajeDestacado,
                'motivo' => $this->MotivoPersonajeDestacado,
                'programa_id' => $this->ProgramaPersonajeDestacado,
                'rol' => $this->RolPersonajeDestacado
            ]);
        }else{
            $imagen = $this->imagenPersonajeDestacado->store('public/imagenes/Personajes_destacados');
            
            personajes_destacado::create([
                'nombre' => $this->NombrePersonajeDestacado,
                'correo' => $this->CorreoPersonajeDestacado,
                'numero_ficha' => $this->FichaPersonajeDestacado,
                'motivo' => $this->MotivoPersonajeDestacado,
                'programa_id' => $this->ProgramaPersonajeDestacado,
                'rol' => $this->RolPersonajeDestacado
            ])->imagen()->create(['url' => $imagen]);
        }
        
        $this->reset(['NombrePersonajeDestacado', 'CorreoPersonajeDestacado', 'FichaPersonajeDestacado', 'MotivoPersonajeDestacado', 'ProgramaPersonajeDestacado', 'RolPersonajeDestacado', 'imagenPersonajeDestacado']);
        $this->dispatch('PersonajeDestacadoAgregado');
    }

    public function obtener_datos(personajes_destacado $personaje){
        $this->reset('ActualizarImagenPersonajeDestacadoActual');
        $this->reset('ActualizarimagenPersonajeDestacado');
        $this->ActualizarPersonajeDestacadoId = $personaje->id;
        $this->ActualizarNombrePersonajeDestacado = $personaje->nombre;
        $this->ActualizarCorreoPersonajeDestacado = $personaje->correo;
        $this->ActualizarFichaPersonajeDestacado = $personaje->numero_ficha;
        $this->ActualizarMotivoPersonajeDestacado = $personaje->motivo;
        $this->ActualizarProgramaPersonajeDestacado = $personaje->programa_id;
        $this->ActualizarRolPersonajeDestacado = $personaje->rol;
        $this->ActualizarImagenPersonajeDestacadoActual = $personaje->imagen()->count() > 0 ? $personaje->imagen->url : '';
    }

    public function ActualizarPersonajeDestacado(){
        $this->validate([
            'ActualizarNombrePersonajeDestacado' => ['required', 'max:255'],
            'ActualizarCorreoPersonajeDestacado' => ['required', 'email', 'max:255', Rule::unique('personajes_destacados', 'correo')->ignore($this->ActualizarPersonajeDestacadoId)],
            'ActualizarFichaPersonajeDestacado' => ['nullable', 'max_digits:10'],
            'ActualizarMotivoPersonajeDestacado' => ['required'],
            'ActualizarProgramaPersonajeDestacado' => ['required', 'numeric', 'exists:programas,id'],
            'ActualizarRolPersonajeDestacado' => ['required', 'in:Aprendiz,Egresado'],
            'ActualizarimagenPersonajeDestacado' => ['nullable', 'image'],
        ]);

        $personaje = personajes_destacado::find($this->ActualizarPersonajeDestacadoId);
        $personaje->nombre = $this->ActualizarNombrePersonajeDestacado;
        $personaje->correo = $this->ActualizarCorreoPersonajeDestacado;
        $personaje->numero_ficha = $this->ActualizarFichaPersonajeDestacado;
        $personaje->motivo = $this->ActualizarMotivoPersonajeDestacado;
        $personaje->programa_id = $this->ActualizarProgramaPersonajeDestacado;
        $personaje->rol = $this->ActualizarRolPersonajeDestacado;
        $personaje->save();

        if ($this->ActualizarImagenPersonajeDestacadoActual == null) {
            if ($this->ActualizarimagenPersonajeDestacado) {
                if ($personaje->imagen()->count() > 0) {
                    Storage::delete($personaje->imagen->url);
                    $personaje->imagen()->delete();
                }
                $imagen = $this->ActualizarimagenPersonajeDestacado->store('public/imagenes/Personajes_destacados');
                $personaje->imagen()->create(['url' => $imagen]);
            }else{
                if ($personaje->imagen()->count() > 0) {
                    Storage::delete($personaje->imagen->url);
                    $personaje->imagen()->delete();
                }
            }
        }
        
        $this->reset(['ActualizarNombrePersonajeDestacado', 'ActualizarCorreoPersonajeDestacado', 'ActualizarFichaPersonajeDestacado', 'ActualizarMotivoPersonajeDestacado', 'ActualizarProgramaPersonajeDestacado', 'ActualizarRolPersonajeDestacado', 'ActualizarimagenPersonajeDestacado', 'ActualizarImagenPersonajeDestacadoActual']);
        $this->dispatch('PersonajeDestacadoActualizado');
    }

    public function CambiarRol(personajes_destacado $personaje){
        if ($personaje->rol == 'Aprendiz') {
            $personaje->rol = 'Egresado';
        }else{
            $personaje->rol = 'Aprendiz';
        }
        $personaje->save();
    }

    public function updatingBuscar(){
        $this->search = '';
    }

    public function updatingSearch(){
        $this->resetPage();
    }

    public function updatingPersonaje(){
        $this->resetPage();
    }

    public function updatingRegistros(){
        $this->resetPage();
    }

    public function updatedImagenPersonajeDestacado(){
        if (!$this->imagenPersonajeDestacado == null) {
            $image_info = @getimagesize($this->imagenPersonajeDestacado->getRealPath());

            if ($image_info === false) {
                $this->reset(['imagenPersonajeDestacado']);
                $this->addError('imagenPersonajeDestacado', 'Esto no es una imagen');
            }else{
                $this->resetErrorBag('imagenPersonajeDestacado');
            }
        }
    }

    public function updatedActualizarimagenPersonajeDestacado(){
        if (!$this->ActualizarimagenPersonajeDestacado == null) {
            $image_info = @getimagesize($this->ActualizarimagenPersonajeDestacado->getRealPath());

            if ($image_info === false) {
                $this->reset(['ActualizarimagenPersonajeDestacado']);
                $this->addError('ActualizarimagenPersonajeDestacado', 'Esto no es una imagen');
            }else{
                $this->resetErrorBag('ActualizarimagenPersonajeDestacado');
            }

            $this->ActualizarImagenPersonajeDestacadoActual = null;

        }
    }
    public function placeholder(){
        return view('livewire.admin.cargando');
    }
}
