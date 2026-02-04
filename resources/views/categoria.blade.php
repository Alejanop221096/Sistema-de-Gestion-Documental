@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="card shadow-lg border-0">
        {{-- CABECERA CON OPCIÓN DE AÑADIR CAJA --}}
        <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">
                <i class="fas fa-sitemap text-info me-2"></i> 
                Estructura: {{ $cat->nombre }}
                <span class="badge bg-primary ms-2">{{ $cat->cajas->count() }} Cajas</span>
            </h5>
            <button class="btn btn-primary btn-sm shadow-sm" data-bs-toggle="modal" data-bs-target="#modalCaja">
                <i class="fas fa-box"></i> + Nueva Caja
            </button>
        </div>
        
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success border-0 shadow-sm"><i class="fas fa-check-circle me-2"></i>{{ session('success') }}</div>
            @endif

            <ul class="tree">
                @foreach($cat->cajas as $caja)
                    <li class="tree-branch">
                        {{-- NIVEL 1: CAJA --}}
                        <div class="tree-item d-flex align-items-center">
                            <i class="fas fa-chevron-right toggle-icon me-2 cursor-pointer toggle-trigger"></i>
                            <i class="fas fa-archive text-warning me-2"></i>
                            <span class="fw-bold cursor-pointer toggle-trigger">Caja #{{ $caja->numero }}</span>
                            
                            <button class="btn btn-link btn-sm text-success ms-auto p-0" data-bs-toggle="collapse" data-bs-target="#formLegajo{{ $caja->id }}">
                                <i class="fas fa-plus-circle"></i> Nuevo Legajo
                            </button>
                        </div>

                        <ul class="nested-tree collapse">
                            {{-- FORMULARIO PARA NUEVO LEGAJO --}}
                            <li class="mb-2 collapse" id="formLegajo{{ $caja->id }}">
                                <form action="{{ route('store.legajo', $caja->id) }}" method="POST" class="p-2 border rounded bg-light ms-3 shadow-sm">
                                    @csrf
                                    <div class="row g-2">
                                        <div class="col-md-5">
                                            <input type="text" name="nombre" class="form-control form-control-sm" placeholder="Nombre (Expediente)" required>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text" name="codigo" class="form-control form-control-sm" placeholder="Matrícula/Código">
                                        </div>
                                        <div class="col-md-2">
                                            <input type="text" name="tomo" class="form-control form-control-sm" placeholder="Legajo (Ej: 1 de 2)">
                                        </div>
                                        <div class="col-md-2">
                                            <button class="btn btn-success btn-sm w-100" type="submit">Guardar</button>
                                        </div>
                                    </div>
                                </form>
                            </li>

                            @foreach($caja->legajos as $legajo)
                                <li class="tree-branch">
                                    {{-- NIVEL 2: LEGAJO --}}
                                    <div class="tree-item d-flex align-items-center">
                                        <i class="fas fa-chevron-right toggle-icon me-2 cursor-pointer toggle-trigger"></i>
                                        <i class="fas fa-folder text-primary me-2"></i>
                                        <span class="cursor-pointer toggle-trigger"><strong>{{ $legajo->nombre }}</strong></span>
                                        
                                        @if($legajo->tomo)
                                            <span class="badge bg-info text-dark ms-2" style="font-size: 0.65rem;">L. {{ $legajo->tomo }}</span>
                                        @endif
                                        
                                        <button class="btn btn-link btn-sm text-info ms-auto p-0" data-bs-toggle="collapse" data-bs-target="#formDoc{{ $legajo->id }}">
                                            <i class="fas fa-file-medical"></i> Anexar Papel
                                        </button>
                                    </div>

                                    <ul class="nested-tree collapse">
                                        {{-- FORMULARIO ANEXAR PAPEL (DOCUMENTO) --}}
                                        <li class="mb-2 collapse" id="formDoc{{ $legajo->id }}">
                                            <form action="{{ route('store.documento', $legajo->id) }}" method="POST" class="input-group input-group-sm w-75 ms-3 shadow-sm border-info border-opacity-25">
                                                @csrf
                                                <input type="text" name="nombre_documento" class="form-control" placeholder="Nombre del documento" required>
                                                <input type="text" name="descripcion" class="form-control" placeholder="Nota (Ej: Original)">
                                                <button class="btn btn-info text-white" type="submit">Anexar</button>
                                            </form>
                                        </li>

                                        @foreach($legajo->documentos as $doc)
                                            <li>
                                                {{-- NIVEL 3: PAPEL --}}
                                                <div class="tree-item doc-item">
                                                    <i class="far fa-file-alt text-secondary me-2"></i>
                                                    {{ $doc->nombre_documento }}
                                                    <span class="text-muted small ms-2">[{{ $doc->descripcion }}]</span>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>

{{-- MODAL PARA AÑADIR CAJA --}}
<div class="modal fade" id="modalCaja" tabindex="-1">
    <div class="modal-dialog">
        <form action="{{ route('store.caja', $cat->id) }}" method="POST" class="modal-content">
            @csrf
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title"><i class="fas fa-box-open me-2"></i>Nueva Caja</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label fw-bold">Número de Caja</label>
                    <input type="text" name="numero" class="form-control" placeholder="Ej: 001" required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Descripción</label>
                    <input type="text" name="descripcion" class="form-control" placeholder="Opcional">
                </div>
            </div>
            <div class="modal-footer bg-light text-end">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary">Crear Caja</button>
            </div>
        </form>
    </div>
</div>

<style>
    /* Estructura del Árbol */
    .tree, .tree ul { margin:0; padding:0; list-style:none; }
    .tree ul { margin-left:1.5em; position:relative; }
    .tree ul:before { content:""; display:block; width:0; position:absolute; top:0; bottom:0; left:0; border-left:1px solid #dee2e6; }
    .tree li { margin:0; padding:0 1.2em; line-height:2.4em; position:relative; }
    .tree li:before { content:""; display:block; width:12px; height:0; border-top:1px solid #dee2e6; margin-top:-1px; position:absolute; top:1.2em; left:0; }
    .tree li:last-child:before { background:white; height:auto; top:1.2em; bottom:0; }
    
    .tree-item { padding: 2px 8px; border-radius: 4px; transition: 0.15s; }
    .tree-item:hover { background: #f8f9fa; }
    
    .cursor-pointer { cursor: pointer; }
    .toggle-icon { transition: transform 0.2s; font-size: 0.7rem; color: #adb5bd; }
    .tree-branch.open > .tree-item > .toggle-icon { transform: rotate(90deg); color: #212529; }
    
    /* Control de visibilidad */
    .nested-tree { display: none; }
    .nested-tree.open { display: block; }
    .doc-item { font-size: 0.9em; }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Escucha clics en los elementos marcados como "toggle-trigger"
    document.querySelectorAll('.toggle-trigger').forEach(element => {
        element.addEventListener('click', function() {
            const parentLi = this.closest('.tree-branch');
            const childUl = parentLi.querySelector('.nested-tree');
            if (childUl) {
                childUl.classList.toggle('open');
                parentLi.classList.toggle('open');
            }
        });
    });
});
</script>
@endsection