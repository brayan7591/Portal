<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/users', [HomeController::class, 'users'])->name('Users');
