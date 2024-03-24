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
Auth::routes();
Route::get('/{programa}', [PrincipalController::class, 'landingpage'])->name('landingPage');
Route::get('/{programa}/biblioteca', [PrincipalController::class, 'biblioteca'])->name('biblioteca');
Route::get('/{programa}/instructores', [PrincipalController::class, 'instructores'])->name('instructores');