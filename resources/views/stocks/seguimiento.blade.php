@extends('layouts.app')
@section('titulo', 'Seguimiento del proceso')
@section('contenido')
<div class="max-w-5xl mx-auto px-4 py-8">

    @if (session('success'))
        <div class="mb-6 px-4 py-3 bg-green-100 text-green-800 rounded shadow-sm border border-green-200">
            {{ session('success') }}
        </div>
    @endif

    <h1 class="text-2xl font-bold bg-gradient-to-r from-[#1B7D8F] via-[#2BA8A0] to-[#245360] text-transparent bg-clip-text drop-shadow-md px-2 mb-2">
        Seguimiento del proceso
    </h1>

    <div class="mb-6 text-sm text-gray-700 px-2">
        <p><span class="font-medium">Medicamento:</span> {{ $stock->get_medicamento->nombre }}</p>
        <p><span class="font-medium">Lote:</span> {{ $stock->lote }}</p>
    </div>

    {{-- Caja con el rol de prueba / estado de permiso --}}
    <div class="bg-gray-50 border border-gray-200 rounded-lg px-4 py-3 mb-8 flex items-center gap-2">
        <span class="font-medium text-gray-700">Tu rol actual:</span>
        @if($puedeEditar)
            <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full bg-[#1B7D8F] text-white text-sm font-medium">
                Editor (Admin)
            </span>
            <span class="text-sm text-gray-500">Podés avanzar o retroceder el estado.</span>
        @else
            <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full bg-gray-300 text-gray-700 text-sm font-medium">
                Lector
            </span>
            <span class="text-sm text-gray-500">Solo podés visualizar el progreso.</span>
        @endif
    </div>

    {{-- ===== STEPPER ===== --}}
    <div class="flex items-start justify-between relative mb-10 px-4">
        @foreach (\App\Models\Stock::FASES as $numero => $fase)
            @php
                $completada = $numero < $stock->fase_actual;
                $actual = $numero == $stock->fase_actual;
            @endphp

            <div class="flex-1 flex flex-col items-center text-center relative">

                {{-- Línea conectora hacia la derecha (no la dibujamos en el último paso) --}}
                @if(!$loop->last)
                    <div class="absolute top-5 left-1/2 w-full h-[2px] {{ $completada ? 'bg-[#1B7D8F]' : 'bg-gray-300' }}" style="z-index: 0;"></div>
                @endif

                {{-- Círculo --}}
                <div class="relative z-10 w-10 h-10 rounded-full flex items-center justify-center font-semibold border-2
                    {{ $completada ? 'bg-[#1B7D8F] border-[#1B7D8F] text-white' : '' }}
                    {{ $actual ? 'border-[#1B7D8F] text-[#1B7D8F] bg-white' : '' }}
                    {{ !$completada && !$actual ? 'border-gray-300 text-gray-400 bg-white' : '' }}">
                    @if($completada)
                        ✓
                    @else
                        {{ $numero }}
                    @endif
                </div>

                {{-- Título y descripción --}}
                <p class="mt-3 font-semibold text-sm {{ $actual || $completada ? 'text-gray-800' : 'text-gray-400' }}">
                    {{ $fase['titulo'] }}
                </p>
                <p class="text-xs text-gray-500 mt-1 px-1">
                    {{ $fase['descripcion'] }}
                </p>
            </div>
        @endforeach
    </div>

    {{-- ===== BOTONES (solo si puede editar) ===== --}}
    @if($puedeEditar)
        <div class="flex justify-center gap-4 mt-4">
            <form action="{{ route('stocks.seguimiento.update', $stock) }}" method="POST">
                @csrf
                <input type="hidden" name="accion" value="retroceder">
                <button type="submit"
                    class="px-5 py-2 rounded-full border-2 border-[#1B7D8F] text-[#1B7D8F] font-medium hover:bg-[#1B7D8F] hover:text-white transition disabled:opacity-40 disabled:cursor-not-allowed"
                    {{ $stock->fase_actual <= 1 ? 'disabled' : '' }}>
                    ← Retroceder
                </button>
            </form>

            <form action="{{ route('stocks.seguimiento.update', $stock) }}" method="POST">
                @csrf
                <input type="hidden" name="accion" value="avanzar">
                <button type="submit"
                    class="px-5 py-2 rounded-full bg-[#1B7D8F] text-white font-medium hover:bg-[#245360] transition disabled:opacity-40 disabled:cursor-not-allowed"
                    {{ $stock->fase_actual >= count(\App\Models\Stock::FASES) ? 'disabled' : '' }}>
                    Avanzar →
                </button>
            </form>
        </div>
    @endif

    <div class="mt-8 text-center">
        <a href="{{ route('stocks.index') }}" class="text-sm text-gray-500 hover:text-[#1B7D8F] underline">
            ← Volver al listado
        </a>
    </div>

</div>
@endsection