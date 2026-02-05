<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GuardiaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $guardias = \App\Models\Guardia::all(); // Trae todos los guardias de la base_sapo
    return view('guardias.index', compact('guardias'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
{
    return view('guardias.create'); // Esto busca el archivo en resources/views/guardias/create.blade.php
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    // 1. Guarda el registro en la base de datos MySQL
    \App\Models\Guardia::create($request->all());

    // 2. Te mantiene en el mismo formulario para agregar otro
    return redirect()->back()->with('success', '¡Guardia guardado! Puedes agregar otro.');
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id) {
    $guardia = \App\Models\Guardia::find($id); // Busca al guardia por su ID
    return view('guardias.edit', compact('guardia'));
}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    // 1. Buscar al guardia en la base_sapo usando su ID
    $guardia = \App\Models\Guardia::find($id);

    // 2. Actualizar los datos con lo que enviaste desde el formulario
    $guardia->update($request->all());

    // 3. Redirigir a la lista con un mensaje de éxito
    return redirect()->route('guardias.index')->with('success', '¡Datos actualizados con éxito!');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {
    \App\Models\Guardia::destroy($id); // Borra el registro de la base_sapo
    return redirect()->route('guardias.index');
}
}
