<?php

namespace App\Http\Controllers;

use App\Models\Cama;
use App\Models\Cirugia;
use App\Models\Paciente;
use App\Models\CajaQuirurgica;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Can;

class InicioController extends Controller
{
    //
    //Muestra carga valores de insumos, pacientes, camas y cirugías
    public function index() //Pagina inicial
    {
        //Cantidad de pacientes
        $pacientes = count(Paciente::where('habitacion_id', '!=', null)->where('cama_id', '!=', null)->get());

        //Porcentaje de camas
        $camasOcupadas = count(Cama::where('ocupada', 1)->get());
        $camasTotales = count(Cama::all());
        // $porcentajeCamas = intval( ( $camasOcupadas * 100 ) / $camasTotales );
        $porcentajeCamas = $camasTotales > 0
            ? intval(($camasOcupadas * 100) / $camasTotales)
            : 0;


        //Cantidad de Cirugías
        $cantCirugias = count(Cirugia::whereYear('fecha_cirugia', date('Y'))->get());

        // --- Métricas de Esterilización (módulo Trazabilidad) ---
        $cajasAutoclave = CajaQuirurgica::where('estado_actual', 'Esterilizada')
                                        ->where('tipo_esterilizacion', 'Autoclave')
                                        ->count();

        $cajasOxido = CajaQuirurgica::where('estado_actual', 'Esterilizada')
                                    ->where('tipo_esterilizacion', 'Óxido de Etileno')
                                    ->count();

        $cajasDeposito = CajaQuirurgica::where('estado_actual', 'Depósito Estéril')
                                       ->count();

        return view('index', compact(
            'pacientes',
            'porcentajeCamas',
            'cantCirugias',
            'cajasAutoclave',
            'cajasOxido',
            'cajasDeposito'
        )); //Llama a la vista y le pasa los datos
    }
}
