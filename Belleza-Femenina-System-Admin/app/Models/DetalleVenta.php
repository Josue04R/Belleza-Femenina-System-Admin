<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetalleVenta extends Model
{

    protected $table = 'detalle_ventas';
    protected $primaryKey = 'id';
    protected $fillable = ['venta_id', 'producto_id', 'cantidad', 'precio_unitario'];

    public function venta()
    {
        return $this->belongsTo(Venta::class, 'venta_id');
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'producto_id');
    }
}

