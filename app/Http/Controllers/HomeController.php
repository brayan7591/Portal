<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(){
        return view('Admin.Dashboard');
    }

    public function users(){
        return view('Admin.User');
    }

    public function roles(){
        return view('Admin.Roles');
    }

    public function guardarRol(Request $request){
        return $request->all();
    }
}
