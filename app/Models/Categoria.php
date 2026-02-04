<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
class Categoria extends Model
{
   use HasFactory;
    protected $table='categorias';
    protected $primaryKey = 'id';
    protected $fillable = ['nombre', 'ubicacion'];

    public function cajas()
    {
        return $this->hasMany(Caja::class, 'categoria_id');
    }

 
}
