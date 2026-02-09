<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guardia extends Model
{
    public function items()
    {
        return $this->hasMany(Item::class);
    }
    protected $fillable = [
        'nombre',
        'apellido',
        'cedula',
        'tipo_documento',
        'turno',
        'codigo_unico',
        'activo', // <--- Importante que esté aquí
    ];
}
