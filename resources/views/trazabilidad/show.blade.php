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
   <div class="bg-white rounded-xl shadow-sm p-6 mb-12 border border-gray-100 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">
                <i data-lucide="box" class="inline-block w-6 h-6 text-indigo-500 mr-2 -mt-1"></i>
                {{ $caja->nombre }} ({{ $caja->codigo }})
            </h2>
            <p class="text-gray-500 mt-1">Trazabilidad del ciclo de esterilización y uso.</p>
        </div>

            @if(auth()->check() && auth()->user()->role == 1)
                <div class="flex flex-col items-end gap-3">
                    <span class="px-4 py-2 rounded-lg font-bold text-sm bg-indigo-100 text-indigo-800 border border-indigo-200">
                        Estado Actual: {{ $caja->estado_actual }}
                     </span>
                </div>
            @endif
        </div>
    </div>

    <!-- Contenedor Horizontal de Trazabilidad -->
    <div class="w-full overflow-x-auto pb-12">
        <div class="flex items-center min-w-[800px] px-8 pt-28">
            
            @foreach($caja->historiales->take(-4) as $index => $movimiento)
                
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

            @if(auth()->check() && auth()->user()->role == 1)
                @php
                    $flujo_normal = [
                        'Lavado' => 'Esterilizada', 'Esterilizada' => 'Almacenada',
                        'Almacenada' => 'En Uso', 'En Uso' => 'Lavado'
                    ];
                    $flujo_inverso = [
                        'Esterilizada' => 'Lavado', 'Almacenada' => 'Esterilizada',
                        'En Uso' => 'Almacenada', 'Lavado' => 'En Uso'
                    ];
                    $siguienteEstado = $flujo_normal[$caja->estado_actual] ?? 'Lavado';
                    $estadoAnterior = $flujo_inverso[$caja->estado_actual] ?? 'Lavado';
                @endphp

                <div class="flex-auto border-t-4 border-dashed border-gray-300 -mt-24 min-w-[50px]"></div>
                
                <div class="relative flex flex-col items-center flex-1 min-w-[150px]">
                    
                    <div class="absolute -top-24 flex gap-3 items-center">
                        
                        <form action="{{ route('trazabilidad.estado', $caja->id) }}" method="POST">
                            @csrf
                            <input type="hidden" name="accion" value="retroceder">
                            <button type="submit" class="p-3 bg-red-50 rounded-2xl border-2 border-dashed border-red-400 shadow-sm hover:shadow-md hover:bg-red-100 hover:border-red-500 transition-all group flex items-center justify-center cursor-pointer" title="Deshacer a {{ $estadoAnterior }}">
                                <i data-lucide="rotate-ccw" class="w-8 h-8 text-red-500 group-hover:-rotate-45 transition-transform"></i>
                            </button>
                        </form>

                        <form action="{{ route('trazabilidad.estado', $caja->id) }}" method="POST">
                            @csrf
                            <input type="hidden" name="accion" value="avanzar">
                            <button type="submit" class="p-4 bg-blue-50 rounded-2xl border-2 border-dashed border-blue-400 shadow-sm hover:shadow-md hover:bg-blue-100 hover:border-blue-500 transition-all group flex items-center justify-center cursor-pointer" title="Avanzar a {{ $siguienteEstado }}">
                                <i data-lucide="plus" class="w-12 h-12 text-blue-500 group-hover:scale-110 transition-transform"></i>
                            </button>
                        </form>
                    </div>

                    <div class="w-10 h-10 bg-gray-50 border-4 border-dashed border-gray-300 rounded-full flex items-center justify-center z-10">
                    </div>

                    <div class="mt-8 text-center w-full">
                        <h4 class="text-sm font-bold text-gray-500 uppercase tracking-wider">Acción rápida:</h4>
                        <p class="text-xs text-gray-400 mt-1">Avanzar o deshacer</p>
                    </div>
                </div>
            @endif

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