<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HistorialCaja extends Model
{
    protected $guarded = [];

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
