<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function index(){
        return view('login');
    }

    public function login(Request $request)
    {
        // 1️⃣ Validar
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // 2️⃣ Buscar usuario
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors([
                'email' => 'Este correo no está registrado.',
            ])->onlyInput('email');
        }

        // 3️⃣ Validar contraseña
        if (!Hash::check($request->password, $user->password)) {
            return back()->withErrors([
                'password' => 'Contraseña incorrecta.',
            ]);
        }

        // 4️⃣ Iniciar sesión con Auth
        Auth::login($user);

        // 5️⃣ Regenerar sesión
        $request->session()->regenerate();

        return redirect('/panel');
    }
   
}
