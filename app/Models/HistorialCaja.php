<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HistorialCaja extends Model
{
    protected $guarded = [];

    public function empleado()
    {
        return $this->belongsTo(Empleado::class);
    }

    public function cirugia()
    {
        return $this->belongsTo(Cirugia::class);
    }
}
