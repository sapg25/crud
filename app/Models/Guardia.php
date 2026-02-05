<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guardia extends Model
{
public function items() {
    return $this->hasMany(Item::class);    
}
protected $fillable = ['nombre', 'apellido', 'cedula', 'turno', 'tipo_documento', 'codigo_unico'];
}
