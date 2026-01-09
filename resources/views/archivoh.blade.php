@extends('layouts.app')

@section('title', 'Panel de Administración')

@section('content')
<div class="card shadow">
    <div class="card-body">
        <h2>Archivo Historico</h2>
        <p>Bienvenido, <strong>{{ auth()->user()->name }}</strong></p>

        <hr>
        

        
    </div>
</div>
@endsection
