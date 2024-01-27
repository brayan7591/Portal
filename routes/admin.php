<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
Route::get('/users', [HomeController::class, 'users'])->middleware('can:Users.mirar')->name('users');
Route::get('/roles', [HomeController::class, 'roles'])->name('roles');
