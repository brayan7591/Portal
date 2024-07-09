<?php

namespace App\Http\Controllers;

use App\Models\programa;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PrincipalController extends Controller
{

    public function index(){
        $Programas = programa::all();
        return view('Page.index', compact('Programas'));
    }

    public function Iniciojuego(){
        return view('Page.Iniciojuego');
    }
    
    public function menu(Request $request){
        $nuevoValor = $request->input('nuevoValor');
        
        Session::put('menuAbierto', $nuevoValor);
        
        return response()->json();
    }

    public function landingpage(programa $programa){
        $menuAbierto = Session::get("menuAbierto", false);
        return view('Page.LandingPage', compact('programa', 'menuAbierto'));
    }

    public function curriculum(programa $programa, $nivel){
        $menuAbierto = Session::get("menuAbierto", false);
        $nivelaceptado = $programa->niveles->where('SlugInterno', $nivel)->first();
        if ($nivelaceptado) {
            return view('Page.curriculum', compact('programa', 'nivelaceptado', 'menuAbierto'));
        }else{
            return redirect()->route('landingPage', compact('programa'));
        }
    }

    public function pdf(programa $programa, $nivel){
        $curriculum =  $programa->niveles->where('SlugInterno', $nivel)->first();
        return Pdf::loadview('Page.GeneradorPdf', compact('curriculum'))->download('curriculum.pdf');
    }

    public function eventos(programa $programa){
        $menuAbierto = Session::get("menuAbierto", false);
        return view('Page.eventos', compact('programa', 'menuAbierto'));
    }

    public function proyectos(programa $programa){
        $menuAbierto = Session::get("menuAbierto", false);
        return view('Page.proyectos', compact('programa', 'menuAbierto'));
    }

    public function egresados(programa $programa){
        $menuAbierto = Session::get("menuAbierto", false);
        return view('Page.egresados', compact('programa', 'menuAbierto'));
    }

    public function aprendices(programa $programa){
        $menuAbierto = Session::get("menuAbierto", false);
        return view('Page.aprendices', compact('programa', 'menuAbierto'));
    }

    public function voceros(programa $programa){
        $menuAbierto = Session::get("menuAbierto", false);
        return view('Page.voceros', compact('programa', 'menuAbierto'));
    }

    public function biblioteca(programa $programa){
        $menuAbierto = Session::get("menuAbierto", false);
        return view('Page.biblioteca', compact('programa', 'menuAbierto'));
    }

    public function instructores(programa $programa){
        $menuAbierto = Session::get("menuAbierto", false);
        return view('Page.instructores', compact('programa', 'menuAbierto'));
    }

    
}
