<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CajaQuirurgica;
use App\Models\HistorialCaja;
use Carbon\Carbon;

class CajasQuirurgicasSeeder extends Seeder
{
    public function run()
    {   
        HistorialCaja::query()->delete();
        CajaQuirurgica::query()->delete();
        // ---------------------------------------------------------
        // Caja 1: Ciclo completo, actualmente guardada y lista
        // ---------------------------------------------------------
        $caja1 = CajaQuirurgica::create([
            'codigo' => 'CAJ-001',
            'nombre' => 'Caja de Cirugía General Básica',
            'estado_actual' => 'Almacenada'
        ]);

        HistorialCaja::insert([
            [
                'caja_quirurgicas_id' => $caja1->id,
                'empleado_id' => 3, // Enfermero Carlos
                'cirugia_id' => null,
                'estado_registrado' => 'Lavado',
                'observaciones' => 'Ingreso a central de esterilización post-cirugía.',
                'created_at' => Carbon::now()->subDays(2)->setTime(10, 0),
                'updated_at' => Carbon::now()->subDays(2)->setTime(10, 0),
            ],
            [
                'caja_quirurgicas_id' => $caja1->id,
                'empleado_id' => 4, // Instrumentadora Sofía
                'cirugia_id' => null,
                'estado_registrado' => 'Esterilizada',
                'observaciones' => 'Proceso de autoclave completado correctamente. Test biológico negativo.',
                'created_at' => Carbon::now()->subDays(1)->setTime(8, 30),
                'updated_at' => Carbon::now()->subDays(1)->setTime(8, 30),
            ],
            [
                'caja_quirurgicas_id' => $caja1->id,
                'empleado_id' => 3,
                'cirugia_id' => null,
                'estado_registrado' => 'Almacenada',
                'observaciones' => 'Guardada en estante A2 del arsenal quirúrgico lista para uso.',
                'created_at' => Carbon::now()->subHours(5),
                'updated_at' => Carbon::now()->subHours(5),
            ]
        ]);

        // ---------------------------------------------------------
        // Caja 2: Fue esterilizada y ahora mismo está en quirófano
        // ---------------------------------------------------------
        $caja2 = CajaQuirurgica::create([
            'codigo' => 'CAJ-002',
            'nombre' => 'Caja de Traumatología Mayor',
            'estado_actual' => 'En Uso'
        ]);

        HistorialCaja::insert([
            [
                'caja_quirurgicas_id' => $caja2->id,
                'empleado_id' => 4,
                'cirugia_id' => null,
                'estado_registrado' => 'Esterilizada',
                'observaciones' => 'Esterilización completada con éxito.',
                'created_at' => Carbon::now()->subDays(3)->setTime(14, 0),
                'updated_at' => Carbon::now()->subDays(3)->setTime(14, 0),
            ],
            [
                'caja_quirurgicas_id' => $caja2->id,
                'empleado_id' => 3,
                'cirugia_id' => null,
                'estado_registrado' => 'Almacenada',
                'observaciones' => 'Guardada en depósito de traumatología.',
                'created_at' => Carbon::now()->subDays(2)->setTime(9, 15),
                'updated_at' => Carbon::now()->subDays(2)->setTime(9, 15),
            ],
            [
                'caja_quirurgicas_id' => $caja2->id,
                'empleado_id' => 1, // Dr. Juan Pérez
                'cirugia_id' => 4, // Cirugía de Artroplastia que tenés en la BD
                'estado_registrado' => 'En Uso',
                'observaciones' => 'Entregada a quirófano 3 para procedimiento de urgencia.',
                'created_at' => Carbon::now()->subHours(2),
                'updated_at' => Carbon::now()->subHours(2),
            ]
        ]);
    }
}