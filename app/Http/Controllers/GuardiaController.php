<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exceptions\GuardiaYaExisteException;
use App\Models\Guardia;

class GuardiaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Cambiamos all() por un filtro where
        $guardias = \App\Models\Guardia::where('activo', true)->get();

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
        $rules = [
            'nombre' => 'required|string',
            'apellido' => 'required|string',
            'tipo_documento' => 'required|string',
            'turno' => 'required|string',
            'items' => 'required|array|min:1'
        ];

        if ($request->tipo_documento === 'cedula') {
            $rules['cedula'] = 'required|numeric|max_digits:10|min_digits:8';
        } else {
            $rules['cedula'] = 'required|alpha_num|max:30';
        }

        $request->validate($rules);

        // BUSCAR SI EXISTE (ACTIVO O INACTIVO)
        $guardiaExistente = \App\Models\Guardia::where('cedula', $request->cedula)->first();

        if ($guardiaExistente) {
            if ($guardiaExistente->activo) {
                // Si está activo, lanzas tu excepción normal
                throw new \App\Exceptions\GuardiaYaExisteException($request->cedula);
            } else {
                // Si está inactivo, regresas con el mensaje de reactivación
                return redirect()->back()
                    ->withInput()
                    ->with('reactivar_id', $guardiaExistente->id)
                    ->with('warning', 'El guardia con cédula ' . $request->cedula . ' está INACTIVO. ¿Deseas reactivarlo?');
            }
        }

        // SI NO EXISTE, CONTINÚA TU LÓGICA NORMAL
        $codigoGenerado = 'G-' . strtoupper(substr(uniqid(), -5));

        $guardia = \App\Models\Guardia::create([
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'cedula' => $request->cedula,
            'tipo_documento' => $request->tipo_documento,
            'turno' => $request->turno,
            'codigo_unico' => $codigoGenerado,
            'activo' => true // Aseguramos que inicie activo
        ]);

        if ($request->has('items')) {
            foreach ($request->items as $inventarioItemId) {
                if (!empty($inventarioItemId)) {
                    $inventarioItem = \App\Models\InventarioItem::find($inventarioItemId);
                    if ($inventarioItem && $inventarioItem->cantidad > 0) {
                        $guardia->items()->create([
                            'inventario_item_id' => $inventarioItemId,
                            'nombre_item' => $inventarioItem->nombre,
                            'codigo_serie' => $inventarioItem->codigo_serie
                        ]);
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
        $guardia = Guardia::findOrFail($id);

        // Cambiar estado a inactivo
        $guardia->activo = false;
        $guardia->save();

        // Opcional: Devolver items al inventario al desactivarlo
        foreach ($guardia->items as $item) {
            if ($item->inventarioItem) {
                $item->inventarioItem->increment('cantidad');
            }
            // Borramos la relación de items porque ya no los tiene al estar inactivo
            $item->delete();
        }

        return redirect()->route('guardias.index')->with('success', 'Guardia marcado como INACTIVO y equipo devuelto.');
    }

    /**
     * Add an item to an existing guardia
     */
    public function addItem(Request $request, $id)
    {
        $guardia = Guardia::findOrFail($id);
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
    /**
     * Reactiva un guardia que estaba inactivo.
     */
    public function reactivar(Request $request, $id)
{
    $guardia = Guardia::findOrFail($id);
    $guardia->activo = true;
    $guardia->save();

    // Cambiamos el redireccionamiento para que se quede en el formulario
    return redirect()->route('guardias.create')
        ->with('success', '✅ El guardia ' . $guardia->nombre . ' ' . $guardia->apellido . ' ha sido reactivado exitosamente.');
}
}
