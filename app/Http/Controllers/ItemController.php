<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Remove the specified item from guardia
     */
    public function destroy($id)
    {
        $item = \App\Models\Item::findOrFail($id);
        $guardia_id = $item->guardia_id;

        // Devolver cantidad al inventario
        if ($item->inventarioItem) {
            $item->inventarioItem->increment('cantidad');
        }

        // Eliminar la asignación
        $item->delete();

        return redirect()->route('guardias.show', $guardia_id)->with('success', 'Ítem removido correctamente. Cantidad devuelta al inventario.');
    }
}
