<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PersonaController;

Route::post('/personas', 'PersonaController@alta');
Route::delete('/personas/{id}', 'PersonaController@baja');
Route::put('/personas/{id}', 'PersonaController@modificar');
Route::get('/personas', 'PersonaController@listar');
Route::get('/personas/buscar', 'PersonaController@buscar');
Route::get('personas/probar-conexion', [PersonaController::class, 'probarConexion']);