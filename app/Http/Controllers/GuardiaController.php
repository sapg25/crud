<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exceptions\GuardiaYaExisteException;

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
        $inventarioItems = \App\Models\InventarioItem::where('cantidad', '>', 0)->get();
        return view('guardias.create', compact('inventarioItems'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $request->validate([
        'nombre' => 'required',
        'cedula' => 'required|alpha_num|max:10',
        'tipo_documento' => 'required',
        'items' => 'required|array|min:1'
    ]);

    // Verificar si el guardia ya existe por cédula
    $guardiaExistente = \App\Models\Guardia::where('cedula', $request->cedula)->first();
    if ($guardiaExistente) {
        throw new GuardiaYaExisteException($request->cedula);
    }

    // Generamos un código único
    $codigoGenerado = 'G-' . strtoupper(substr(uniqid(), -5));

    // Creamos el registro incluyendo el código
    $data = $request->all();
    $data['codigo_unico'] = $codigoGenerado;

    $guardia = \App\Models\Guardia::create($data);

    // Asignar items del inventario y restar cantidad
    if ($request->has('items')) {
        foreach ($request->items as $inventarioItemId) {
            if (!empty($inventarioItemId)) {
                $inventarioItem = \App\Models\InventarioItem::find($inventarioItemId);
                if ($inventarioItem && $inventarioItem->cantidad > 0) {
                    // Crear asignación
                    $guardia->items()->create([
                        'inventario_item_id' => $inventarioItemId,
                        'nombre_item' => $inventarioItem->nombre,
                        'codigo_serie' => $inventarioItem->codigo_serie
                    ]);
                    // Restar del inventario
                    $inventarioItem->decrement('cantidad');
                }
            }
        }
    }

    return redirect()->route('guardias.create')->with('success', '✅ ¡Guardia guardado con código: ' . $codigoGenerado);
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $guardia = \App\Models\Guardia::with('items')->findOrFail($id);
        return view('guardias.show', compact('guardia'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
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
    public function destroy($id)
    {
        $guardia = \App\Models\Guardia::find($id);

        // Devolver items al inventario
        foreach ($guardia->items as $item) {
            if ($item->inventarioItem) {
                $item->inventarioItem->increment('cantidad');
            }
        }

        // Eliminar el guardia (y sus items por cascada)
        $guardia->delete();

        return redirect()->route('guardias.index')->with('success', 'Guardia y su equipamiento eliminado correctamente');
    }

    /**
     * Add an item to an existing guardia
     */
    public function addItem(Request $request, $id)
    {
        $guardia = \App\Models\Guardia::findOrFail($id);
        $inventarioItemId = $request->input('inventario_item_id');

        // Validar que el item exista y tenga cantidad disponible
        $inventarioItem = \App\Models\InventarioItem::findOrFail($inventarioItemId);

        if ($inventarioItem->cantidad <= 0) {
            return response()->json(['error' => 'Item no disponible'], 400);
        }

        // Verificar que el guardia no tenga ya este item asignado
        $existingItem = $guardia->items()
            ->where('inventario_item_id', $inventarioItemId)
            ->exists();

        if ($existingItem) {
            return response()->json(['error' => 'Este item ya está asignado al guardia'], 400);
        }

        // Crear la asignación
        $guardia->items()->create([
            'inventario_item_id' => $inventarioItemId,
            'nombre_item' => $inventarioItem->nombre,
            'codigo_serie' => $inventarioItem->codigo_serie
        ]);

        // Restar del inventario
        $inventarioItem->decrement('cantidad');

        return response()->json([
            'success' => true,
            'message' => 'Item agregado correctamente'
        ]);
    }
}
