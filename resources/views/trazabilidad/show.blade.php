@extends('layouts.app')

@section('title', 'Mostrar Seguimiento')

@section('contenido')
<div class="container mx-auto p-4 max-w-6xl">
    
    <div class="mb-6">
        <a href="{{ route('trazabilidad.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-100 text-gray-700 rounded-md hover:bg-gray-200 transition-colors font-medium">
            <i data-lucide="arrow-left" class="w-4 h-4 mr-2"></i> Volver al listado
        </a>
    </div>

    <!-- Encabezado de la Caja -->
    <div class="bg-white rounded-xl shadow-sm p-6 mb-12 border border-gray-100 flex justify-between items-center">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">
                <i data-lucide="box" class="inline-block w-6 h-6 text-indigo-500 mr-2 -mt-1"></i>
                {{ $caja->nombre }} ({{ $caja->codigo }})
            </h2>
            <p class="text-gray-500 mt-1">Trazabilidad del ciclo de esterilización y uso.</p>
        </div>
        <span class="px-4 py-2 rounded-lg font-bold text-sm bg-indigo-100 text-indigo-800 border border-indigo-200">
            Estado Actual: {{ $caja->estado_actual }}
        </span>
    </div>

    <!-- Contenedor Horizontal de Trazabilidad -->
    <div class="w-full overflow-x-auto pb-12">
        <div class="flex items-center min-w-[800px] px-8 pt-28">
            
            @foreach($caja->historiales as $index => $movimiento)
                <div class="relative flex flex-col items-center flex-1">
                    
                    <div class="absolute -top-24 flex flex-col items-center">
                        <div class="p-4 bg-white rounded-2xl border-2 border-gray-100 shadow-md">
                            @if($movimiento->estado_registrado == 'Esterilizada')
                                <i data-lucide="sparkles" class="w-12 h-12 text-green-500"></i>
                            @elseif($movimiento->estado_registrado == 'En Uso')
                                <i data-lucide="activity" class="w-12 h-12 text-red-500"></i>
                            @else
                                <i data-lucide="refresh-cw" class="w-12 h-12 text-blue-500"></i>
                            @endif
                        </div>
                    </div>

                    <div class="w-10 h-10 bg-blue-500 border-4 border-white ring-4 ring-blue-100 rounded-full flex items-center justify-center z-10">
                    </div>

                    <div class="mt-8 text-center w-36">
                        <h4 class="text-base font-bold text-gray-800">{{ $movimiento->estado_registrado }}</h4>
                        <p class="text-sm text-gray-500 mt-1">{{ $movimiento->created_at->format('d/m/Y') }}</p>
                        <p class="text-sm text-gray-500">{{ $movimiento->created_at->format('H:i') }}</p>
                        
                        @if($movimiento->empleado)
                            <p class="text-sm font-medium text-gray-700 mt-2 truncate" title="{{ $movimiento->empleado->nombre }}">
                                {{ $movimiento->empleado->nombre }}
                            </p>
                        @endif

                        @if($movimiento->cirugia_id)
                            <p class="text-xs text-red-600 font-bold mt-1">Cirugía #{{ $movimiento->cirugia_id }}</p>
                        @endif
                    </div>
                </div>

                @if(!$loop->last)
                    <div class="flex-auto border-t-4 border-blue-400 -mt-24"></div>
                @endif
            @endforeach

        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        if(typeof lucide !== 'undefined') {
            lucide.createIcons();
        }
    });
</script>
@endsection