<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetalleVenta extends Model
{
    protected $table = 'detalleVenta'; 
    protected $primaryKey = 'id';    
    public $incrementing = true;  
    public $timestamps = false;        

    protected $fillable = [
        'idVenta',
        'idProducto',
        'idVariante',
        'cantidad',
        'precio_unitario',
        'subTotal',
    ];

    // Relación con Venta
    public function venta()
    {
        return $this->belongsTo(Venta::class, 'idVenta', 'idVenta');
    }

    // Relación con Producto
    public function producto()
    {
        return $this->belongsTo(Producto::class, 'idProducto', 'id_producto');
    }

    // Relación con Variante
   public function variante()
    {
        // Tu tabla se llama variantes_productos y su PK es id_variantes
        return $this->belongsTo(VariantesProducto::class, 'idVariante', 'id_variantes');
    }
}
