<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use Illuminate\Http\Request;

class categoriasController extends Controller
{
    public function gestion($id){
       
        $cat = Categoria::findOrFail($id); // Busca la categoría o lanza error 404
    return view('categoria', compact('cat'));
    }
}
