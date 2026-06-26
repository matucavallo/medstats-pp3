<?php

namespace App\Http\Controllers;

use App\Models\CajaQuirurgica;
use App\Models\HistorialCaja;

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
    // Mostrar formulario de creación
    public function create()
    {
        // Solo administradores pueden ver el formulario
        if (auth()->check() && auth()->user()->role != 1) {
            abort(403, 'Acceso denegado. Solo administradores.');
        }
        return view('trazabilidad.create');
    }

    // Guardar la nueva caja en la base de datos
    public function store(\Illuminate\Http\Request $request)
    {
        // Doble seguridad para guardar
        if (auth()->check() && auth()->user()->role != 1) {
            abort(403, 'Acceso denegado.');
        }

        // 1. Validamos los datos (evita que el programa explote si repiten el código)
        $request->validate([
            'codigo' => 'required|unique:caja_quirurgicas,codigo',
            'nombre' => 'required|string|max:255',
        ], [
            'codigo.unique' => 'Ese código de caja ya existe en el sistema.',
            'codigo.required' => 'El código es obligatorio.',
            'nombre.required' => 'El nombre de la caja es obligatorio.'
        ]);

        // 2. Creamos la caja (por defecto nace "Almacenada" y limpia)
        $caja = CajaQuirurgica::create([
            'codigo' => $request->codigo,
            'nombre' => $request->nombre,
            'estado_actual' => 'Almacenada'
        ]);

        // 3. Le creamos su primer punto en la línea de tiempo
        HistorialCaja::create([
            'caja_quirurgicas_id' => $caja->id,
            'empleado_id' => null,
            'cirugia_id' => null,
            'estado_registrado' => 'Almacenada',
            'observaciones' => 'Alta de nueva caja en el sistema.'
        ]);

        // 4. Volvemos al inicio con un mensaje de éxito
        return redirect()->route('trazabilidad.index')->with('success', 'Caja creada exitosamente.');
    }
    public function actualizarEstado(\Illuminate\Http\Request $request, $id)
    {
        // 1. Doble validación de seguridad (Solo Admin)
        if (auth()->user()->role != 1) {
            abort(403, 'Acceso denegado. Solo administradores.');
        }

        $caja = CajaQuirurgica::findOrFail($id);
        
        // Atrapamos qué botón apretó el usuario (por defecto asume avanzar)
        $accion = $request->input('accion', 'avanzar'); 

        // 2. Nuestra "Máquina de Estados" doble
        if ($accion == 'retroceder') {
            $flujo_inverso = [
                'Esterilizada' => 'Lavado',
                'Almacenada'   => 'Esterilizada',
                'En Uso'       => 'Almacenada',
                'Lavado'       => 'En Uso', // (Por si retroceden desde Lavado)
            ];
            $nuevo_estado = $flujo_inverso[$caja->estado_actual] ?? 'Lavado';
            $observacion = 'Corrección: Retroceso manual a ' . $nuevo_estado;
        } else {
            $flujo_normal = [
                'Lavado'       => 'Esterilizada',
                'Esterilizada' => 'Almacenada',
                'Almacenada'   => 'En Uso',
                'En Uso'       => 'Lavado', 
            ];
            $nuevo_estado = $flujo_normal[$caja->estado_actual] ?? 'Lavado';
            $observacion = 'Avance rápido a: ' . $nuevo_estado;
        }

        // 3. Actualizamos la caja
        $caja->update([
            'estado_actual' => $nuevo_estado
        ]);

        // 4. Registramos en el historial (agregando la "s" que arreglamos antes)
        HistorialCaja::create([
            'caja_quirurgicas_id' => $caja->id,
            'empleado_id' => null, 
            'cirugia_id' => null,
            'estado_registrado' => $nuevo_estado,
            'observaciones' => $observacion
        ]);

        return redirect()->back()->with('success', '¡Estado actualizado a ' . $nuevo_estado . '!');
    }
}
