<?php

namespace App\Http\Controllers;

use App\Models\CajaQuirurgica;

class TrazabilidadController extends Controller
{
    public function index()
    {
        $cajas = CajaQuirurgica::all();
        return view('trazabilidad.index', compact('cajas'));
    }

    public function show($id)
    {
        // Traemos la caja con su historial, el empleado que registró y la cirugía vinculada
        $caja = CajaQuirurgica::with(['historiales.empleado', 'historiales.cirugia'])->findOrFail($id);
        return view('trazabilidad.show', compact('caja'));
    }
}
