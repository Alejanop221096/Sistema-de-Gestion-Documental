<?php

use App\Http\Controllers\AechivoHController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\categoriasController;
use App\Http\Controllers\PanelController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

Route::get('/', fn () => redirect()->route('login'));

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login']);




Route::middleware('auth')->group(function () {

    Route::get('/panel', [PanelController::class, 'inicio']);

    // Usuarios
        Route::get('/usuarios', [UserController::class, 'index'])->name('users.index');
 Route::post('/usuarios', [UserController::class, 'store'])->name('user.store');

    
    Route::delete('usuarios/{user}',[UserController::class, 'DeleteUser'])->name('user.delete');
    
    Route::get('/usuarios/{user}/editar', [UserController::class, 'edit'])->name('user.edit');
// También necesitarás la ruta para guardar los cambios (PUT)
Route::put('/usuarios/{user}/editar', [UserController::class, 'update'])->name('user.update');


    //historico
    Route::get('/archivo_historico', [AechivoHController::class, 'historico'])->name('categoria.store');
    Route::post('/archivo_historico',[AechivoHController::class,'saveCategoria'])->name('archivoh.categoria');

    //categorias
    Route::get('/categoria/gestionar/{cat}',[categoriasController::class, 'gestion'])
      ->name('categorias.gestionar');

    Route::get('/categoria/gestionar/delete/{cat}',[categoriasController::class, 'delete'])->name('delete.categoria');

    Route::post('/categoria/gestionar/{cat}',[categoriasController::class, 'storeCaja'])->name('store.caja');

//gestion de categoria
// Para guardar la caja (ya deberías tenerla o algo similar)
Route::post('/categoria/{cat}/caja', [categoriasController::class, 'storeCaja'])->name('store.caja');
//eliminar caja y expedientes 
Route::delete('/categoria/{cat}/caja/{id}',[categoriasController::class, 'deleteCaja'])->name('elimina.caja');


// Para guardar el legajo dentro de la caja
Route::post('/caja/{caja}/legajo', [categoriasController::class, 'legajo'])->name('store.legajo');

//documentos
Route::post('/legajo/{legajo}/documento', [categoriasController::class, 'storeDocumento'])->name('store.documento');



    Route::post('/logout', function (Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    })->name('logout');
});
