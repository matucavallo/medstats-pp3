@extends('layouts.app_estadisticas')

@section('titulo', 'Estadísticas de Esterilización')

@section('contenido')
<div class="container mx-auto">
    <!-- Encabezado -->
    <div class="mb-8">
        <h2 class="text-3xl font-bold text-[#1B7D8F]">Estadísticas de Esterilización y Trazabilidad</h2>
        <p class="text-gray-500 mt-1">Resumen del estado actual del instrumental quirúrgico</p>
    </div>

    <!-- Tarjetas de Métricas -->
   <!-- Tarjetas de Métricas (¡Ahora con grilla de 6 columnas!) -->
    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-6 gap-4 mb-8">
        
        <!-- Total -->
        <div class="bg-white rounded-lg shadow-sm p-4 flex flex-col items-center justify-center border border-gray-100">
            <div class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-2">Total de Cajas</div>
            <div class="text-3xl font-bold text-gray-800">{{ $totalCajas }}</div>
        </div>

        <!-- Almacenadas -->
        <div class="bg-white rounded-lg shadow-sm p-4 flex flex-col items-center justify-center border border-gray-100">
            <div class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-2">Almacenadas</div>
            <div class="text-3xl font-bold text-[#1B7D8F]">{{ $cajasAlmacenadas }}</div>
        </div>

        <!-- En Uso -->
        <div class="bg-white rounded-lg shadow-sm p-4 flex flex-col items-center justify-center border border-gray-100">
            <div class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-2">En Uso</div>
            <div class="text-3xl font-bold text-red-500">{{ $cajasEnUso }}</div>
        </div>

        <!-- Lavado -->
        <div class="bg-white rounded-lg shadow-sm p-4 flex flex-col items-center justify-center border border-gray-100">
            <div class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-2">En Lavado</div>
            <div class="text-3xl font-bold text-blue-500">{{ $cajasLavado }}</div>
        </div>

        <!-- Esterilizadas (¡Acá está!) -->
        <div class="bg-white rounded-lg shadow-sm p-4 flex flex-col items-center justify-center border border-gray-100">
            <div class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-2">Esterilizadas</div>
            <div class="text-3xl font-bold text-green-500">{{ $cajasEsterilizadas }}</div>
        </div>

        <!-- En Desuso -->
        <div class="bg-white rounded-lg shadow-sm p-4 flex flex-col items-center justify-center border border-gray-100">
            <div class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-2">En Desuso</div>
            <div class="text-3xl font-bold text-orange-500">{{ $cajasEnDesuso }}</div>
        </div>

    </div>

<!-- Contenedor de la Tabla -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <h3 class="text-xl font-bold text-[#1B7D8F] mb-4">Historial de Movimientos</h3>
        
        <div class="overflow-x-auto">
            <table id="tabla-historial" class="table table-hover w-full text-sm">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="py-3 px-4 text-left font-semibold text-gray-100">Fecha y Hora</th>
                        <th class="py-3 px-4 text-left font-semibold text-gray-100">Caja Quirúrgica</th>
                        <th class="py-3 px-4 text-left font-semibold text-gray-100">Estado</th>
                        <th class="py-3 px-4 text-left font-semibold text-gray-100">Registrado por</th>
                        <th class="py-3 px-4 text-left font-semibold text-gray-100">Observaciones</th>
                        <th class="py-3 px-4 text-left font-semibold text-gray-100">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($historial as $movimiento)
                    <tr class="border-b border-gray-50">
                        <!-- Fecha formateada (Día/Mes/Año Hora:Minutos) -->
                        <td class="py-3 px-4 align-middle">
                            {{ \Carbon\Carbon::parse($movimiento->created_at)->format('d/m/Y H:i') }}
                        </td>
                        
                        <!-- Datos de la caja -->
                        <td class="py-3 px-4 align-middle">
                            <span class="font-bold text-gray-800">{{ $movimiento->cajaQuirurgica->codigo ?? 'N/A' }}</span><br>
                            <span class="text-xs text-gray-500">{{ $movimiento->cajaQuirurgica->nombre ?? 'Caja eliminada' }}</span>
                        </td>
                        
                        <!-- Estado con colores dinámicos -->
                        <td class="py-3 px-4 align-middle">
                            <span class="px-3 py-1 text-xs font-semibold rounded-full
                                {{ $movimiento->estado_registrado == 'Lavado' ? 'bg-blue-100 text-blue-800' : '' }}
                                {{ $movimiento->estado_registrado == 'Esterilizada' ? 'bg-green-100 text-green-800' : '' }}
                                {{ $movimiento->estado_registrado == 'Almacenada' ? 'bg-[#e6f4f3] text-[#1B7D8F]' : '' }}
                                {{ $movimiento->estado_registrado == 'En Uso' ? 'bg-red-100 text-red-800' : '' }}
                                {{ $movimiento->estado_registrado == 'En Desuso' ? 'bg-orange-100 text-orange-800' : '' }}
                            ">
                                {{ $movimiento->estado_registrado }}
                            </span>
                        </td>
                        
                                                <!-- Empleado (Defensa contra registros nulos usando Nullsafe operator) -->
                        <td class="py-3 px-4 align-middle">
                            {{ $movimiento->empleado?->name ?? ($movimiento->empleado?->nombre . ' ' . $movimiento->empleado?->apellido) ?? 'Usuario Desconocido' }}
                        </td>
                                                
                        <!-- Observaciones -->
                        <td class="py-3 px-4 align-middle text-gray-600">
                            {{ $movimiento->observaciones ?? '-' }}
                        </td>

                        <td class="py-3 px-4 align-middle text-center">
                            {{-- Verificamos primero si existe el ID --}}
                            @if($movimiento->caja_quirurgica_id)
                                <a href="{{ route('cajas.historial', ['id' => $movimiento->caja_quirurgica_id]) }}" class="btn btn-outline-primary btn-sm rounded-pill shadow-sm">
                                    <i class="fas fa-history mr-1"></i> Ver Caja
                                </a>
                            @else
                                {{-- Opcional: mostrar un indicador visual si falta el dato --}}
                                <span class="text-xs text-gray-400">Sin ID</span>
                            @endif
                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>    <div id="contenedor-tabla-historial">
        <!-- Próximo paso -->
    </div>

</div>
@endsection
@push('scripts')
<script>
    $(document).ready(function() {
        $('#tabla-historial').DataTable({
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json'
            },
            order: [[0, 'desc']], // Ordena desde el movimiento más reciente
            pageLength: 10,
            dom: '<"flex justify-between items-center mb-4"lf>rt<"flex justify-between items-center mt-4"ip>',
        });
    });
</script>
@endpush