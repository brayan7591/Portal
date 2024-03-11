<?php

namespace App\Http\Controllers;

use App\Models\programa;

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
}
