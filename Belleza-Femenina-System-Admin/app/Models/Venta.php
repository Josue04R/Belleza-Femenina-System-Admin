<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    // Nombre de la tabla
    protected $table = 'ventas';

    // Clave primaria
    protected $primaryKey = 'idVenta';

    // Campos que se pueden llenar masivamente
    protected $fillable = [
        'user_id',
        'empleado_id',
        'fecha',
        'total'
    ];

    /**
     * Relación con los detalles de la venta
     */
    public function detalles()
    {
        // Suponiendo que la tabla detalles_ventas tiene columna idVenta como FK
        return $this->hasMany(DetalleVenta::class, 'idVenta');
    }

    /**
     * Relación con el usuario que realizó la venta
     */
    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Relación con el empleado que registró la venta
     */
    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'empleado_id');
    }
}
