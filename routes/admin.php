<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/Admin/dashboard', [HomeController::class, 'index'])->middleware('can:Dashboard')->name('dashboard');

Route::get('/Admin/usuarios', [HomeController::class, 'users'])->middleware('can:Usuarios.mirar')->name('users');

Route::get('/Admin/roles', [HomeController::class, 'roles'])->middleware('can:Roles.mirar')->name('roles');

Route::get('/Admin/settings', [HomeController::class, 'settings'])->middleware('can:Dashboard')->name('settings');
Route::post('/Admin/settings', [HomeController::class, 'ActualizarUsuario'])->middleware('can:Dashboard')->name('settings.update');

Route::get('/Admin/updatePassword', [HomeController::class, 'actualizarContra'])->middleware('can:Dashboard')->name('CamContra');
Route::post('/Admin/updatePassword', [HomeController::class, 'updatepassword'])->middleware('can:Dashboard')->name('password.update');

Route::get('/Admin/curriculum', [HomeController::class, 'curriculum'])->middleware('can:Curriculum.mirar')->name('admin.curriculum');

Route::get('/Admin/eventos', [HomeController::class, 'eventos'])->middleware('can:Eventos.mirar')->name('admin.eventos');

Route::get('/Admin/proyectos', [HomeController::class, 'proyectos'])->middleware('can:Proyectos.mirar')->name('admin.proyectos');

Route::get('/Admin/biblioteca', [HomeController::class, 'biblioteca'])->middleware('can:Biblioteca.mirar')->name('admin.biblioteca');

Route::get('/Admin/voceros_e_instructores', [HomeController::class, 'personajes_informativos'])->middleware('can:Informativos.mirar')->name('admin.informativos');

Route::get('/Admin/egresados_y_aprendices', [HomeController::class, 'personajes_destacados'])->middleware('can:Destacados.mirar')->name('admin.destacados');
