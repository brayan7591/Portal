<?php

namespace App\Http\Controllers;

use App\Models\competencia;
use App\Models\evento;
use App\Models\formulario;
use App\Models\instructore;
use App\Models\personajes_destacado;
use App\Models\programa;
use App\Models\proyecto;
use App\Models\User;
use App\Models\vocero;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class HomeController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        $programas = programa::count();
        $usuarios = User::count();
        $competencias = competencia::count();
        $instructores = instructore::count();
        $egresados = personajes_destacado::where('rol', 'Egresado')->count();
        $voceros = personajes_destacado::where('rol', 'Aprendiz')->count();
        $Aprendices = vocero::count();
        $proyectos = proyecto::count();
        $eventos = evento::count();

        return view('Admin.Dashboard', compact('programas', 'usuarios', 'competencias', 'instructores', 'egresados', 'voceros', 'Aprendices', 'proyectos', 'eventos'));
    }

    public function users(){
        return view('Admin.Usuarios');
    }

    public function roles(){
        return view('Admin.Roles');
    }

    public function settings(){
        $user = Auth::user();
        return view('Admin.Settings', compact('user'));
    }

    public function curriculum(){
        return view('Admin.Curriculum');
    }

    public function eventos(){
        return view('Admin.Eventos');
    }

    public function proyectos(){
        return view('Admin.Proyectos');
    }

    public function biblioteca(){
        return view('Admin.Biblioteca');
    }
    
    public function personajes_informativos(){
        return view('Admin.PersonajesInformativos');
    }

    public function personajes_destacados(){
        return view('Admin.PersonajesDestacados');
    }

    public function formulario(){
        $formularios = formulario::all();
        return view('Admin.mensajes', compact('formularios'));
    }

    public function ActualizarUsuario(Request $request){
        $user = User::find(Auth::user()->id);
        $request->validate([
            'nombre' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'password' => ['required', 'current_password:web']
        ]);
        $user->name = $request->nombre;
        $user->email = $request->email;
        $user->save();

        return redirect()->route('dashboard')->with('success', 'Se actualizo su usuario');
    }

    public function actualizarContra(){
        return view('Admin.Password');
    }

    public function updatepassword(Request $request){
        $user = User::find(Auth::user()->id);
        $request->validate([
            'OldPassword' => ['required', 'current_password:web'],
            'NewPassword' => ['required'],
            'ConfirmPassword' => ['required', 'same:NewPassword']
        ]);
        $user->password = bcrypt($request->NewPassword);
        $user->save();

        return redirect()->route('dashboard')->with('success', 'Se actualizo su contraseña');
    }
    
}
