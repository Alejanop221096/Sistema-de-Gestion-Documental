<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Documento extends Model
{
    //

    protected $fillable = [
        'nombre_documento',
        'descripcion',
        'legajo_id', // <--- Agregamos esta línea
    ];

    public function legajo()
    {
        return $this->belongsTo(Legajo::class);
    }
}
