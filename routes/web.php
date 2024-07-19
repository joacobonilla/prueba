<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PersonaController;

Route::resource('personas', PersonaController::class);