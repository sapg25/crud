<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InventarioItem extends Model
{
    protected $fillable = ['nombre', 'codigo_serie', 'cantidad'];

    // Un item de inventario puede estar asignado a múltiples guardias
    public function items()
    {
        return $this->hasMany(Item::class);
    }
}

