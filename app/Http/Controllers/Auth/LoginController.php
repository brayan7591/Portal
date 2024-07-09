<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected function authenticated(Request $request, $user){
        if ($user->can('Dashboard')) {
            return redirect()->route('dashboard'); 
        }

        if (Session::has('url.intended')) {
            return redirect()->intended(Session::get('url.intended'));
        }
    
        return redirect('/');
    }
    
    public function logout(Request $request){

        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
        
        if (
            url()->previous() == route('dashboard') || 
            url()->previous() == route('users') || 
            url()->previous() == route('roles') ||
            url()->previous() == route('settings') || 
            url()->previous() == route('CamContra') ||
            url()->previous() == route('admin.curriculum') ||
            url()->previous() == route('admin.eventos') ||
            url()->previous() == route('admin.proyectos') ||
            url()->previous() == route('admin.biblioteca') ||
            url()->previous() == route('admin.informativos') ||
            url()->previous() == route('admin.destacados')
        ) {
            return redirect('/');
        }else{
            return redirect()->back();
        }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
