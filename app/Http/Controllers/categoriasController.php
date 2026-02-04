<?php

namespace App\Http\Controllers;
use App\Models\Legajo;

use App\Http\Controllers\Controller;
use App\Models\Caja;
use App\Models\Categoria;
use Illuminate\Http\Request;

class categoriasController extends Controller
{
    public function gestion($id) {
    // IMPORTANTE: Usa 'with' para que 'cajas' deje de ser null
    $cat = Categoria::with('cajas.legajos')->findOrFail($id); 
    
    return view('categoria', compact('cat'));
    }

    public function storeCaja(Request $request, Categoria $cat) {
    // Genera un número basado en la fecha y hora actual + un random para que sea único
    $codigoUnico = $request->numero; 

    $cat->cajas()->create([
        'numero' => $codigoUnico,
        'descripcion' => $request->descripcion
    ]);

    return back();
}





//eliminar caja//
    public function deleteCaja($cat,$id){
        
        
        $caja = Caja::findOrFail($id);
    
        $caja->delete();   
       return redirect()->route('categorias.gestionar', $cat)
                     ->with('success', 'La caja ha sido eliminada correctamente.');
                  
        
    }

    //para las cajas

     public function delete($id){
        
        
        $caja = Categoria::findOrFail($id);
    
        $caja->delete();   
      return back()->with('success', '¡la categoria ha sido eliminada completamente!');
                  
        
    }



    //delete(categorias)




    public function legajo(Request $request, $caja_id)
{
    $request->validate([
        'nombre' => 'required',
    ]);

    Legajo::create([
        'nombre' => $request->nombre,
        'codigo' => $request->codigo,
        'caja_id' => $caja_id // Viene del ID en la URL
    ]);

    return back()->with('success', '¡Legajo añadido a la caja!');
}


//documento
public function storeDocumento(Request $request, $legajoId)
{
    $request->validate(['nombre_documento' => 'required|string|max:255']);

    \App\Models\Documento::create([
        'legajo_id' => $legajoId,
        'nombre_documento' => $request->nombre_documento,
        'descripcion' => $request->descripcion,
    ]);

    return back()->with('success', 'Documento anexado al folder.');
}
    
}
