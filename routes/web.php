<?php

use App\Http\Controllers\ProyectoController;
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

Route::get('/', function () {
    return view('bienvenida');
});

Route::resource('proyectos', \App\Http\Controllers\ProyectoController::class);
Route::resource('tareas', \App\Http\Controllers\TareaController::class)
    ->except(['create', 'index']);
Route::get('/tareas/create/{id}', [App\Http\Controllers\TareaController::class, 'create'])
    ->name('tareas.create');
Route::get('/index/{clave?}/{orden?}', [\App\Http\Controllers\TareaController::class, 'index'])
    ->name('tareas.index');
Route::get('/estadisticas', App\Http\Controllers\EstadisticasController::class)
    ->name('estadisticas');