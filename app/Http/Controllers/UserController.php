<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        // Traemos todos los usuarios
        $usuarios = User::all();
        return view('usuarios', compact('usuarios'));
    }

    public function store(Request $request)
    {
        // 1. Validación: Si falla, Laravel automáticamente nos regresa
        // a la vista con los errores y el mensaje "The email has already been taken".
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'role'     => 'required' // Agregado ya que lo tienes en tu formulario
        ]);

        // 2. Crear usuario
        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => $request->role,
        ]);

        // 3. Redireccionar: En lugar de JSON, volvemos atrás con un mensaje de éxito
        return redirect()->back()->with('success', '¡Usuario creado exitosamente!');
    }

    public function DeleteUser(User $user){
        

        if(auth()->user()->role !=1){
            return redirect()->route('users.index')->with('success', 'No tienes permisos para borrar.');
        }
        
        if(auth()->user()->id ==$user->id){
            return redirect()->route('users.index')->with('error', 'No puedes eliminarte a ti mismo.');
        }

  
        $user->delete();

        

        return redirect()->route('users.index')->with('error', 'Usuario eliminado correctamente.');
     
    }

    public function edit(User $user)
{
    // Retornamos la vista pasándole el usuario a editar
    return view('usuariosedit', compact('user'));
}

public function update(Request $request, User $user)
{
    // 1. Validar que los campos no lleguen vacíos
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $user->id,
        'role' => 'required'
    ]);

    // 2. Asignar valores
    $user->name = $request->name;
    $user->email = $request->email;
    $user->role = $request->role;

    // 3. Password opcional
    if ($request->filled('password')) {
        $user->password = bcrypt($request->password);
    }

    if(auth()->user()->rol !=1){
        return redirect('/usuarios')->with('success', 'No tienes permiso para actualizar datos');
    }

    $user->save();

    return redirect('/usuarios')->with('success', 'Usuario actualizado');
}
}