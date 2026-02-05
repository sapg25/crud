<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GuardiaController;

// Esta es la ÚNICA línea que necesitas para todo el CRUD
Route::resource('guardias', GuardiaController::class);

// Si quieres que al entrar a la página principal se vea la lista
Route::get('/', [GuardiaController::class, 'index']);