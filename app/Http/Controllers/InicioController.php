<?php

namespace App\Http\Controllers;

use App\Models\Cama;
use App\Models\Cirugia;
use App\Models\Paciente;
use App\Models\CajaQuirurgica; // Nuestro modelo confirmado
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Can;

class InicioController extends Controller
{
    public function index() 
    {
        // ---------------------------------------------------------
        // 1. LÓGICA ANTERIOR (Optimizada matemáticamente)
        // ---------------------------------------------------------
        
        $pacientes = Paciente::whereNotNull('habitacion_id')
                             ->whereNotNull('cama_id')
                             ->count();

        $camasOcupadas = Cama::where('ocupada', 1)->count();
        $camasTotales = Cama::count();
        
        $porcentajeCamas = $camasTotales > 0
            ? intval(($camasOcupadas * 100) / $camasTotales)
            : 0;

        $cantCirugias = Cirugia::whereYear('fecha_cirugia', date('Y'))->count();


        // ---------------------------------------------------------
        // 2. NUEVA LÓGICA (Métricas de Esterilización)
        // ---------------------------------------------------------
        // Utilizamos las columnas 'estado_actual' y 'tipo_esterilizacion' descubiertas.
        
        // Cajas en Autoclave
        $cajasAutoclave = CajaQuirurgica::where('estado_actual', 'Esterilizada')
                                        ->where('tipo_esterilizacion', 'Autoclave')
                                        ->count();

        // Cajas en Óxido de Etileno
        $cajasOxido = CajaQuirurgica::where('estado_actual', 'Esterilizada')
                                    ->where('tipo_esterilizacion', 'Óxido de Etileno')
                                    ->count();

        // Cajas en Depósito Estéril
        $cajasDeposito = CajaQuirurgica::where('estado_actual', 'Depósito Estéril')
                                       ->count();

        // ---------------------------------------------------------
        // 3. RETORNO DE LA VISTA
        // ---------------------------------------------------------
        
        return view('index', compact(
            'pacientes', 
            'porcentajeCamas', 
            'cantCirugias',
            'cajasAutoclave',
            'cajasOxido',
            'cajasDeposito'
        )); 
    }
}