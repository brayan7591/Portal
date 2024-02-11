<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class HomeController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        return view('Admin.Dashboard');
    }

    public function users(){
        return view('Admin.User');
    }

    public function roles(){
        return view('Admin.Roles');
    }

    public function settings(){
        $user = Auth::user();
        return view('Admin.Settings', compact('user'));
    }

    public function biblioteca(){
        return view('Admin.Biblioteca');
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
