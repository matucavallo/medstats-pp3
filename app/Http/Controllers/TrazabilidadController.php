<?php

namespace App\Http\Controllers;

use App\Models\CajaQuirurgica;
use App\Models\HistorialCaja;

class TrazabilidadController extends Controller
{
    public function index(\Illuminate\Http\Request $request)
    {
        
        $filtroEstado = $request->input('estado', 'Todas');
        $filtroNombre = $request->input('nombre_caja', 'Todas');

        
        $nombresCajas = CajaQuirurgica::withTrashed()
                            ->select('nombre')
                            ->distinct()
                            ->orderBy('nombre')
                            ->pluck('nombre');

        
        $query = CajaQuirurgica::query();

        
        if ($filtroEstado == 'En Desuso') {
            $query->onlyTrashed(); // Solo las borradas
        } elseif ($filtroEstado != 'Todas') {
            $query->where('estado_actual', $filtroEstado); // Solo las del estado elegido
        }

        //  filtro de NOMBRE
        if ($filtroNombre != 'Todas') {
            $query->where('nombre', $filtroNombre);
        }

        
        $cajas = $query->get();

       
        return view('trazabilidad.index', compact('cajas', 'filtroEstado', 'filtroNombre', 'nombresCajas'));
    }
    

    public function show($id)
    {
        
        $caja = CajaQuirurgica::withTrashed()->findOrFail($id);
        return view('trazabilidad.show', compact('caja'));
    }
    
    public function create()
    {
        
        if (auth()->check() && auth()->user()->role != 1) {
            abort(403, 'Acceso denegado. Solo administradores.');
        }
        return view('trazabilidad.create');
    }

    
    public function store(\Illuminate\Http\Request $request)
    {
      
        if (auth()->check() && auth()->user()->role != 1) {
            abort(403, 'Acceso denegado.');
        }

        
        $request->validate([
            'codigo' => 'required|unique:caja_quirurgicas,codigo',
            'nombre' => 'required|string|max:255',
            'tipo_esterilizacion' => 'required|string|in:Autoclave,Óxido de Etileno',
            'descripcion' => 'required|string'
        ], [
            'codigo.unique' => 'Ese código de caja ya existe en el sistema.',
            'codigo.required' => 'El código es obligatorio.',
            'nombre.required' => 'El nombre de la caja es obligatorio.',
            
            'descripcion.required' => 'La descripcion de la caja es obligatoria.'
        ]);

        
        $caja = CajaQuirurgica::create([
            'codigo' => $request->codigo,
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'tipo_esterilizacion' => $request->tipo_esterilizacion,
            'estado_actual' => 'Almacenada'
        ]);

        
        HistorialCaja::create([
            'caja_quirurgicas_id' => $caja->id,
            'empleado_id' => auth()->id(),
            'cirugia_id' => null,
            'estado_registrado' => 'Almacenada',
            'observaciones' => 'Alta de nueva caja en el sistema.'
        ]);

        
        return redirect()->route('trazabilidad.index')->with('success', 'Caja creada exitosamente.');
    }

 public function actualizarEstado(\Illuminate\Http\Request $request, $id)
    {
        
        if (auth()->check() && auth()->user()->role != 1) {
            abort(403, 'Acceso denegado. Solo administradores.');
        }

        $caja = CajaQuirurgica::findOrFail($id);
        
        
        $accion = $request->input('accion', 'avanzar'); 

        
        // LÓGICA DE RETROCEDER (BORRAR EL ÚLTIMO)
       
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
       
        else {
            $flujo_normal = [
               'Almacenada' => 'En Uso',
                'En Uso' => 'Esterilizada',
                'Esterilizada' => 'Depósito Estéril',
                'Depósito Estéril' => 'Almacenada'
            ];
            $nuevo_estado = $flujo_normal[$caja->estado_actual] ?? 'Lavado';

            
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
  
    public function destroy($id)
    {
        
        if (auth()->check() && auth()->user()->role != 1) {
            abort(403, 'Acceso denegado. Solo administradores.');
        }

        $caja = CajaQuirurgica::findOrFail($id);

        $caja->delete();

       
       return redirect()->back()->with('success', 'Caja enviada a desuso correctamente.');
    }

    // 1. Esta función busca la caja y te muestra la pantalla para editar
    public function edit($id)
    {
        // Protegemos la ruta (Solo Admin y Trazabilidad)
        if (auth()->check() && auth()->user()->role != 1 && auth()->user()->role != 2) {
            abort(403, 'Acceso denegado.');
        }

        $caja = CajaQuirurgica::findOrFail($id);
        return view('trazabilidad.edit', compact('caja'));
    }

    // 2. Esta función recibe los datos nuevos y los guarda en la base de datos
    // ¡Fijate en la barrita \ antes de Illuminate!
    public function update(\Illuminate\Http\Request $request, $id)
    {
        // Protegemos la ruta
        if (auth()->check() && auth()->user()->role != 1 && auth()->user()->role != 2) {
            abort(403, 'Acceso denegado.');
        }

        $caja = CajaQuirurgica::findOrFail($id);

        // Validamos que los datos sean correctos. 
        // OJO: En el código le decimos que ignore el código actual de ESTA caja para que no tire error de "código duplicado" al guardar.
        $request->validate([
            'codigo' => 'required|string|unique:caja_quirurgicas,codigo,' . $caja->id,
            'nombre' => 'required|string|max:255',
            'tipo_esterilizacion' => 'required|string|in:Autoclave,Óxido de Etileno',
            'descripcion' => 'nullable|string'
        ]);

        // Actualizamos los datos
        $caja->update([
            'codigo' => $request->codigo,
            'nombre' => $request->nombre,
            'tipo_esterilizacion' => $request->tipo_esterilizacion,
            'descripcion' => $request->descripcion,
        ]);

        return redirect()->route('trazabilidad.index')->with('success', 'Caja actualizada correctamente.');
    }

   public function estadisticas()
    {
        // 1. MÉTRICAS PARA LAS TARJETAS SUPERIORES
        // Contamos las cajas según su estado actual en la tabla principal
        $totalCajas = \App\Models\CajaQuirurgica::count();
        $cajasAlmacenadas = \App\Models\CajaQuirurgica::where('estado_actual', 'Almacenada')->count();
        $cajasEnUso = \App\Models\CajaQuirurgica::where('estado_actual', 'En Uso')->count();
        $cajasEnDesuso = \App\Models\CajaQuirurgica::where('estado_actual', 'En Desuso')->count();
        $cajasEsterilizadas = \App\Models\CajaQuirurgica::where('estado_actual', 'Esterilizada')->count();

        // 2. DATOS PARA LA TABLA DEL HISTORIAL
        // Traemos todos los registros de la tabla historial_cajas ordenados del más nuevo al más viejo
        // Usamos 'with' para traer los datos de la caja y del empleado asociado de una sola vez
        $historial = \App\Models\HistorialCaja::with(['cajaQuirurgica', 'empleado'])
                        ->orderBy('created_at', 'desc')
                        ->get();

        // 3. ENVIAR TODO A LA VISTA
        return view('trazabilidad.estadisticas', compact(
            'totalCajas', 
            'cajasAlmacenadas', 
            'cajasEnUso', 
            'cajasEnDesuso',
            'cajasEsterilizadas',
            'historial'
        ));
    }
    }

    