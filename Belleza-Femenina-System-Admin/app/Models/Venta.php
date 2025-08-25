<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    protected $table = 'ventas';
    protected $primaryKey = 'idVenta';
    public $incrementing = true;
    public $timestamps = false; // no tienes timestamps en esta tabla

    protected $fillable = [
        'idCliente',
        'empleado_id',
        'fecha',
        'total',
    ];

    // Relación con Cliente
    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'idCliente', 'idCliente');
    }

    // Relación con Empleado
    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'empleado_id', 'idEmpleado');
    }

    // Relación con Detalles de la venta
    public function detalles()
    {
        return $this->hasMany(DetalleVenta::class, 'idVenta', 'idVenta');
    }
}
