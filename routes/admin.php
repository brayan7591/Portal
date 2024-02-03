<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/Admin/dashboard', [HomeController::class, 'index'])->name('dashboard');
Route::get('/Admin/users', [HomeController::class, 'users'])->middleware('can:Users.mirar')->name('users');
Route::get('/Admin/roles', [HomeController::class, 'roles'])->name('roles');
Route::get('/Admin/settings', [HomeController::class, 'settings'])->name('settings');
Route::post('/Admin/settings', [HomeController::class, 'ActualizarUsuario'])->name('settings.update');
Route::get('/Admin/updatePassword', [HomeController::class, 'actualizarContra'])->name('CamContra');
Route::post('/Admin/updatePassword', [HomeController::class, 'updatepassword'])->name('password.update');