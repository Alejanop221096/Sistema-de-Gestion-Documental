@extends('layouts.app')

@section('title', 'Panel de Administración')

@section('content')
<div class="card shadow">
    <div class="card-body">
        <h2>Archivo Historico</h2>
        <p>Bienvenido, <strong>{{ auth()->user()->name }}</strong></p>

        
         @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert" id="alert">
                    <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        <div class="accordion" id="accordionExample">
  <div class="accordion-item">
    <h2 class="accordion-header">
      <button class="accordion-button collapsed bg-light text-success fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
        + Agregar Categoria
      </button>
    </h2>
    <div id="collapseOne" class="accordion-collapse collapse hidden" data-bs-parent="#accordionExample">
      <div class="accordion-body">
             <form action="{{ route('archivoh.categoria') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label fw-bold">Categoria </label>
                                        <input type="text" name="nombre" class="form-control @error('name') is-invalid @enderror" 
                                               value="{{ old('name') }}" placeholder="Nombre de la seccion" required>
                                        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label class="form-label fw-bold">Ubicacion</label>
                                        <input type="text" name="ubicacion" class="form-control" 
                                               value="{{ old('lugar') }}" placeholder="ingresa el lugar donde de ubica en fisico la seccion" required>
                                        @error('email') 
                                            <div class="invalid-feedback">{{ $message }}</div> 
                                        @enderror
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

  <hr>
  
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