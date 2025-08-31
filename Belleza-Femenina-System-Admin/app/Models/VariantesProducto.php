<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VariantesProducto extends Model
{
    protected $table = 'variantesProducto';
    protected $primaryKey = 'idVariante';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;

    protected $fillable = ['idProducto', 'idTalla', 'color', 'stock', 'precio'];

    public function getRouteKeyName()
    {
        return 'idVariante';
    }

    public function producto()
    {
        return $this->belongsTo(\App\Models\Producto::class, 'idProducto', 'idProducto');
    }

    public function talla()
    {
        return $this->belongsTo(\App\Models\Talla::class, 'idTalla', 'idTalla');
    }
}
