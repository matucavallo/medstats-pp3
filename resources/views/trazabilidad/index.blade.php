@extends('layouts.app')

@section('title', 'Lista de trazabilidad')


@section('contenido')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
         <h1
                class="text-2xl font-bold bg-gradient-to-r from-[#1B7D8F] via-[#2BA8A0] to-[#245360] text-transparent  bg-clip-text drop-shadow-md  flex items-center gap-2 px-2">
                Trazabilidad de Cajas Quirurjicas </h1>
        
        @if(auth()->check() && auth()->user()->role == 1)
         <a href="{{ route('trazabilidad.create') }}"
                class="inline-block bg-neutral-700 hover:bg-neutral-800 text-white font-medium py-2 px-6 rounded-full shadow-md cursor-pointer transition duration-300"
                style="text-decoration: none;">
                Añadir Nueva Caja
            </a>
        @endif
    </div>

    
    <div class="table-responsive bg-white rounded shadow-sm p-3">
        <table class="table table-striped table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>Código</th>
                    <th>Caja Quirúrgica</th>
                    <th>Estado Actual</th>
                    <th>Última Actualización</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($cajas as $caja)
                <tr>
                    <td class="font-weight-bold">{{ $caja->codigo }}</td>
                    <td>{{ $caja->nombre }}</td>
                    <td>
                        @php
                            $colorBadge = 'bg-secondary';
                            if($caja->estado_actual == 'Esterilizada') $colorBadge = 'bg-success';
                            if($caja->estado_actual == 'En Uso') $colorBadge = 'bg-danger';
                            if($caja->estado_actual == 'Lavado') $colorBadge = 'bg-primary';
                        @endphp
                        <span class="badge {{ $colorBadge }} text-white p-2">
                            {{ $caja->estado_actual }}
                        </span>
                    </td>
                    <td>{{ $caja->updated_at->format('d/m/Y H:i') }}</td>
                    <td class="align-middle">
    <div class="d-flex align-items-center" style="gap: 8px;">
        
        <a href="{{ route('trazabilidad.show', $caja->id) }}" class="btn btn-sm text-white" style="background-color: #17a2b8; border-color: #17a2b8;">
            Ver Línea de Tiempo
        </a>

        @if(auth()->check() && auth()->user()->role == 1)
            <form action="{{ route('trazabilidad.destroy', $caja->id) }}" method="POST" class="m-0" onsubmit="return confirm('⚠️ ¡ATENCIÓN! ¿Estás seguro de que querés borrar la caja {{ $caja->codigo }}? Se eliminará TODO su historial y no se puede recuperar.');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-outline-danger d-flex align-items-center justify-content-center" title="Eliminar Caja" style="height: 31px; width: 32px; padding: 0;">
                    <i data-lucide="trash-2" style="width: 16px; height: 16px;"></i>
                </button>
            </form>
        @endif

    </div>
</td>
                    
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center text-muted py-4">No hay cajas quirúrgicas registradas en el sistema.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection