@extends('layouts.app')

@section('title', 'Administración de Usuarios')

@section('content')
<div class="container-fluid">
    <div class="card shadow border-0">
        <div class="card-body">
            
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="fw-bold text-dark mb-0">Administración de Usuarios</h2>
                    <small class="text-muted">Gestiona los accesos y roles del sistema</small>
                </div>
                <span class="badge bg-light text-dark border p-2">
                    <i class="fas fa-user-circle"></i> {{ auth()->user()->name ?? 'Admin' }}
                </span>
            </div>

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert" id="alert">
                    <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert" id="alert">
                    <i class="fas fa-check-circle me-2"></i> {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="accordion mb-4" id="accordionUser">
                <div class="accordion-item border-success shadow-sm">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button {{ $errors->any() ? '' : 'collapsed' }} bg-light text-success fw-bold" 
                                type="button" data-bs-toggle="collapse" data-bs-target="#collapseForm">
                            <i class="fas fa-user-plus me-2"></i> + Agregar Nuevo Usuario
                        </button>
                    </h2>
                    <div id="collapseForm" class="accordion-collapse collapse {{ $errors->any() ? 'show' : '' }}" 
                         aria-labelledby="headingOne" data-bs-parent="#accordionUser">
                        <div class="accordion-body bg-white">
                            <form action="{{ route('user.store') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label fw-bold">Nombre Completo</label>
                                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" 
                                               value="{{ old('name') }}" placeholder="Ej. Juan Pérez" required>
                                        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label class="form-label fw-bold">Correo Electrónico</label>
                                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" 
                                               value="{{ old('email') }}" placeholder="correo@ejemplo.com" required>
                                        @error('email') 
                                            <div class="invalid-feedback">{{ $message }}</div> 
                                        @enderror
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label class="form-label fw-bold">Contraseña</label>
                                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required>
                                        @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label class="form-label fw-bold">Rol del Sistema</label>
                                        <select name="role" class="form-select">
                                            <option value="2" {{ old('role') == 'user' ? 'selected' : '' }}>Usuario</option>
                                            <option value="1" {{ old('role') == 'admin' ? 'selected' : '' }}>Administrador</option>
                                        </select>
                                    </div>

                                    <div class="col-md-12 text-end pt-2">
                                        <button type="submit" class="btn btn-success px-5 shadow-sm">
                                            <i class="fas fa-save me-1"></i> Guardar Usuario
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <hr class="my-4">

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Rol</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($usuarios as $u)
                        <tr>
                            <td class="fw-bold">{{ $u->name }}</td>
                            <td>{{ $u->email }}</td>
                            <td>
                                <span class="badge {{ $u->role == 'admin' ? 'bg-primary' : 'bg-secondary' }}">
                                    {{ ucfirst($u->role) }}
                                </span>
                            </td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <a href="{{ route('user.update', $u->id) }}" 
       class="btn btn-sm btn-outline-primary" 
       title="Editar">
        <i class="fas fa-edit"></i> Editar
    </a>
                                        <form action="{{ route('user.delete', $u->id) }}" method="POST" style="display: inline-block;">
            @csrf
            @method('DELETE')
            <button type="submit" 
                    class="btn btn-sm btn-outline-danger" 
                    title="Eliminar"
                    onclick="return confirm('¿Estás seguro de que deseas eliminar a {{ $u->name }}?')">
                <i class="fas fa-trash"></i> Eliminar
            </button>
        </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted py-4">No hay usuarios registrados.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script type="text/javascript">
// Esta es la forma recomendada en jQuery 3.x
$(function() {
    
    // Espera 3 segundos (3000ms)
    setTimeout(function() {
        // Selecciona el ID "alert" y lo elimina del DOM
        $("#alert").remove();
    }, 2000);

});
</script>