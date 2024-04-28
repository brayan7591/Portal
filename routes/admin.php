<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/Admin/dashboard', [HomeController::class, 'index'])->name('dashboard');

Route::get('/Admin/usuarios', [HomeController::class, 'users'])->middleware('can:Users.mirar')->name('users');

Route::get('/Admin/roles', [HomeController::class, 'roles'])->name('roles');

Route::get('/Admin/settings', [HomeController::class, 'settings'])->name('settings');
Route::post('/Admin/settings', [HomeController::class, 'ActualizarUsuario'])->name('settings.update');

Route::get('/Admin/updatePassword', [HomeController::class, 'actualizarContra'])->name('CamContra');
Route::post('/Admin/updatePassword', [HomeController::class, 'updatepassword'])->name('password.update');

Route::get('/Admin/biblioteca', [HomeController::class, 'biblioteca'])->name('admin.biblioteca');

Route::get('/Admin/aprendices', [HomeController::class, 'aprendices'])->name('admin.aprendices');

Route::get('/Admin/egresados', [HomeController::class, 'egresados'])->name('admin.egresados');

Route::get('/Admin/instructores', [HomeController::class, 'instructores'])->name('admin.instructores');

Route::get('/Admin/voceros', [HomeController::class, 'voceros'])->name('admin.voceros');

Route::get('/Admin/curriculum', [HomeController::class, 'curriculum'])->name('admin.curriculum');