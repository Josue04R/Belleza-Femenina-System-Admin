<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VariantesProducto extends Model
{
     protected $primaryKey = 'id_variantes';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;

    protected $fillable = ['id_producto', 'id_talla', 'color', 'stock', 'precio'];

    public function getRouteKeyName()
    {
        return 'id_variantes';
    }

    public function producto()
    {
        return $this->belongsTo(\App\Models\Producto::class, 'id_producto', 'id_producto');
    }

    public function talla()
    {
        return $this->belongsTo(\App\Models\Talla::class, 'id_talla', 'id_talla');
    }
}
