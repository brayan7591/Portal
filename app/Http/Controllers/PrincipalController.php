<?php

namespace App\Http\Controllers;

use App\Models\programa;
use Barryvdh\DomPDF\Facade\Pdf;

class PrincipalController extends Controller
{
    public function index(){
        $Programas = programa::all();
        return view('Page.index', compact('Programas'));
    }

    public function landingpage(programa $programa){
        return view('Page.LandingPage', compact('programa'));
    }

    public function biblioteca(programa $programa){
        return view('Page.biblioteca', compact('programa'));
    }

    public function instructores(programa $programa){
        return view('Page.instructores', compact('programa'));
    }

    public function curriculum(programa $programa, $nivel){
        $nivelaceptado = $programa->niveles->where('nivel', $nivel)->first();
        if ($nivelaceptado) {
            return view('Page.curriculum', compact('programa', 'nivelaceptado'));
        }else{
            return redirect()->route('landingPage', compact('programa'));
        }
    }

    public function pdf(programa $programa, $nivel){
        $curriculum =  $programa->niveles->where('nivel', $nivel)->first();
        return Pdf::loadview('Page.GeneradorPdf', compact('curriculum'))->download('curriculum.pdf');
    }
}
