<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HistorialCaja extends Model
{
    protected $guarded = [];

    // Agregamos la relación que faltaba para vincular el historial con la caja
    public function cajaQuirurgica()
    {
        return $this->belongsTo(CajaQuirurgica::class, 'caja_quirurgicas_id');
    }

    public function empleado()
    {
        return $this->belongsTo(\App\Models\User::class, 'empleado_id');
    }

    public function cirugia()
    {
        return $this->belongsTo(Cirugia::class);
    }
    // Relación para traer los datos de la persona que hizo el movimiento
}