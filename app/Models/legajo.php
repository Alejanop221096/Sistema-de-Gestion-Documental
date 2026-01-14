<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class legajo extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'codigo', 'caja_id'];

    /**
     * Relación: Un legajo pertenece a una Caja
     */
    public function caja()
    {
        return $this->belongsTo(Caja::class);
    }
}
