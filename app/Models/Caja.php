<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Caja extends Model
{
    use HasFactory;

    // Campos que se pueden llenar automáticamente
    protected $fillable = ['numero', 'descripcion', 'categoria_id'];

    /**
     * Relación: Una caja pertenece a una Categoría
     */
    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    /**
     * Relación: Una caja tiene muchos Legajos
     */
    public function legajos()
    {
        return $this->hasMany(Legajo::class);
    }
}
