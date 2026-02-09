<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GuardiaController;
use App\Http\Controllers\ItemController;

// 1. RUTA DE REACTIVACIÓN (Debe ir ANTES del resource)
Route::patch('guardias/{id}/reactivar', [GuardiaController::class, 'reactivar'])->name('guardias.reactivar');

// 2. Rutas del CRUD estándar
Route::resource('guardias', GuardiaController::class);

// 3. Rutas adicionales de Items
Route::post('guardias/{guardia}/items', [GuardiaController::class, 'addItem'])->name('guardias.addItem');
Route::delete('items/{id}', [ItemController::class, 'destroy'])->name('items.destroy');

// Ruta principal
Route::get('/', [GuardiaController::class, 'create']);