<?php

use App\Http\Controllers\PrincipalController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [PrincipalController::class, 'index'])->name('principal');
Route::post('/actualizar-menu', [PrincipalController::class, 'menu'])->name('actualizar-menu');

Auth::routes();

Route::get('/Iniciojuego', [PrincipalController::class, 'Iniciojuego'])->name('Iniciojuego');

Route::get('/{programa}', [PrincipalController::class, 'landingpage'])->name('landingPage');
Route::get('/{programa}/curriculum/{nivel}', [PrincipalController::class, 'curriculum'])->name('curriculum');
Route::post('/{programa}/curriculum/{nivel}', [PrincipalController::class, 'pdf'])->name('generar.pdf');
Route::get('/{programa}/eventos', [PrincipalController::class, 'eventos'])->name('eventos');
Route::get('/{programa}/proyectos', [PrincipalController::class, 'proyectos'])->name('proyectos');
Route::get('/{programa}/biblioteca', [PrincipalController::class, 'biblioteca'])->name('biblioteca');
Route::get('/{programa}/instructores', [PrincipalController::class, 'instructores'])->name('instructores');
Route::get('/{programa}/egresados', [PrincipalController::class, 'egresados'])->name('egresados');
Route::get('/{programa}/aprendices', [PrincipalController::class, 'aprendices'])->name('aprendices');
Route::get('/{programa}/voceros', [PrincipalController::class, 'voceros'])->name('voceros');
