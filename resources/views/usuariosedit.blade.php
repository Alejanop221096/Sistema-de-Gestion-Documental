@extends('layouts.app')

@section('title', 'Panel de Administración')

@section('content')
<div class="card shadow">
    <div class="card-body">
        <h2>Editar Usuario</h2>
        <p>Bienvenido, <strong>{{ auth()->user()->name }}</strong></p>

        <hr>

        <form  class="editar" action="{{ route('user.update', $user->id) }}" method="POST">
    @csrf
    @method('PUT')

  <input type="text" name="name" value="{{ $user->name }}" class="form-control">
    <input type="email" name="email" value="{{ $user->email }}" class="form-control">
    
    <select name="role" class="form-control">
        <option value="1" {{ $user->role == 1 ? 'selected' : '' }}>Administrador</option>
        <option value="2" {{ $user->role == 2 ? 'selected' : '' }}>Usuario</option>
    </select>

     <input type="password" name="password" class="form-control" placeholder="Escribe nueva contraseña solo si quieres cambiarla">
    <button type="submit" class="btn btn-success">Actualizar Datos</button>
</form>

        
    </div>
</div>
@endsection
