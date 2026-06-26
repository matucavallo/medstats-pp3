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
            'empleado_id' => auth()->id(),
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
        if (auth()->check() && auth()->user()->role != 1) {
            abort(403, 'Acceso denegado. Solo administradores.');
        }

        $caja = CajaQuirurgica::findOrFail($id);
        
        // Atrapamos qué botón apretó el usuario (por defecto asume avanzar)
        $accion = $request->input('accion', 'avanzar'); 

        // ==========================================
        // LÓGICA DE RETROCEDER (BORRAR EL ÚLTIMO)
        // ==========================================
        if ($accion == 'retroceder') {
            
            // Consultamos directamente a la BD cuántos pasos hay en total
            $cantidadPasos = HistorialCaja::where('caja_quirurgicas_id', $caja->id)->count();

            if ($cantidadPasos > 1) {
                // Buscamos el último registro real y lo borramos
                $ultimoMovimiento = HistorialCaja::where('caja_quirurgicas_id', $caja->id)
                                                 ->latest()
                                                 ->first();
                $ultimoMovimiento->delete();

                // Ahora buscamos cuál quedó como último en la lista
                $nuevoUltimo = HistorialCaja::where('caja_quirurgicas_id', $caja->id)
                                            ->latest()
                                            ->first();

                // Actualizamos la caja para que regrese a ese estado anterior
                $caja->update([
                    'estado_actual' => $nuevoUltimo->estado_registrado
                ]);

                return redirect()->back()->with('success', 'Paso deshecho. La caja volvió a estado: ' . $nuevoUltimo->estado_registrado);
            } else {
                return redirect()->back()->with('error', 'No se puede retroceder más. Este es el estado inicial de la caja.');
            }
        } 
        // ==========================================
        // LÓGICA DE AVANZAR NORMAL
        // ==========================================
        else {
            $flujo_normal = [
                'Lavado'       => 'Esterilizada',
                'Esterilizada' => 'Almacenada',
                'Almacenada'   => 'En Uso',
                'En Uso'       => 'Lavado', 
            ];
            $nuevo_estado = $flujo_normal[$caja->estado_actual] ?? 'Lavado';

            // Actualizamos la caja
            $caja->update([
                'estado_actual' => $nuevo_estado
            ]);

            // Creamos el nuevo punto en la línea de tiempo
            HistorialCaja::create([
                'caja_quirurgicas_id' => $caja->id,
                'empleado_id' => auth()->id(), 
                'cirugia_id' => null,
                'estado_registrado' => $nuevo_estado,
                'observaciones' => 'Avance a: ' . $nuevo_estado
            ]);

            return redirect()->back()->with('success', '¡Estado avanzado a ' . $nuevo_estado . '!');
        }
    }
    // Eliminar una caja y todo su historial
    public function destroy($id)
    {
        // 1. Validamos que solo el Administrador (rol 1) pueda borrar
        if (auth()->check() && auth()->user()->role != 1) {
            abort(403, 'Acceso denegado. Solo administradores.');
        }

        // 2. Buscamos la caja
        $caja = CajaQuirurgica::findOrFail($id);

        // 3. Borramos TODO el historial asociado a esa caja primero
        // Usamos el nombre de la columna que arreglamos antes con la "s"
        \App\Models\HistorialCaja::where('caja_quirurgicas_id', $caja->id)->delete();

        // 4. Ahora sí, borramos la caja física
        $caja->delete();

        // 5. Redirigimos al listado principal con un mensaje de éxito
        return redirect()->route('trazabilidad.index')->with('success', '¡Caja y su historial eliminados correctamente!');
    }
    }

    