<?php

namespace App\Livewire\Admin;

use App\Models\competencia;
use App\Models\detalleSabere;
use App\Models\nivele;
use App\Models\programa;
use App\Models\rap;
use App\Models\sabere;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class Curriculum extends Component{

    use WithPagination;

    public $model = 'programas';
    public $for = 'norma';
    public $registers = 5;
    public $search = '';
    public $CompetenciasPrograma = [];

    //Variables para guardar un programa
    public $nivelprogramabuscar, $programaAgregar, $nivelAgregar, $AgregarFechaInicio, $AgregarFechaFinal, $AgregarHoraLectiva, $AgregarHoraProductiva, $AgregarCompetencias = [], $mensajeExistente = false;
    
    //Variables para actualizar un programa
    public $actFechaInicio, $actFechaFinal, $actHoraLectiva, $actHoraProductiva, $actNivel, $nivelactualizar = ['programa_id' => null];
    
    //Variables para actualizar y agregar un Dato de una competencia(rap, saberes, conocimientos)
    public $actDato, $opciones, $identificador, $AgregarDato, $identificadorPadre;

    //Variables para guardar una competencia
    public $NuevaNorma, $NuevoCodigo, $NuevoNombre, $NuevaHora, $NuevosNiveles = [];

    //Variables para actualizar una competencia
    public $actCompetencia, $norma, $codigo, $nombre, $horas, $competenciasnivel = [];

    protected $listeners = ['delete', 'deleteNivel', 'deleteDatos', 'deleteTodosDatos'];
    protected $paginationTheme = "Bootstrap";

    public function updatingSearch(){
        $this->resetPage();
    }

    public function updatingModel(){
        $this->reset();
        $this->resetPage();
    }

    public function placeholder(){
        return view('livewire.admin.cargando');
    }
    
    public function render(){
        if ($this->model == 'programas') {
            if (nivele::where('SlugInterno', $this->nivelAgregar)->where('programa_id', $this->programaAgregar)->first() || (nivele::where('SlugInterno', strtolower($this->eliminar_acentos($this->actNivel)))->where('programa_id', $this->nivelactualizar['programa_id'])->first() && $this->nivelactualizar['SlugInterno'] != strtolower($this->eliminar_acentos($this->actNivel)))) {
                $this->mensajeExistente = true;
            }else{
                $this->mensajeExistente = false;
            }
            $competencias = competencia::all();
            $programas = programa::all();
            if ($this->search == '' || $this->search == null) {
                $niveles = nivele::orderby('programa_id')->paginate($this->registers);
            }else{
                $niveles = nivele::where('programa_id', $this->search)->where('SlugInterno', 'LIKE', '%'. $this->nivelprogramabuscar . '%')->orderby('programa_id')->paginate($this->registers);
            }
            $this->nivelprogramabuscar = '';
            return view('livewire.admin.curriculum', compact('niveles', 'programas', 'competencias'));
        }else{
            $niveles = nivele::all();
            $competencias = competencia::where($this->for, 'LIKE', '%'. $this->search . '%')->paginate($this->registers);
            return view('livewire.admin.curriculum', compact('competencias', 'niveles'));
        }
    }

    //Programas

    public function RedireccionarPrograma(){
        $this->search = programa::find($this->programaAgregar)->id;
        $this->nivelprogramabuscar = strtolower($this->eliminar_acentos($this->nivelAgregar));
    }
    
    public function GuardarPrograma(){
        $this->validate([
            'programaAgregar' => ['required', 'numeric', 'exists:programas,id'],
            'nivelAgregar' => ['required'],
            'AgregarFechaInicio' => ['required', 'date'],
            'AgregarFechaFinal' => ['date', 'nullable'],
            'AgregarHoraLectiva' => ['required', 'numeric'],
            'AgregarHoraProductiva' => ['required', 'numeric']
        ]);

        if ($this->AgregarFechaFinal == '') {
            $this->AgregarFechaFinal = null;
        }
        $nivelcreado = nivele::create([
            'Nivel' => $this->nivelAgregar,
            'SlugInterno' => strtolower($this->eliminar_acentos($this->nivelAgregar)),
            'FechaInicio' => $this->AgregarFechaInicio,
            'FechaFin' => $this->AgregarFechaFinal,
            'HorasEtapaLectiva' => $this->AgregarHoraLectiva,
            'HorasEtapaProductiva' => $this->AgregarHoraProductiva,
            'programa_id' => $this->programaAgregar
        ]);

        if ($this->AgregarCompetencias) {
            foreach ($this->AgregarCompetencias as $codigo) {
                $nivelcreado->competencias()->attach($codigo, ['SlugInterno' => $nivelcreado->SlugInterno, 'programa_id' => $nivelcreado->programa_id]);
            }
        }
        $this->reset(['programaAgregar', 'nivelAgregar', 'AgregarFechaInicio', 'AgregarFechaFinal', 'AgregarHoraLectiva', 'AgregarHoraProductiva', 'AgregarCompetencias']);

        $this->dispatch('ProgramaAgregado');
    }

    public function updatePrograma($nivel){
        $this->reset('programaAgregar');
        $this->CompetenciasPrograma = nivele::where('SlugInterno', $nivel['SlugInterno'])->where('programa_id', $nivel['programa_id'])->first()->competencias()->pluck('codigo');
        $this->nivelactualizar = $nivel;
        $this->actFechaInicio = $nivel['FechaInicio'];
        $this->actNivel = $nivel['Nivel'];
        $this->actFechaFinal = $nivel['FechaFin'];
        $this->actHoraLectiva = $nivel['HorasEtapaLectiva'];
        $this->actHoraProductiva = $nivel['HorasEtapaProductiva'];
    }

    public function ActualizarPrograma(){
        if (!$this->mensajeExistente) {
            if ($this->actFechaFinal == '') {
                $this->actFechaFinal = null;
            }
            $nivel = $this->nivelactualizar;
    
            $this->validate([
                'actNivel' => ['required'],
                'actFechaInicio' => ['required', 'date'],
                'actFechaFinal' => ['date', 'nullable'],
                'actHoraLectiva' => ['required', 'numeric'],
                'actHoraProductiva' => ['required', 'numeric'],
            ]);
    
            DB::table('nivel_competencia')->where('SlugInterno', $nivel['SlugInterno'])->where('programa_id', $nivel['programa_id'])->delete();
            $sluginterno = strtolower($this->eliminar_acentos($this->actNivel));
            DB::table('niveles')->where('SlugInterno', $nivel['SlugInterno'])->where('programa_id', $nivel['programa_id'])->update(['Nivel' => $this->actNivel, 'SlugInterno' => $sluginterno, 'FechaInicio' => $this->actFechaInicio, 'FechaFin' => $this->actFechaFinal, 'HorasEtapaLectiva' => $this->actHoraLectiva, 'HorasEtapaProductiva' => $this->actHoraProductiva]);
            
            foreach ($this->CompetenciasPrograma as $codigo) {
                nivele::where('SlugInterno', $sluginterno)->where('programa_id', $nivel['programa_id'])->first()->competencias()->attach($codigo, ['SlugInterno' => $sluginterno, 'programa_id' => $nivel['programa_id']]);
            }
    
            $this->reset(['actNivel', 'actFechaInicio', 'actFechaFinal', 'actHoraLectiva', 'actHoraProductiva', 'nivelactualizar']);
            $this->dispatch('ActualizadoPrograma');
        }
    }

    public function deleteNivel($nivel){
        DB::table('niveles')->where('SlugInterno', $nivel['SlugInterno'])->where('programa_id', $nivel['programa_id'])->delete();
    }

    //Datos de la competencias

    public function insertarDato(){
        $this->validate([
            'AgregarDato' => ['required']
        ]);

        if ($this->opciones == 'rap') {
            rap::create([
                'descripcion' => $this->AgregarDato,
                'codigo_competencia' => $this->identificadorPadre
            ]);
        }
        
        if ($this->opciones == 'concepto') {
            sabere::create([
                'descripcion' => $this->AgregarDato,
                'codigo_competencia' => $this->identificadorPadre,
                'saber' => 'conocimiento'
            ]);
        }

        if ($this->opciones == 'saber') {
            sabere::create([
                'descripcion' => $this->AgregarDato,
                'codigo_competencia' => $this->identificadorPadre,
                'saber' => 'proceso'
            ]);
        }

        if ($this->opciones == 'detalle') {
            detalleSabere::create([
                'descripcion' => $this->AgregarDato,
                'sabere_id' => $this->identificadorPadre,
            ]);
        }

        $this->reset('opciones', 'identificadorPadre', 'AgregarDato');
        $this->dispatch('NuevoDato');
    }

    public function AgregarDatoFuncion($opcion, $id){
        $this->identificadorPadre = $id;
        $this->opciones = $opcion;
    }

    public function UpdateDato(){
        $this->validate([
            'actDato' => ['required']
        ]);
        if ($this->opciones == 'rap') {
            rap::where('id', $this->identificador)->update(['descripcion' => $this->actDato]);
        }

        if ($this->opciones == 'saber') {
            sabere::where('id', $this->identificador)->update(['descripcion' => $this->actDato]);
        }

        if ($this->opciones == 'detalle') {
            detalleSabere::where('id', $this->identificador)->update(['descripcion' => $this->actDato]);
        }

        $this->reset('opciones', 'identificador', 'actDato');
        $this->dispatch('ActualizadoDato');
        
    }

    public function ActualizarDato($opcion, $id){
        $this->identificador = $id;
        $this->opciones = $opcion;

        if ($opcion == 'rap') {
            $this->actDato = rap::find($id)->descripcion;
        }

        if ($opcion == 'saber') {
            $this->actDato = sabere::find($id)->descripcion;
        }

        if ($opcion == 'detalle') {
            $this->actDato = detalleSabere::find($id)->descripcion;
        }
    }

    public function deleteTodosDatos($dato){
        if ($dato[1] == 'rap') {
            rap::where('codigo_competencia', $dato[0])->delete();
        }

        if ($dato[1] == 'concepto') {
            sabere::where('codigo_competencia', $dato[0])->where('saber', 'conocimiento')->delete();
        }

        if ($dato[1] == 'saber') {
            sabere::where('codigo_competencia', $dato[0])->where('saber', 'proceso')->delete();
        }

        if ($dato[1] == 'detalle') {
            detalleSabere::where('sabere_id', $dato[0])->delete();
        }
    }

    public function deleteDatos($dato){
        if ($dato[1] == 'rap') {
            rap::where('id', $dato[0])->delete();
        }
        if ($dato[1] == 'saber') {
            sabere::where('id', $dato[0])->delete();
        }
        if ($dato[1] == 'detalle') {
            detalleSabere::where('id', $dato[0])->delete();
        }
    }

    //Competencias

    public function guardarCompetencia(){
        $this->validate([
            'NuevaNorma' => ['required'],
            'NuevoCodigo' => ['required', 'unique:competencias,codigo'],
            'NuevoNombre' => ['required'],
            'NuevaHora' => ['required']
        ]);

        $competencia = new competencia();

        $competencia->norma = $this->NuevaNorma;
        $competencia->codigo = $this->NuevoCodigo;
        $competencia->nombre = $this->NuevoNombre;
        $competencia->duracion = $this->NuevaHora;
        $competencia->save();
        
        foreach ($this->NuevosNiveles as $niveles) {
            $datos = explode('_', $niveles);
            DB::insert("insert into nivel_competencia (SlugInterno, programa_id, codigo_competencia) values ('$datos[0]', '$datos[1]', '$this->NuevoCodigo')");
        }

        $this->reset(['NuevaNorma', 'NuevoCodigo', 'NuevoNombre', 'NuevaHora', 'NuevosNiveles']);
        $this->dispatch('CompetenciaAgregada');
    }

    public function updateCompetencia(){
        $competencia = $this->actCompetencia;
        $this->validate([
            'norma' => ['required'],
            'codigo' => ['required', Rule::unique('competencias')->ignore($competencia->codigo, 'codigo')],
            'nombre' => ['required'],
            'horas' => ['required']
        ]);

        $competencia->norma = $this->norma;
        $competencia->codigo = $this->codigo;
        $competencia->nombre = $this->nombre;
        $competencia->duracion = $this->horas;
        $competencia->save();

        DB::table('nivel_competencia')->where('codigo_competencia', $this->codigo)->delete();
        
        foreach ($this->competenciasnivel as $niveles) {
            $datos = explode('_', $niveles);
            DB::insert("insert into nivel_competencia (SlugInterno, programa_id, codigo_competencia) values ('$datos[0]', '$datos[1]', '$this->codigo')");
        }

        $this->reset(['norma', 'codigo', 'nombre', 'horas', 'actCompetencia', 'competenciasnivel']);
        $this->dispatch('CompetenciaActualizada');
    }

    public function ActualizarCompetencia(competencia $competencia){
        $this->competenciasnivel = [];
        $this->actCompetencia = $competencia;
        $this->norma = $competencia->norma;
        $this->codigo = $competencia->codigo;
        $this->nombre = $competencia->nombre;
        $this->horas = $competencia->duracion;
        foreach ($competencia->niveles as $nivel) {
            array_push($this->competenciasnivel, $nivel->SlugInterno . '_' . $nivel->programa_id);
        }
    }

    public function delete(competencia $competencia){
        $competencia->delete();
    }

    public function eliminar_acentos($cadena){
		
		//Reemplazamos la A y a
		$cadena = str_replace(
		array('Á', 'À', 'Â', 'Ä', 'á', 'à', 'ä', 'â', 'ª'),
		array('A', 'A', 'A', 'A', 'a', 'a', 'a', 'a', 'a'),
		$cadena
		);

		//Reemplazamos la E y e
		$cadena = str_replace(
		array('É', 'È', 'Ê', 'Ë', 'é', 'è', 'ë', 'ê'),
		array('E', 'E', 'E', 'E', 'e', 'e', 'e', 'e'),
		$cadena );

		//Reemplazamos la I y i
		$cadena = str_replace(
		array('Í', 'Ì', 'Ï', 'Î', 'í', 'ì', 'ï', 'î'),
		array('I', 'I', 'I', 'I', 'i', 'i', 'i', 'i'),
		$cadena );

		//Reemplazamos la O y o
		$cadena = str_replace(
		array('Ó', 'Ò', 'Ö', 'Ô', 'ó', 'ò', 'ö', 'ô'),
		array('O', 'O', 'O', 'O', 'o', 'o', 'o', 'o'),
		$cadena );

		//Reemplazamos la U y u
		$cadena = str_replace(
		array('Ú', 'Ù', 'Û', 'Ü', 'ú', 'ù', 'ü', 'û'),
		array('U', 'U', 'U', 'U', 'u', 'u', 'u', 'u'),
		$cadena );

		//Reemplazamos la N, n, C y c
		$cadena = str_replace(
		array('Ñ', 'ñ', 'Ç', 'ç'),
		array('N', 'n', 'C', 'c'),
		$cadena
		);
		
		return $cadena;
	}
}
