@extends('layouts.app')

@section('title', 'Lista de trazabilidad')

@section('contenido')
<div class="container mt-4">
   <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="text-2xl font-bold bg-gradient-to-r from-[#1B7D8F] via-[#2BA8A0] to-[#245360] text-transparent bg-clip-text drop-shadow-md flex items-center gap-2 px-2">
            Trazabilidad de Cajas Quirúrgicas
        </h1>
        
        <div class="d-flex align-items-center" style="gap: 15px;">
           <form action="{{ route('trazabilidad.index') }}" method="GET" class="d-inline-block mr-3">
    <div class="d-flex align-items-center" style="gap: 15px;">
        
        <div class="d-flex align-items-center">
            <label class="font-weight-bold mr-2 mb-0" style="color: #245360;">Tipo de Caja:</label>
            <select name="nombre_caja" onchange="this.form.submit()" class="form-select" style="border-radius: 5px; padding: 5px 30px 5px 10px; min-width: 180px;">
                <option value="Todas" {{ (isset($filtroNombre) && $filtroNombre == 'Todas') ? 'selected' : '' }}>Todos los tipos</option>
                
                @if(isset($nombresCajas))
                    @foreach($nombresCajas as $nombre)
                        <option value="{{ $nombre }}" {{ (isset($filtroNombre) && $filtroNombre == $nombre) ? 'selected' : '' }}>
                            {{ $nombre }}
                        </option>
                    @endforeach
                @endif
            </select>
        </div>

        <div class="d-flex align-items-center">
            <label class="font-weight-bold mr-2 mb-0" style="color: #245360;">Estado:</label>
            <select name="estado" onchange="this.form.submit()" class="form-select" style="border-radius: 5px; padding: 5px 30px 5px 10px; min-width: 150px;">
                <option value="Todas" {{ (isset($filtroEstado) && $filtroEstado == 'Todas') ? 'selected' : '' }}>Todos los estados</option>
                <option value="Lavado" {{ (isset($filtroEstado) && $filtroEstado == 'Lavado') ? 'selected' : '' }}>Lavado</option>
                <option value="Esterilizada" {{ (isset($filtroEstado) && $filtroEstado == 'Esterilizada') ? 'selected' : '' }}>Esterilizada</option>
                <option value="Almacenada" {{ (isset($filtroEstado) && $filtroEstado == 'Almacenada') ? 'selected' : '' }}>Almacenada</option>
                <option value="En Uso" {{ (isset($filtroEstado) && $filtroEstado == 'En Uso') ? 'selected' : '' }}>En Uso</option>
                <option value="En Desuso" {{ (isset($filtroEstado) && $filtroEstado == 'En Desuso') ? 'selected' : '' }}>En Desuso</option>
            </select>
        </div>

    </div>
</form>

            @if(auth()->check() && auth()->user()->role == 1)
                <a href="{{ route('trazabilidad.create') }}"
                    class="inline-block bg-neutral-700 hover:bg-neutral-800 text-white font-medium py-2 px-6 rounded-full shadow-md cursor-pointer transition duration-300 text-nowrap"
                    style="text-decoration: none;">
                    Añadir Nueva Caja
                </a>
            @endif
        </div>
    </div>

    
    <div class="table-responsive bg-white rounded shadow-sm p-3">
        <table id="tablaCajas" class="table table-hover table-bordered shadow-sm text-center rounded">
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Caja Quirúrgica</th>
                    <th>Estado Actual</th>
                    <th>Última Actualización</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cajas as $caja)
    <tr>
        <td class="align-middle font-weight-bold">
            {{ $caja->codigo }}
        </td>

        <td class="align-middle">
            {{ $caja->nombre }}
        </td>

        <td class="align-middle">
            @if($caja->trashed())
                <span class="badge bg-secondary text-white p-2">En Desuso</span>
            @else
                @php
                    $colorBadge = 'bg-secondary';
                    if($caja->estado_actual == 'Esterilizada') $colorBadge = 'bg-success';
                    if($caja->estado_actual == 'En Uso') $colorBadge = 'bg-danger';
                    if($caja->estado_actual == 'Lavado') $colorBadge = 'bg-primary';
                @endphp
                <span class="badge {{ $colorBadge }} text-white p-2">
                    {{ $caja->estado_actual }}
                </span>
            @endif
        </td>

        <td class="align-middle">
            {{ $caja->updated_at ? $caja->updated_at->format('d/m/Y H:i') : 'Sin datos' }}
        </td>

       <td class="align-middle">
            @if(!$caja->trashed())
                <div class="d-flex align-items-center" style="gap: 8px;">
                    
                    <button type="button" class="btn btn-sm text-white d-flex align-items-center justify-content-center" style="background-color: #6c757d; border-color: #6c757d; height: 31px; padding: 0 10px;" data-toggle="modal" data-target="#modalContenido{{ $caja->id }}" title="Ver contenido">
                        <i data-lucide="package" style="width: 16px; height: 16px; margin-right: 5px;"></i> Contenido
                    </button>

                    <a href="{{ route('trazabilidad.show', $caja->id) }}" class="btn btn-sm text-white d-flex align-items-center" style="background-color: #17a2b8; border-color: #17a2b8; height: 31px;">
                        Ver Línea de Tiempo
                    </a>

                    @if(auth()->check() && auth()->user()->role == 1)
                        <form action="{{ route('trazabilidad.destroy', $caja->id) }}" method="POST" class="m-0" onsubmit="return confirm('⚠️ ¿Estás seguro de enviar la caja a desuso?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger d-flex align-items-center justify-content-center" title="Enviar a Desuso" style="height: 31px; width: 32px; padding: 0;">
                                <i data-lucide="trash-2" style="width: 16px; height: 16px;"></i>
                            </button>
                        </form>
                    @endif
                </div>
            @else
                <span class="text-muted font-weight-bold" style="font-size: 0.85rem;">
                    <i data-lucide="lock" class="d-inline-block mr-1" style="width: 14px; height: 14px; margin-top: -2px;"></i> Archivada
                </span>
            @endif
        </td>
    </tr>
@endforeach
            </tbody>
        </table>
       </tbody>
        </table>
    </div> </div> @foreach($cajas as $caja)
    <div class="modal fade" id="modalContenido{{ $caja->id }}" tabindex="-1" role="dialog" aria-labelledby="modalLabel{{ $caja->id }}" aria-hidden="true" style="z-index: 1060;"> 
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content" style="box-shadow: 0 5px 15px rgba(0,0,0,.5);">
                <div class="modal-header" style="background-color: #f8f9fa;">
                    <h5 class="modal-title text-dark" id="modalLabel{{ $caja->id }}">                        
                        <strong>{{ $caja->codigo }}</strong> - {{ $caja->nombre }}
                    </h5>
                    <button type="button" class="close btn-close" data-dismiss="modal" data-bs-dismiss="modal" aria-label="Cerrar" style="font-size: 1.5rem; border: none; background: transparent; cursor: pointer;">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-start" style="white-space: pre-wrap; color: #495057; background-color: #ffffff; padding: 20px;">
                    {{ $caja->descripcion ? $caja->descripcion : 'No hay descripción cargada para esta caja.' }}
                </div>
                <div class="modal-footer" style="background-color: #ffffff;">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>       
        </div>
    </div>      
@endforeach


<script>     
    document.addEventListener("DOMContentLoaded", function() {                  
        $.fn.dataTable.ext.errMode = 'none';          
        $('#tablaCajas').DataTable({             
            "stateSave": true,             
            "language": {               
                "lengthMenu": "Mostrar _MENU_ cajas por página",                 
                "zeroRecords": "No se encontraron cajas con ese criterio.",                 
                "info": "Mostrando página _PAGE_ de _PAGES_",                 
                "infoEmpty": "No hay cajas disponibles",                 
                "infoFiltered": "(filtrado de _MAX_ cajas totales)",  
                "search": "Buscar caja:",                 
                "paginate": {                     
                    "first": "Primero", "last": "Último", "next": "Siguiente", "previous": "Anterior"                 
                }             
            },      
            "order": [[ 0, "asc" ]]         
        });
        
        if(typeof lucide !== 'undefined') {             
            lucide.createIcons();
        }     
    $('.modal').appendTo('body');
    });     

  
    $(document).on('click', '[data-dismiss="modal"], [data-bs-dismiss="modal"], .btn-close, .close', function() {         
        $('.modal').modal('hide');         
        $('.modal-backdrop').remove();         
        $('body').removeClass('modal-open').css('overflow', 'auto');     
    });
</script> 
@endsection