<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetalleCompra extends Model{
    protected $table = 'detalleCompras';
    protected $primaryKey = 'idDetalleCompra';
    public $timestamps = false;

    protected $fillable = [
        'idProducto',
        'idVarianteProducto',
        'cantidad',
        'subtotal'
    ];

    // 🔹 Relación con compra (si quieres enlazar más adelante)
    public function compra()
    {
        return $this->belongsTo(Compra::class, 'idCompra', 'idCompra');
    }

    // 🔹 Relación con producto
    public function producto()
    {
        return $this->belongsTo(Producto::class, 'idProducto', 'id_producto');
    }

    // 🔹 Relación con variante de producto
    public function variante()
    {
       return $this->belongsTo(VariantesProducto::class, 'idVarianteProducto', 'id_variantes');
    }
}