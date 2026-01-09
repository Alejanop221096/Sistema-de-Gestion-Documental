<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use Illuminate\Http\Request;

class AechivoHController extends Controller
{
    public function saveCategoria(Request $request)
    {
        // 1. Validar los datos de entrada
        $validated = $request->validate([
            'nombre' => 'required|max:255|unique:categorias',
            'ubicacion' => 'required|string',
        ]);

        // 2. Crear el registro en la base de datos
        $categoria = Categoria::create($validated);
        return redirect()->back()->with('success', '¡Categoria creada exitosamente!');
        
    }
}
