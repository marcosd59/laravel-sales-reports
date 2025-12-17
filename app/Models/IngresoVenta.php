<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IngresoVenta extends Model
{
    protected $table = 'ingresos_ventas';

    protected $fillable = [
        'fecha_venta',
        'nombre_cliente',
        'tipo_cliente',
        'forma_pago',
        'importe',
        'anio',
        'mes',
        'archivado',
        'usuario_creacion',
        'usuario_actualizacion',
    ];
}
