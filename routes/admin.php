<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/admin/dashboard', [HomeController::class, 'index'])->middleware('can:Dashboard')->name('dashboard');

Route::get('/admin/usuarios', [HomeController::class, 'users'])->middleware('can:Usuarios.mirar')->name('users');

Route::get('/admin/roles', [HomeController::class, 'roles'])->middleware('can:Roles.mirar')->name('roles');

Route::get('/admin/mensajes', [HomeController::class, 'formulario'])->middleware('can:Roles.mirar')->name('admin.mensajes');

Route::get('/admin/settings', [HomeController::class, 'settings'])->middleware('can:Dashboard')->name('settings');
Route::post('/admin/settings', [HomeController::class, 'ActualizarUsuario'])->middleware('can:Dashboard')->name('settings.update');

Route::get('/admin/updatePassword', [HomeController::class, 'actualizarContra'])->middleware('can:Dashboard')->name('CamContra');
Route::post('/admin/updatePassword', [HomeController::class, 'updatepassword'])->middleware('can:Dashboard')->name('password.update');

Route::get('/admin/curriculum', [HomeController::class, 'curriculum'])->middleware('can:Curriculum.mirar')->name('admin.curriculum');

Route::get('/admin/biblioteca', [HomeController::class, 'biblioteca'])->middleware('can:Biblioteca.mirar')->name('admin.biblioteca');

Route::get('/admin/eventos_y_galeria', [HomeController::class, 'eventos'])->middleware('can:Eventos.mirar')->name('admin.eventos');

Route::get('/admin/proyectos', [HomeController::class, 'proyectos'])->middleware('can:Proyectos.mirar')->name('admin.proyectos');

Route::get('/admin/voceros_e_instructores', [HomeController::class, 'personajes_informativos'])->middleware('can:Informativos.mirar')->name('admin.informativos');

Route::get('/admin/egresados_y_aprendices', [HomeController::class, 'personajes_destacados'])->middleware('can:Destacados.mirar')->name('admin.destacados');
