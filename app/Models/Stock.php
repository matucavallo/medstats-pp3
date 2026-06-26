<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'lote',
        'fecha_vencimiento',
        'cantidad_act',
        'servicio_id',
        'creado_por',
        'modificado_por',
        'fase_actual'
    ];

    public function get_medicamento()
    {
        return $this->belongsTo(Medicamento::class,'medicamento_id', 'id');
    }

    public function get_servicio()
    {
        return $this->belongsTo(Servicio::class, 'servicio_id');
    }
    public function get_historial()
    {
        return $this->hasMany(Historial_stock::class, 'stock_id', 'id');
    }
    public function historial_stock()
{
    return $this->hasMany(Historial_stock::class, 'stock_id');
}
public const FASES = [
    1 => ['titulo' => 'Solicitud recibida', 'descripcion' => 'Se registró la solicitud en el sistema.'],
    2 => ['titulo' => 'En revisión',        'descripcion' => 'Un responsable está validando la información.'],
    3 => ['titulo' => 'Aprobada',           'descripcion' => 'La solicitud fue aprobada y procesada.'],
    4 => ['titulo' => 'Finalizada',         'descripcion' => 'El proceso se completó por completo.'],
];
//nuevo 
    public function historiales()
    {
        return $this->hasMany(Historial_Stock::class, 'stock_id')
                    ->orderBy('fecha', 'desc'); // Clave para la línea de tiempo
    }

    // Relación con el medicamento
    public function medicamento()
    {
        return $this->belongsTo(Medicamento::class, 'medicamento_id');
    }
    public function servicio()
    {
        return $this->belongsTo(Servicio::class, 'servicio_id');
    }
}
