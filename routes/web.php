<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GuardiaController;
use App\Http\Controllers\ItemController;

// Esta es la ÚNICA línea que necesitas para todo el CRUD
Route::resource('guardias', GuardiaController::class);

// Ruta para agregar items a un guardia existente
Route::post('guardias/{guardia}/items', [GuardiaController::class, 'addItem'])->name('guardias.addItem');

// Ruta para eliminar items individuales
Route::delete('items/{id}', [ItemController::class, 'destroy'])->name('items.destroy');

// Si quieres que al entrar a la página principal se vea la lista
Route::get('/', [GuardiaController::class, 'create']);