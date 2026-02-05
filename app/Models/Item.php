<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    // Esto permite guardar estos campos desde un formulario
    protected $fillable = ['tipo', 'modelo', 'serie', 'guardia_id'];

    // Relación inversa: Un ítem pertenece a un guardia
    public function guardia()
    {
        return $this->belongsTo(Guardia::class);
    }
}