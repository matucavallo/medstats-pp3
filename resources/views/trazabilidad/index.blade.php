@extends('layouts.app')

@section('title', 'Lista de Seguimiento')


@section('contenido')
<div class="container mt-4">
    <h1
                class="text-2xl font-bold bg-gradient-to-r from-[#1B7D8F] via-[#2BA8A0] to-[#245360] text-transparent  bg-clip-text drop-shadow-md  flex items-center gap-2 px-2">
                Trazabilidad de Cajas Quirúrgicas</h1>
                <br>

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
                    <td>
                        <a href="{{ route('trazabilidad.show', $caja->id) }}" class="btn btn-sm btn-info text-white">
                            Ver Línea de Tiempo
                        </a>
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